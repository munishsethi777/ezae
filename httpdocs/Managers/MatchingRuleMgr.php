<?php
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/MatchingRule.php");
  class MatchingRuleMgr{
    private static $matchingRuleMgr;
    private static $dataStore;
    private static $adminSeq;
    private static $companySeq;
    private static $sessionUtil;


    public static function getInstance()
    {
        if (!self::$matchingRuleMgr)
        {
            self::$matchingRuleMgr = new MatchingRuleMgr();
            self::$dataStore = new BeanDataStore(MatchingRule::$className,MatchingRule::$tableName);
            self::$sessionUtil = SessionUtil::getInstance();   
            self::$adminSeq = self::$sessionUtil->getAdminLoggedInSeq(); 
            self::$companySeq = self::$sessionUtil->getAdminLoggedInCompanySeq();           
            return self::$matchingRuleMgr;
        }
        return self::$matchingRuleMgr;
    }
    
    public function findNameForCustomfield($customFieldName){
        $objList  = self::$dataStore->findAllByCompany();
        $machingRule = new MatchingRule();
        if(count($objList)>0){
            $machingRule = $objList[0];        
        }
        $fieldName = "";
        if($machingRule->getUserNameField() == $customFieldName){
             $fieldName = "usernamefield";        
        }
        if($machingRule->getPasswordField() == $customFieldName){
             $fieldName = "passwordfield";
        }
        if($machingRule->getEmailField() == $customFieldName){
            $fieldName = "emailfield";
        }
        return $fieldName;        
    }
    
    public function saveMatchingRule($matchingRule){
        $this->deleteMatchingRule();
        $id = self::$dataStore->save($matchingRule);
        return $id;  
    }
        
     public function SaveOrUpdateByCompany($value,$attribute,$mappedField){
        $id = 0;
        if($attribute != "" || $mappedField != ""){
            $matchingRule = new MatchingRule();
            $matchingRule->setAdminSeq(self::$adminSeq);
            $matchingRule->setCompanySeq(self::$companySeq);
            $colValuePair  = array();
            $objList =self::$dataStore->findAllByCompany();
            if(count($objList) > 0){
                $matchingRule =  $objList[0];
            }
            $this->resetOldMappedField($matchingRule,$mappedField);
            if($attribute == "usernamefield"){
                $matchingRule->setUserNameField($value);        
            }else if($attribute == "passwordfield"){
                $matchingRule->setPasswordField($value);    
            }else if($attribute == "emailfield"){
                $matchingRule->setEmailField($value);    
            }
            $id = self::$dataStore->save($matchingRule);    
        }
        
        return $id;        
    }
    
    function resetOldMappedField($matchingRule,$mappedField){
        if($mappedField == "usernamefield"){
            $matchingRule->setUserNameField(null);        
        }else if($mappedField == "passwordfield"){
            $matchingRule->setPasswordField(null);    
        }else if($mappedField == "emailfield"){
            $matchingRule->setEmailField(null);    
        }    
    }
    
    public function deleteMatchingRule(){
        self::$dataStore->deleteAllByCompany();
    }
    
    //calling from adminMgr for construct the user signup form
    public function getRequiredMatchingRules($adminSeq_,$companySeq_){
        self::$adminSeq = $adminSeq_;
        self::$companySeq = $companySeq_;
        $matchingRule = $this->getMatchingRule();
        $obj = new MatchingRule();
        $obj = $matchingRule;
        $arr = array();
        $arr["usernamefield"] = $obj->getUserNameField();
        $arr["passwordfield"] = $obj->getPasswordField();
        return $arr;  
    }
    
    public function getMatchingRule(){
        $params["adminseq"] = self::$adminSeq;
        $params["companyseq"] = self::$companySeq;
        $obj = new MatchingRule();
        $objList = self::$dataStore->executeConditionQuery($params);
        if(count($objList)> 0){
            $obj = $objList[0];
        }
        return $obj;  
    }
    //Calling From CustomFieldAction 
    public function getUncompletedBinding(){
        $params["adminseq"] = self::$adminSeq;
        $unCompletedFields = array();        
        array_push($unCompletedFields,"UserName");
        array_push($unCompletedFields,"Password");
        $objList = self::$dataStore->executeConditionQuery($params);
        if(count($objList)> 0){
            $matchingrule = $objList[0];
            $username = $matchingrule->getUserNameField();
            $password = $matchingrule->getPasswordField();
            if(!empty($username)){
                unset($unCompletedFields[0]);
            }
            if(!empty($password)){
                unset($unCompletedFields[1]);
            }
        }
        return $unCompletedFields;  
    }
  }
?>
