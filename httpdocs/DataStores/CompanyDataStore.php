<?php
require_once("BeanDataStore.php5");
 class CompanyDataStore extends BeanDataStore{       
    private static $beanDataStore ;
    private static $companyDataStore;
    
    public static function getInstance()
    {
        if (!self::$companyDataStore)
        {
            self::$companyDataStore = new CompanyDataStore("Company",Company::$tableName);           
            return self::$companyDataStore;
        }
        return self::$companyDataStore;        
    }
    public function findByUserName($name){
        $colValuePair = array();
       /*'name' is columnName*/ 
        $colValuePair["name"] = $name;
        $ComapnyList = $this->executeConditionQuery($colValuePair);
        if(sizeof($ComapnyList) > 0){
            return $ComapnyList[0];
        }
        return null;
    }
    
    public function FindBySeq($companySeq){
        $colValuePair = array(); 
        $colValuePair["seq"] = $companySeq;
        $ComapnyList = $this->executeConditionQuery($colValuePair);
        if(sizeof($ComapnyList) > 0){
            return $ComapnyList[0];
        }    
    }
    
    public function getPrefix($companySeq){
       $params = array();
       $params["seq"] = $companySeq;
       $attribute =  array();
       $attribute[0] = "prefix";
       $prefix = $this->executeAttributeQuery($attribute,$params);
       if(isset($prefix)){
         $prefix = $prefix[0][0];  
       }
       return $prefix;
    }
    
        
    public function updateCompanyPrefix($companySeq,$prefix){    
        $query = "update companies set prefix  = '$prefix' where seq = $companySeq ";
        $this->executeQuery($query);      
    }
    
 }
?>
