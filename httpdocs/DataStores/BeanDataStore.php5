<?php
require_once("MainDB.php5");
require_once($ConstantsArray['dbServerUrl'] ."log4php/Logger.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/FilterUtil.php");
Logger::configure($ConstantsArray['dbServerUrl'] ."log4php/log4php.xml");
class BeanDataStore {

    private $className ;
    private $tableName ;
    private $companySeq;

    public function __construct($className_,$tableName){
        $this->className  = $className_;
        $this->tableName = $tableName;
        $sessionUtil = SessionUtil::getInstance();
        $this->companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
    }
    private function key_implode($array) {
         $fields = array();
         foreach($array as $field => $val) { 
         if(is_null($val)){
             $fields[] = "$field = NULL";    
         }else{
             $fields[] = "$field = '$val'";     
         }          
          
        }
        $result = join(', ', $fields) ;
        return $result;
    }
    

    
    public function save($object)  {
        $columnValueArry[] = array();
        $columns[] = array();
        $count = 0;
        $class = new ReflectionClass($this->className);
        $methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
        $id = $object->getSeq();
        foreach ($methods as $method){
            $methodName =  $method->name;
            if(!$this->startsWith($methodName,"set") ){
                if($count > 0){
                    $reflect = new ReflectionMethod($object, $methodName);
                    if ($reflect->isPublic()) {
                        $val = call_user_func( array( $object, $methodName) );
                        $column = strtolower(substr($methodName, 3));
                        $columns[] = $column;
                        $value = call_user_func( array( $object, $methodName) );
                        if($value instanceof DateTime){
                            $value = $value->format('Y-m-d H:i:s');
                        }
                        //if($id > 0){
                        // $value = "'" . $value . "'";
                        //}
                        $columnValueArry[$column] =  $value;
                    }
                }
                $count++;
            }
        }
        unset($columnValueArry[0]);
        unset($columns[0]);
        $SQL = "";
        $db_New = MainDB::getInstance();
        $conn = $db_New->getConnection();

        if($id > 0){ //update query
            $columnString = $this->key_implode($columnValueArry);
            $SQL = "Update ". strtolower($this->tableName) ." set " . $columnString . " where seq = " . $id;
            $STH = $conn->prepare($SQL);
            $STH->execute();
        }else{//Insert Query
            $columnString = implode(',', array_keys($columnValueArry));
            $valueString = implode(',', array_fill(0, count($columnValueArry), '?'));
            $SQL = "INSERT INTO ". $this->tableName ." ({$columnString}) VALUES ({$valueString})";
            $STH = $conn->prepare($SQL);
            $STH->execute(array_values($columnValueArry));
            $id = $conn->lastInsertId();
        }
        $this->throwException($STH->errorInfo());
       
        return $id;
    }

