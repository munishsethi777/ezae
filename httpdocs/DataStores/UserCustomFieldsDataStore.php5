<?php
 require_once("BeanDataStore.php5");
 require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/UserCustomField.php");
  
 class UserCustomFieldsDataStore extends BeanDataStore{       
    private static $userCustomFieldsDataStore;
     
    public static function getInstance()
    {
        if (!self::$userCustomFieldsDataStore)
        {
            self::$userCustomFieldsDataStore = new UserCustomFieldsDataStore("UserCustomField",UserCustomField::$tableName);           
                return self::$userCustomFieldsDataStore;
        }
        return self::$userCustomFieldsDataStore;        
    }
    
    
    
     public function findByCompany($companySeq){
        $colValuePair = array();
        /*'companyseq' is columnName*/ $colValuePair["companyseq"] = $companySeq;
        $userList = $this->executeConditionQuery($colValuePair);
        return $userList;
    }
    
    public function findByAdmin($adminSeq){
        $colValuePair = array();
        /*'companyseq' is columnName*/ $colValuePair["adminseq"] = $adminSeq;
        $userList = $this->executeConditionQuery($colValuePair);
        return $userList;
    }

    
       
    
 }
?>
