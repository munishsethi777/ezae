<?php
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
    
    public function getMatchingRule(){
        $params["adminseq"] = self::$adminSeq;
        $params["companyseq"] = self::$companySeq;
        $objList = self::$dataStore->executeConditionQuery($params);
        if(count($objList)> 0){
            return  $objList[0];
        }
        return null;  
    }
  }
?>
