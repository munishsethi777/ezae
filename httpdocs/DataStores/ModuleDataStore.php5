<?php
require_once("BeanDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects\\Module.php5");
 
class ModuleDataStore extends BeanDataStore{
    private static $moduleDataStore;
     
    public static function getInstance()
    {
        if (!self::$moduleDataStore)
        {
            self::$moduleDataStore = new ModuleDataStore("Module",Module::$tableName);           
                return self::$moduleDataStore;
        }
        return self::$moduleDataStore;        
    }
    
    public function findByCompanySeq($companySeq){
        $colValuePair = array();
       /*'companyseq' is columnName*/ $colValuePair["companyseq"] = $companySeq;
        $moduleList = $this->executeConditionQuery($colValuePair);
        return $moduleList;
    }
  }
?>
