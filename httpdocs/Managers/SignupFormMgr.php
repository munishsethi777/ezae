<?php
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/SignupFormField.php");
require_once($ConstantsArray['dbServerUrl']. "DataStores/SignupFormFieldDataStore.php");
class SignupFormMgr{
    private static $signupFormMgr;
    private static $dataStore; 
    public static function getInstance(){
        if (!self::$signupFormMgr)
        {
            self::$signupFormMgr = new SignupFormMgr();
            self::$dataStore = SignupFormFieldDataStore::getInstance();
            return self::$signupFormMgr;
        }
        return self::$signupFormMgr;
    }
    
    public function SaveSignupFormFields($signupFieldForm){
        $id = self::$dataStore->save($signupFieldForm);
        return $id;
    }
    
    public function getSignupFormFields($companySeq){
        $arrList = self::$dataStore->findByCompany($companySeq);
        return $arrList;
    }
    
    public function deleteAll(){
        self::$dataStore->deleteAll();
    }

}
?>
