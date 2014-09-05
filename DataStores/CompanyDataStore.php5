<?php
require_once("BeanDataStore.php5");
 require_once("../BusinessObjects/Company.php5");
 class CompanyDataStore{       
    private static $beanDataStore ;
    private static $companyDataStore;
    
    public function __construct(){
       self::$beanDataStore = new BeanDataStore();
    }
    
    public static function getInstance()
    {
        if (!self::$companyDataStore)
        {
            self::$companyDataStore = new CompanyDataStore("Company");           
            return self::$companyDataStore;
        }
        return self::$companyDataStore;        
    }
    public function findByUserName($name){
        $colValuePair = array();
       /*'name' is columnName*/ $colValuePair["name"] = $name;
        $ComapnyList = $this->executeConditionQuery($colValuePair);
        if(sizeof($ComapnyList) > 0){
            return $ComapnyList[0];
        }
        return null;
    }
    
 }
?>
