<?php
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/SignupFormField.php");
require_once($ConstantsArray['dbServerUrl']. "DataStores/SignupFormFieldDataStore.php");
require_once($ConstantsArray['dbServerUrl']. "StringConstants.php"); 
require_once($ConstantsArray['dbServerUrl']. "Utils/SessionUtil.php5");  
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
    
    public function getSignupFormFields($adminSeq){
        $arrList = self::$dataStore->findByAdmin($adminSeq);
       // $defaultFields = $this->getDefaultFields();
        //if(!empty($defaultFields)){
           // $arrList = array_merge($defaultFields,$arrList);
        //}
        return $arrList;
    }
    public function getDefaultFields(){
        $matchingRuleMgr = MatchingRuleMgr::getInstance();
        $mapping = $matchingRuleMgr->getMatchingRule();
        $userNameMapping = $mapping->getUserNameField(); 
        $passwordMapping = $mapping->getPasswordField();     
        $emailMapping = $mapping->getEmailField();
        $fieldName = "";
        $title = "";
        $fields = array();
        if(empty($userNameMapping)){
            $fieldName = StringConstants::DEFAULT_USERNAME_FIELDNAME;
            $title = "User Name";
            $defaultField = $this->getDefaultField($fieldName,$title);
            array_push($fields,$defaultField);
        }
        if(empty($passwordMapping)){
            $fieldName = StringConstants::DEFAULT_PASSWORD_FIELDNAME;
            $title = "Password";
            $defaultField = $this->getDefaultField($fieldName,$title);
            array_push($fields,$defaultField);
        } 
        if(empty($emailMapping)){
             $fieldName =  StringConstants::DEFAULT_EMAIL_FIELDNAME;
             $title = "Email";
             $defaultField = $this->getDefaultField($fieldName,$title);
             array_push($fields,$defaultField);
        } 
        return $fields;
    }
    private function getDefaultField($fieldName,$title){
        $sessionUtil = SessionUtil::getInstance();
        $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
        $adminSeq = $sessionUtil->getAdminLoggedInSeq();
        $defaultField = array();
        $defaultField["adminseq"] =  $adminSeq;
        $defaultField["companyseq"] =  $companySeq; 
        $defaultField["name"] =  $fieldName;
        $defaultField["fieldtype"] =  "Text";
        $defaultField["isrequired"] =  1;
        $defaultField["isvisile"] =  1; 
        $defaultField["title"] =  $title; 
        return $defaultField;
    }
    
    public function deleteAll(){
        self::$dataStore->deleteAll();
    }

}
?>