    function findAll($isApplyFilter = false){
       $db = MainDB::getInstance();
       $conn = $db->getConnection();
       $sql = "select * from " . $this->tableName;
       if($isApplyFilter){
          $sql = FilterUtil::applyFilter($sql);    
       }       
       $STH = $conn->prepare($sql);
       $STH->execute();
       $objList = $STH->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->className);
       $this->throwException($STH->errorInfo());
       return $objList ;
    }
    
    function findAllByCompany($isApplyFilter = false){
        $sql  = "select * from " . $this->tableName ." where companyseq =". $this->companySeq;
        if($isApplyFilter){
            $sql = FilterUtil::applyFilter($sql);    
        }
        $db = MainDB::getInstance();
        $conn = $db->getConnection();        
        $STH = $conn->prepare($sql);
        $STH->execute();
        $objList = $STH->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->className);
        $this->throwException($STH->errorInfo());
        return $objList ;
    }

    function findBySeq($seq){
       $db = MainDB::getInstance();
       $conn = $db->getConnection();
       $STH = $conn->prepare("select * from " . $this->tableName . " where seq = " . $seq);
       $STH->execute();
       $obj = $STH->fetchObject($this->className);
       $this->throwException($STH->errorInfo());
       return $obj ;
    }

    public function deleteBySeq($seq){
        $db = MainDB::getInstance();
        $conn = $db->getConnection();
        $STH = $conn->prepare("delete from " . $this->tableName . "where seq = " . $seq);
        $STH->execute();
        $this->throwException($STH->errorInfo());
    }
    public function deleteInList($ids){
        $db = MainDB::getInstance();
        $conn = $db->getConnection();
        $STH = $conn->prepare("delete from " . $this->tableName . " where seq in(" . $ids . ")");
        $STH->execute();
        $this->throwException($STH->errorInfo());
    }
    public function deleteByAttribute($colValuePair = null){
        foreach ($colValuePair as $key => $value){
            $query_array[] = " $key in ('$value') ";
        }
        $query = "delete FROM " .  $this->tableName;
        if($colValuePair != null){
            $query .= " WHERE " .implode(" AND ", $query_array);
        }
        $db = MainDB::getInstance();
        $conn = $db->getConnection();
        $STH = $conn->prepare($query);
        $STH->execute();
        $this->throwException($STH->errorInfo());
    }
    public function deleteAll(){
        $db = MainDB::getInstance();
        $conn = $db->getConnection();
        $STH = $conn->prepare("delete from " . $this->tableName);
        $STH->execute();
        $this->throwException($STH->errorInfo());
    }
    public function deleteAllByCompany(){
        $db = MainDB::getInstance();
        $conn = $db->getConnection();
        $STH = $conn->prepare("delete from " . $this->tableName . " where companyseq = " . $this->companySeq);
        $STH->execute();
        $this->throwException($STH->errorInfo());
    }
    public function executeConditionQuery($colValuePair,$isApplyFilter = false){
        $query_array = array();
        foreach ($colValuePair as $key => $value){
            $query_array[] = $key.' = '. "'" . $value . "'";
        }
        $query = "SELECT * FROM " .  $this->tableName;
        
        if(count($query_array) > 0){
            $query .= " WHERE " .implode(" AND ", $query_array);
        }
        if($isApplyFilter){
           $query = FilterUtil::applyFilter($query);
        }
        $db = MainDB::getInstance();
        $conn = $db->getConnection();
        $STH = $conn->prepare($query);
        $STH->execute();
        $this->throwException($STH->errorInfo());
        $objList = $STH->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->className);
        return $objList;
    }
    public function executeInListQuery($colValues,$isApplyFilter = false){
        $colName = $colValues;
        if(is_array($colValues)){
            $colName = key($colValues);    
        }        
        $query = "SELECT * FROM " .  $this->tableName ." where $colName in($colValues[$colName])";
        if($isApplyFilter){
           $query = FilterUtil::applyFilter($query);
        }
        $db = MainDB::getInstance();
        $conn = $db->getConnection();
        $STH = $conn->prepare($query);
        $STH->execute();
        $this->throwException($STH->errorInfo());
        $objList = $STH->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->className);
        return $objList;
    }
    
   
    
     public function updateByAttributes($colValuePair,$condiationPair = null){
        foreach ($condiationPair as $key => $value){
            $query_array[] = $key.' = '. "'" . $value . "'";
        }
        foreach ($colValuePair as $key => $value){
            $attribute_array[] = $key.' = '. "'" . $value . "'";
        }
        $query = "update " .  $this->tableName . "set " . implode(" AND ", $attribute_array);
        if($condiationPair != null){
            $query .= " WHERE " .implode(" AND ", $query_array);
        }
        $db = MainDB::getInstance();
        $conn = $db->getConnection();
        $STH = $conn->prepare($query);
        $STH->execute();
        $this->throwException($STH->errorInfo());
    }
    
    public function executeCountQuery($colValuePair = null,$isApplyFilter = false){
        $query = "SELECT count(*) FROM " .  $this->tableName;
        if($colValuePair != null){
            foreach ($colValuePair as $key => $value){
                $query_array[] = $key.' = '. "'" . $value . "'";
            }
            $query .= " WHERE " .implode(" AND ", $query_array);
        }
        if($isApplyFilter){
            $query = FilterUtil::applyFilter($query,false);    
        }        
        $db = MainDB::getInstance();
        $conn = $db->getConnection();
        $STH = $conn->prepare($query);
        $STH->execute();
        $this->throwException($STH->errorInfo());
        $result = $STH->fetch(PDO::FETCH_NUM);
        $count = intval($result[0]);
        return $count;
    }

    public function executeQuery($query,$isApplyFilter = false){
        $db = MainDB::getInstance();
        $conn = $db->getConnection();       
        if($isApplyFilter){
            $query = FilterUtil::applyFilter($query);    
        } 
        $sth = $conn->prepare($query);
        $sth->execute();
        $this->throwException($sth->errorInfo());
         //$objList = $sth->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->className);
         $objList = $sth->fetchAll();
         return $objList;
    }
    public function executeObjectQuery($query,$isApplyFilter = false){
        $db = MainDB::getInstance();
        $conn = $db->getConnection();
        $sth = $conn->prepare($query);
        if($isApplyFilter){
            $query = FilterUtil::applyFilter($query);    
        } 
        $sth->execute();
        $this->throwException($sth->errorInfo());
        $objList = $sth->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->className);
         return $objList;
    }
    public function executeAttributeQuery($attributes,$colValuePair,$isApplyFilter = false){
       foreach ($colValuePair as $key => $value)
       {
        if ($value != '')
        { $query_array[] = $key.' = '. "'" . $value . "'";}
        }
       $columns = implode(", " , $attributes);
       $query = "SELECT " . $columns . " FROM " .  $this->tableName . " WHERE " .implode(" AND ", $query_array);
       if($isApplyFilter){
            $query = FilterUtil::applyFilter($query,false);    
       } 
      $db = MainDB::getInstance();
      $conn = $db->getConnection();
      $sth = $conn->prepare($query);
      $sth->execute();
      //$this->throwException($sth->errorInfo());
      $objList = $sth->fetchAll();
      return $objList;
    }


    private function throwException($error){
       if($error[2] <> ""){
            $logger = Logger::getLogger("logger");
            $logger->error("Error occured :" . $error[2]);
            throw new Exception($error[2]);
       }
    }


    function startsWith($haystack, $needle){
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
     }

    function endsWith($haystack, $needle){
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }
        return (substr($haystack, -$length) === $needle);
    }
}
?>
