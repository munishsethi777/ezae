<?php
    require_once($ConstantsArray['dbServerUrl']. "DataStores\\UserDataStore.php5");
    require_once($ConstantsArray['dbServerUrl']. "DataStores\\UserCustomFieldsDataStore.php5");
    
class UserMgr{
    
    private static $userMgr;
    
    public static function getInstance()
    {
        if (!self::$userMgr)
        {
            self::$userMgr = new UserMgr();           
            return self::$userMgr;
        }
        return self::$userMgr;        
    }
      
    public function getUsersByCompany($companySeq){
        $userDataStore = UserDataStore::getInstance();
        $users = $userDataStore->findByCompany($companySeq);
        return $users; 
    }
    
    public function getCustomFieldsByCompany($companySeq){
        $customFieldsDS = UserCustomFieldsDataStore::getInstance();
        $customFields = $customFieldsDS->findByCompany($companySeq);
        return $customFields; 
    }
    
    /*JSON Methods for Grids*/
    public function getUsersGridJSON($companySeq){
        $customFields = $this->getCustomFieldsByCompany($companySeq);
        $customFieldsJSON = self::getCustomFieldsGridHeadersJSON($customFields);
        $users =  $this->getUsersByCompany($companySeq);
        $usersJson = self::getUsersDataJson($users);
        
        $mainJsonArray = array();
        $mainJsonArray["columns"] = $customFieldsJSON;
        $mainJsonArray["data"] = $usersJson;
        return json_encode($mainJsonArray);
        
    }
    
    public static function getUsersDataJson($users){
        $fullArr = array();
        foreach($users as $user){
            $userObj = new User();
            $userObj = $user;
            $arr = array();
            $arr['id'] = $userObj->getSeq();
            $arr['username'] = $userObj->getUserName();
            $arr['password'] = $userObj->getPassword();
            $arr['emailid'] = $userObj->getEmailId();
            $arrCustomFields = self::getCustomValuesArray($userObj->getCustomFieldValues());
            $arr = array_merge($arr,$arrCustomFields);
            array_push($fullArr,$arr);     
        }
        return json_encode($fullArr);
    }
    
    public static function getCustomFieldsGridHeadersJSON($customFields){
        $fullArr = array();
        $arr = array();
        $arr['text'] = "User name";
        $arr['datafield'] = "username";
        array_push($fullArr,$arr);
        
        $arr = array();
        $arr['text'] = "Password";
        $arr['datafield'] = "password";
        array_push($fullArr,$arr);
        
        $arr = array();
        $arr['text'] = "EmailId";
        $arr['datafield'] = "emailid";
        array_push($fullArr,$arr);
        
        foreach($customFields as $customField){
            $field = new UserCustomField();
            $field = $customField;
            $arr = array();
            $arr['text'] = $field->getTitle();
            $arr['datafield'] = $field->getName();
            array_push($fullArr,$arr);     
        }
        return json_encode($fullArr);
           
    }
    
    public static function getCustomValuesArray($lines){
        $mainLineArray = explode(';', $lines);
        $mainArray = array();
        foreach($mainLineArray as $line){
            $nameValueArray = explode(':', $line);
            $mainArray[$nameValueArray[0]] = $nameValueArray[1];
        }
        return $mainArray;   
        
    }
}
    
?>
