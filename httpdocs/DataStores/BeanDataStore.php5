<?php
  require_once("MainDB.php5");

  class BeanDataStore {

    private $className ;
    private $tableName ;

    public function __construct($className_,$tableName){
      $this->className  = $className_;
      $this->tableName = $tableName;
    }
   private function key_implode($array) {
         $fields = array();
         foreach($array as $field => $val) {
           $fields[] = "$field = '$val'";
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
//                        $value = "'" . $value . "'";
//                    }
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
          //$r=array();
         // array_walk($columnValueArry, create_function('$b, $c', 'global $r; $r[]="$c=$b";'));
          //$columnString = implode(', ', $r);
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
         
       }       
       $error = $STH->errorInfo();
       if($error[2] <> ""){
            throw new Exception($error[2]);
       } 
       $id = $conn->lastInsertId(); 
       return $id;
    }
    function findAll(){
       $db = MainDB::getInstance();
       $conn = $db->getConnection();
       $STH = $conn->prepare("select * from " . $this->tableName);
       $STH->execute();
       $objList = $STH->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->className);
       $error = $STH->errorInfo();
       if($error[2] <> ""){
              throw new Exception($error[2]);
       }
       return $objList ;
    }

    function findBySeq($seq){
       $db = MainDB::getInstance();
       $conn = $db->getConnection();
       $STH = $conn->prepare("select * from " . $this->tableName . " where seq = " . $seq);
       $STH->execute();
       $obj = $STH->fetchObject($this->className);
       $error = $STH->errorInfo();
       if($error[2] <> ""){
              throw new Exception($error[2]);
       }
       return $obj ;
    }

    public function deleteBySeq($seq){
        $db = MainDB::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("delete from " . $this->tableName . "where seq = " . $seq);
        $stmt->execute();
        $error = $stmt->errorInfo();
        throwException($error);
    }
    public function deleteInList($ids){
        $db = MainDB::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("delete from " . $this->tableName . " where seq in(" . $ids . ")");
        $stmt->execute();
        $error = $stmt->errorInfo();
        $this->throwException($error);
    }
    public function deleteAll(){
        $db = MainDB::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("delete from " . $this->tableName);
        $stmt->execute();
        $error = $stmt->errorInfo();
        $this->throwException($error);
    }

    public function executeConditionQuery($colValuePair){
       $query_array = array();
       foreach ($colValuePair as $key => $value)
       {
        ///if ($value != ''){
         $query_array[] = $key.' = '. "'" . $value . "'";//}
       }
        $query = "SELECT * FROM " .  $this->tableName;
        if(count($query_array) > 0){
            $query .= " WHERE " .implode(" AND ", $query_array);
        }

      $db = MainDB::getInstance();
      $conn = $db->getConnection();
      $sth = $conn->prepare($query);
      $sth->execute();
     //$sth->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
      $error = $sth->errorInfo();
      if($error[2] <> ""){
          throw new Exception($error[2]);
      }
      $objList = $sth->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->className);
      return $objList;
    }
    
    public function executeCountQuery($colValuePair = null){
       foreach ($colValuePair as $key => $value)
       {
        ///if ($value != ''){
         $query_array[] = $key.' = '. "'" . $value . "'";//}
       }
        $query = "SELECT count(*) FROM " .  $this->tableName;
        if($colValuePair != null){            
            $query .= " WHERE " .implode(" AND ", $query_array);                 
        }
      $db = MainDB::getInstance();
      $conn = $db->getConnection();
      $sth = $conn->prepare($query);
      $sth->execute();
      $error = $sth->errorInfo();
      if($error[2] <> ""){
          throw new Exception($error[2]);
      }
      $result = $sth->fetch(PDO::FETCH_NUM);
      $count = intval($result[0]);
      return $count;
    }
    
    public function executeQuery($query){
        $db = MainDB::getInstance();
        $conn = $db->getConnection();
        $sth = $conn->prepare($query);
        $sth->execute();
        $error = $sth->errorInfo();
         if($error[2] <> ""){
          throw new Exception($error[2]);
         }
         //$objList = $sth->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->className);
         $objList = $sth->fetchAll();
         return $objList;
    }

    public function executeAttributeQuery($attributes,$colValuePair){
       foreach ($colValuePair as $key => $value)
       {
        if ($value != '')
        { $query_array[] = $key.' = '. "'" . $value . "'";}
        }
      $columns = implode(", " , $attributes);
      $query = "SELECT " . $columns . " FROM " .  $this->tableName . " WHERE " .implode(" AND ", $query_array);
      $db = MainDB::getInstance();
      $conn = $db->getConnection();
      $sth = $conn->prepare($query);
      $sth->execute();
      $error = $sth->errorInfo();
      if($error[2] <> ""){
          throw new Exception($error[2]);
      }
      $objList = $sth->fetchAll();
      return $objList;
    }


   private function throwException($error){
       if($error[2] <> ""){
              throw new Exception($error[2]);
       }
    }


    function startsWith($haystack, $needle)
    {
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
     }

    function endsWith($haystack, $needle)
    {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
    }
  }
?>
