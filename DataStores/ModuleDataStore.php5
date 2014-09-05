<?php
  class ModuleDataStore extends BeanDataStore{
      
    private static $moduleDataStore;
     
    public static function getInstance()
    {
        if (!self::$moduleDataStore)
        {
            self::$moduleDataStore = new ModuleDataStore("Module");           
                return self::$moduleDataStore;
        }
        return self::$moduleDataStore;        
    }
    
    public function findByCompanySeq($companySeq){
        $colValuePair = array();
       /*'companyseq' is columnName*/ $colValuePair["companyseq"] = $companySeq;
        $moduleList = $this->executeConditionQuery($colValuePair);
        if(sizeof($moduleList) > 0){
            return $moduleList[0];
        }
        return null;
    }
  }
?>
