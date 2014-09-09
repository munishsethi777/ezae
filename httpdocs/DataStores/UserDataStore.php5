<?php
 require_once("BeanDataStore.php5");

 require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/User.php5"); 

 class UserDataStore extends BeanDataStore{       
    private static $userDataStore ;
    public static function getInstance()
    {
        if (!self::$userDataStore)
        {
            self::$userDataStore = new UserDataStore("User",User::$tableNames);    
                return self::$userDataStore;
        }
        return self::$userDataStore;        
    }
    
    public function findByUserName($userName){
        $colValuePair = array();
        $colValuePair["username"] = $userName;
        $userList = $this->executeConditionQuery($colValuePair);
        if(sizeof($userList) > 0){
            return $userList[0];
        }
        return null;
    }
    
     public function findByCompany($companySeq){
        $colValuePair = array();
        /*'companyseq' is columnName*/ $colValuePair["companyseq"] = $companySeq;
        $userList = $this->executeConditionQuery($colValuePair);
        return $userList;
    }
    
      public function findCustomfield($userSeq){
        $attributes = array("customfieldValues");
        $colValuePair = array();
        $colValuePair["seq"] = $userSeq;
        $colList = $this->executeAttributeQuery($attributes,$colValuePair);
        if(sizeof($colList) > 0){
            return $colList[0]["customfieldValues"];
        } 
      }
    
       
    
 }
?>
