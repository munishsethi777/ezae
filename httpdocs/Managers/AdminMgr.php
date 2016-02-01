<?php
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/Module.php");
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/ManagerCriteria.php");
require_once($ConstantsArray['dbServerUrl']. "DataStores/AdminDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "DataStores/ModuleDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "DataStores/ActivityDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "Utils/ChartsUtil.php");
require_once($ConstantsArray['dbServerUrl']. "Utils/SessionUtil.php5");
require_once($ConstantsArray['dbServerUrl']. "Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl']. "Managers/SignupFormMgr.php");
require_once($ConstantsArray['dbServerUrl']. "StringConstants.php");
require_once($ConstantsArray['dbServerUrl']. "Managers/MatchingRuleMgr.php");
class AdminMgr{

    private static $adminMgr;
    private static $adminDataStore;
    private static $adminSeq;
    private static $sessionUtil;
    private static $managerCriteriaDataStore;

    public static function getInstance()
    {
        if (!self::$adminMgr)
        {
            self::$adminMgr = new AdminMgr();
            self::$adminDataStore = AdminDataStore::getInstance();
            self::$managerCriteriaDataStore = new BeanDataStore(ManagerCriteria::$className,ManagerCriteria::$tableName);
            self::$sessionUtil = SessionUtil::getInstance();
            self::$adminSeq = self::$sessionUtil->getAdminLoggedInSeq();
            return self::$adminMgr;
        }
        return self::$adminMgr;
    }
    //called from ajaxAdminMgr
    public function logInAdmin($username, $password){
        $adminDataStore = AdminDataStore::getInstance();
        $admin = new Admin();
        $admin = $adminDataStore->findByUserName($username);
        return $admin;
    }
    public function getSignupFormHeaderText(){
        $params["seq"] = self::$adminSeq;
        $attributes[0] = "signupformheader";
        $text = self::$adminDataStore->executeAttributeQuery($attributes,$params);
        if(count($text) > 0){
           return $text[0][0];
        }
        return null;
    }
    private function getSignupFormHeaderTextByAdmin($adminSeq){
        $params["seq"] = $adminSeq;
        $attributes[0] = "signupformheader";
        $text = self::$adminDataStore->executeAttributeQuery($attributes,$params);
        if(count($text) > 0){
           return $text[0][0];
        }
        return null;
    }
    public function isPasswordExist($password){
        $adminDataStore = AdminDataStore::getInstance();
        $sessionUtil = SessionUtil::getInstance();
        $adminSeq = $sessionUtil->getAdminLoggedInSeq();
        $params["password"] = $password;
        $params["seq"] = $adminSeq;
        $count = $adminDataStore->executeCountQuery($params);
        return $count > 0;
    }
    //called from ajaxAdminMgr
    public static function getModulesDataJson($companySeq){
        $modules = AdminMgr::getModulesByCompany($companySeq);
        $fullArr = array();
        foreach($modules as $module1){
            $moduleObj = new Module();
            $moduleObj = $module1;

            $arr = array();
            $arr['id'] = $moduleObj->getSeq();
            $arr['title'] = $moduleObj->getTitle();
            $arr['description'] = $moduleObj->getDescription();
            array_push($fullArr,$arr);
        }
        return json_encode($fullArr);
    }

    //called from ajaxAdminMgr
    public function getUsersGridJSON($companySeq){
        $customFieldsJSON = $this->getUserAllFieldsJsonByCompany($companySeq);
        $users =  $this->getUsersByCompany($companySeq);
        $usersJson = self::getUsersDataJson($users);

        $mainJsonArray = array();
        $mainJsonArray["columns"] = $customFieldsJSON;
        $mainJsonArray["data"] = $usersJson;
        return json_encode($mainJsonArray);

    }
    public function getLearnersWithCustomfields($companySeq){
        $userMgr = UserMgr::getInstance();
        $usersDS = UserDataStore::getInstance();
        $users = $usersDS->findByCompany($companySeq,true);
        $fullArr = array();
        $pagination = LearnerFilterUtil::getPagination();
        $start = $pagination["start"];
        $limit = $pagination["limit"];
        $count = 0;
        foreach($users as $user){
            $arr = array();
            $arr['id'] = $user["seq"]; 
            $arr['username'] = $user["username"];
            $arr['password'] = $user["password"];
            $arr['emailid'] = $user["emailid"];
            $profile = $userMgr->getUserLearningProfiles($user["seq"]);            
            $arr['prof_profiles'] = implode("," , $profile[1]);
            $arr['profileseqs'] = implode("," , $profile[0]);
            $arrCustomFields = ActivityMgr::getCustomValuesArray($user["customfieldvalues"]);
            $cus_flag = LearnerFilterUtil::applyFilterOnCustomfield($arrCustomFields);
            $prof_flag = LearnerFilterUtil::applyFilterOnCustomfield($arr,false);
            if($cus_flag && $prof_flag){
            }else{
                continue;
            }
            $arr = array_merge($arr,$arrCustomFields);
            $arr["lastmodifiedon"] = $user["lastmodifiedon"];
            array_push($fullArr,$arr);
            $count++;
        }
        $fullArr = LearnerFilterUtil::sortByCustomField($fullArr);
        $fullArr = array_slice($fullArr, $start, $limit);
        $mainJsonArray = array();
        $mainJsonArray["Rows"] = $fullArr;
        $mainJsonArray["TotalRows"] = $count;
        return $mainJsonArray;
    }
    public function getLearnersForExports($exportOption,$seqs){
        $userMgr = UserMgr::getInstance();
        $usersDS = UserDataStore::getInstance();
        $companySeq = self::$sessionUtil->getAdminLoggedInCompanySeq();
        if($exportOption == StringConstants::ALL_ROWS){
            $users = $usersDS->findByCompany($companySeq);    
        }else{
            $users = $usersDS->findBySeqs($seqs);
        }        
        $fullArr = array();
        foreach($users as $user){
            $arr = array(); 
            $arr['UserName'] = $user["username"];
            $arr['Password'] = $user["password"];
            $arr['Email'] = $user["emailid"];
            $arrCustomFields = ActivityMgr::getCustomValuesArray($user["customfieldvalues"]);
            $arr = array_merge($arr,$arrCustomFields);
            array_push($fullArr,$arr);
        }
        return $fullArr;
    }
    public function getLearnersWithCustomFieldsGridJSON($companySeq){
        $mainJsonArray = $this->getLearnersWithCustomfields($companySeq);   
        return json_encode($mainJsonArray);
    }

    public function getLearnerGridHeaders($companySeq){
        $userFieldsJSON = $this->getUserAllFieldsJsonByCompany($companySeq);
        $userFieldsArr = json_decode($userFieldsJSON);
        unset($userFieldsArr[2]);// removing password field
        $userMgr = UserMgr::getInstance();
        $usersDS = UserDataStore::getInstance();
        $isApplyFilter = true;
        $users = $usersDS->findByCompany($companySeq,$isApplyFilter);
        $mainJsonArray = array();
        $mainJsonArray["columns"] = json_encode($userFieldsArr);
        $dataFieldsArr = $this->getDataFieldsArr($userFieldsArr);
        $mainJsonArray["datafields"] = json_encode($dataFieldsArr);
        return json_encode($mainJsonArray);
    }
 
    //called from ajaxAdminMgr
    public function getActivitiesGridHeardersJSON($companySeq,$moduleSeq){
        $userFieldsJSON = $this->getUserAllFieldsJsonByCompany($companySeq);
        $userFieldsArr = json_decode($userFieldsJSON);
        unset($userFieldsArr[0]);//removing id field
        unset($userFieldsArr[5]);//removing profileseq field
        $searchedValue = "lastmodifiedon";
        $neededObject = array_filter($userFieldsArr,
        function ($e) use (&$searchedValue) {
            return $e->datafield == $searchedValue;
        }
        );
        unset($userFieldsArr[key($neededObject)]);
        
       
        
        $arr = array();
        $arr['text'] = "Date of Registration";
        $arr['datafield'] = "u.createdon";
        $arr['type'] = "date";
        $arr['cellsformat'] =  "MM-dd-yyyy hh:mm:ss tt";
        array_push($userFieldsArr,$arr);
        
        $arr = array();
        $arr['text'] = "Date of Completion";
        $arr['datafield'] = "a.dateofplay";
        $arr['type'] = 'date';
        $arr['cellsformat'] =  "MM-dd-yyyy hh:mm:ss tt";          
        array_push($userFieldsArr,$arr);
        
        $arr = array();
        $arr['text'] = "Progress";
        $arr['datafield'] = "progress";
        $arr['type'] = "number";
        array_push($userFieldsArr,$arr);
        $arr = array();
        $arr['text'] = "Score";
        $arr['datafield'] = "score";
        $arr['type'] = "number";
        array_push($userFieldsArr,$arr);
        
        $mainJsonArray = array();
        $mainJsonArray["columns"] = json_encode($userFieldsArr);
        $dataFieldsArr = $this->getDataFieldsArr($userFieldsArr);//for column types
        $mainJsonArray["datafields"] = json_encode($dataFieldsArr);;

        return json_encode($mainJsonArray);
    }
    
    public function getActivitiesGridJSON($companySeq,$moduleSeq,$lpSeq){
        $activityDS = ActivityDataStore::getInstance();
        $activityMgr = ActivityMgr::getInstance();
        $userSeqs = $activityMgr->getUserSeqsByCustomFieldCriteria();
        $data = $activityDS->getUsersActivity($moduleSeq,$companySeq,$lpSeq,$userSeqs,true);
        $fullArr = array();
        $pagination = LearnerFilterUtil::getPagination();
        $start = $pagination["start"];
        $limit = $pagination["limit"];
        $count = 0;
        $userMgr = UserMgr::getInstance();
        foreach($data as $dataArr){
            $arr = array();
            $arr['id'] = $dataArr['seq'];
            $arr['username'] = $dataArr['username'];
            $arr['password'] = $dataArr['password'];
            $arr['emailid'] = $dataArr['emailid'];
            $profile = $userMgr->getUserLearningProfiles($dataArr['seq']);
            $arr['prof_profiles'] = implode(",",$profile[1]);
            $arrCustomFields = ActivityMgr::getCustomValuesArray($dataArr['customfieldvalues']);
            $cus_flag = LearnerFilterUtil::applyFilterOnCustomfield($arrCustomFields);
            $prof_flag = LearnerFilterUtil::applyFilterOnCustomfield($arr,false);   
            if($cus_flag && $prof_flag){
            }else{
                continue;
            }
            $arr = array_merge($arr,$arrCustomFields);
            $arr['score'] = $dataArr['score'];
            $arr['progress'] = $dataArr['progress'];
            $arr['u.createdon'] = $dataArr['createdon'];
            $arr['a.dateofplay'] = $dataArr['dateofplay'];
            $arr["lastmodifiedon"] = $dataArr["lastmodifiedon"];
            array_push($fullArr,$arr);
            $count++;
        }
        $fullArr = LearnerFilterUtil::sortByCustomField($fullArr);
        $fullArr = array_slice($fullArr, $start, $limit);
        $mainJsonArray = array();
        $mainJsonArray["Rows"] = $fullArr;
        $mainJsonArray["TotalRows"] = $count;
        return json_encode($mainJsonArray);
    }

    //called from ajaxAdminMgr
    public function getCustomFieldsJSON($companySeq){
        $customFields =  $this->getCustomFieldsByCompany($companySeq);
        $customFieldsJSON = $this->getUserFieldsGridHeadersJSON($customFields, true);
        return $customFieldsJSON;

    }
    //called from ActivityAction
     public function getCustomFields($companySeq){
        $customFields =  $this->getCustomFieldsByCompany($companySeq);
        $customFieldsJSON = $this->getUserFieldsGridHeadersJSON($customFields);
        return $customFieldsJSON;

    }
    //called from ajaxAdminMgr for registration form settings
    public function getLearnersFieldsForFormManagementHtml($adminSeq){
        $customFieldsFormGenerator = CustomFieldsFormGenerator::getInstance();
        $signupFieldMgr = SignupFormMgr::getInstance();
        $customFields = $signupFieldMgr->getSignupFormFields($adminSeq);
        $isExists =  count($customFields) > 0;
        if(!$isExists){
            $customFields =  $this->getCustomFieldsByAdmin($adminSeq);
        }
        $html = $customFieldsFormGenerator->getDivsForFormSettings($customFields,$isExists);
        $adminMgr = AdminMgr::getInstance();
        $headerText = $adminMgr->getSignupFormHeaderText();
        $response = array();
        $response["html"] = $html;
        $response["headerText"] = $headerText;
        return json_encode($response);
    }

    //called from ajaxAdminMgr for compartive data
    public function getModuleComparativeForChart($learningPlanSeq,$moduleSeq, $customFieldName, $criteria,$companySeq){
        $chartsUtil = ChartsUtil::getInstance();
        $data = $chartsUtil->getComparativeData($learningPlanSeq,$moduleSeq, $customFieldName, $criteria,$companySeq);
        return $data;
    }

    //called from ajaxAdminMgr for completion data
    public function getModuleCompletionForChart($learningPlanSeq,$moduleSeq, $mode){
        $chartsUtil = ChartsUtil::getInstance();
        $data = $chartsUtil->getCompletionData($learningPlanSeq,$moduleSeq, $mode);
        return $data;
    }

    //called from ajaxAdminMgr for performance data
    public function getModulePercentagePerformanceForChart($learningPlanSeq,$moduleSeq,$percentage){
        $chartsUtil = ChartsUtil::getInstance();
        $data = $chartsUtil->getPassPercentData($learningPlanSeq,$moduleSeq,$percentage);
        return $data;
    }

    //called from ajaxAdminMgr for performance page table MMM
    public function getMeanMedianModeOfPassPercent($learningPlanSeq,$moduleSeq){
        $activityMgr = ActivityMgr::getInstance();
        $data = $activityMgr->getMeanMedianModePassPercentForPerformance($learningPlanSeq,$moduleSeq);
        return $data;
    }

    //Private Modules Method
    private static function getModulesByCompany($companySeq){
        $moduleDataStore = ModuleDataStore::getInstance();
        $modules = $moduleDataStore->findByCompanySeq($companySeq);
        return $modules;
    }

    //Users Extraction
    private function getUsersByCompany($companySeq){
        $userDataStore = UserDataStore::getInstance();
        $users = $userDataStore->findByCompany($companySeq);
        return $users;
    }

    private function getCustomFieldsByCompany($companySeq){
        $customFieldsDS = UserCustomFieldsDataStore::getInstance();
        $customFields = $customFieldsDS->findByCompany($companySeq);
        return $customFields;
    }
    
    private function getCustomFieldsByAdmin($adminSeq){
        $customFieldsDS = UserCustomFieldsDataStore::getInstance();
        $customFields = $customFieldsDS->findByAdmin($adminSeq);
        return $customFields;
    }

    private function getUserAllFieldsJsonByCompany($companySeq){
        $customFields = $this->getCustomFieldsByCompany($companySeq);
        $userFieldsJSON = self::getUserFieldsGridHeadersJSON($customFields);
        return $userFieldsJSON;
    }

    public function updateHeaderText($headerText,$adminSeq){
        $adminDataStore = AdminDataStore::getInstance();
        $adminDataStore->updateHeaderText($headerText,$adminSeq);
    }

    private static function getUsersDataJson($users){
        $fullArr = array();
        foreach($users as $user){
            $userObj = new User();
            $userObj = $user;
            $arr = array();
            $arr['id'] = $userObj->getSeq();            
            $arr['username'] = $userObj->getUserName();
            $arr['password'] = $userObj->getPassword();
            $arr['emailid'] = $userObj->getEmailId();           
            $arr['profiles'] = $userObj->getEmailId();
            $arr['profileseqs'] = "";
            $arrCustomFields = ActivityMgr::getCustomValuesArray($userObj->getCustomFieldValues());
            $arr = array_merge($arr,$arrCustomFields);
            $arr['lastmodifiedon'] = $userObj->getLastModifiedOn();
            array_push($fullArr,$arr);
        }
        return json_encode($fullArr);
    }

    private static function getUserFieldsGridHeadersJSON($customFields,$isOnlyCustomFields = false){
        $fullArr = array();
        $userNameMapping ="";
        $passwordMapping = "";
        $emailMapping = "";
        if($isOnlyCustomFields == false){
            $mappingMgr  = MatchingRuleMgr::getInstance();
            $mapping = $mappingMgr->getMatchingRule();
            $userNameMapping = $mapping->getUserNameField();
            $passwordMapping = $mapping->getPasswordField();
            $emailMapping = $mapping->getEmailField();
            
            
            $arr = array();
            $arr['text'] = "id";
            $arr['datafield'] = "id";
            $arr['type'] = "integer";
            $arr['hidden'] = true;
            array_push($fullArr,$arr);
            
           
            
                $arr = array();
                $arr['text'] = "User name";
                $arr['datafield'] = "username";
                $arr['type'] = "string";
                array_push($fullArr,$arr);    
          
           
           
                $arr = array();
                $arr['text'] = "Password";
                $arr['datafield'] = "password";
                $arr['type'] = "string";
                array_push($fullArr,$arr);
            
            
            
          
          
                $arr = array();
                $arr['text'] = "EmailId";
                $arr['datafield'] = "emailid";
                $arr['type'] = "string";
                array_push($fullArr,$arr);
           
           
            $arr = array();
            $arr['text'] = "Profiles";
            $arr['datafield'] = "prof_profiles";
            $arr['type'] = "string";
            array_push($fullArr,$arr);
            
            $arr = array();
            $arr['text'] = "profileseqs";
            $arr['datafield'] = "profileseqs";
            $arr['type'] = "string"; 
             $arr['hidden'] = true;          
            array_push($fullArr,$arr);


        }

        foreach($customFields as $customField){
            $field = new UserCustomField();
            $field = $customField;
            $arr = array();
            $arr['text'] = $field->getTitle();
            $prefix = "cus_";
            if($field->getName() != $userNameMapping && $field->getName() != $passwordMapping && $field->getName() != $emailMapping ){
                $arr['datafield'] = $prefix . $field->getName();
                $arr['type'] = $field->getFieldType();
                $arr['filtertype'] = "custom";
                if($field->getFieldType() == "date"){
                    $arr['cellsformat'] = "d";
                    //$arr['filtertype'] = "date";
                }
                array_push($fullArr,$arr);    
            }
            
        }
            $arr = array();
            $arr['text'] = "Modified On";
            $arr['datafield'] = "lastmodifiedon";
            $arr['type'] = "date";
            $arr["filtertype"] = 'date';
            $arr['cellsformat'] = "MM-dd-yyyy hh:mm:ss tt";

            array_push($fullArr,$arr);
        return json_encode($fullArr);

    }

    private function isFieldMapped($fieldName){
       if($field->getName() != $userNameMapping){ 
       }    
    }
    private static function getDataFieldsArr($customFieldsArr){
        $dataFieldsArr = array();
        foreach($customFieldsArr as $customField){
            $arr = array();
            //differntiate if its stdClass or a gneral array
            //because some fields are added manually
            if(is_array($customField)){
                $arr['name'] =  $customField['datafield'];
                $arr['type'] =  $customField['type'];
            }else{
                $arr['name'] =  $customField->datafield;
                $arr['type'] =  $customField->type;
            }
            array_push($dataFieldsArr,$arr);
        }
        return $dataFieldsArr;
    }
    public function checkValidations($admin){
        if($this->isExist($admin,$admin->getUserName(),"username")){
            throw new Exception(StringConstants::ADMIN_USERNAME_EXIST);
        }
        if($this->isExist($admin,$admin->getEmailId(),"emailid")){
            throw new Exception(StringConstants::ADMIN_EMAIL_EXIST);
        } 
        if($this->isExist($admin,$admin->getMobileNo(),"mobileno")){
            throw new Exception(StringConstants::ADMIN_MOBILE_EXIST);
        }       
    }
    private function isExist($admin,$value,$attrName){
        $seq = $admin->getSeq();
        $att[0] = $attrName;
        $att[1] = "seq";
        $colVal[$attrName] = $value;
        $ADS = AdminDataStore::getInstance();
        $existingAdmin = $ADS->executeAttributeQuery($att,$colVal);
        $isExist = false;
        if(!empty($existingAdmin)){   
            if(empty($seq) || $seq != $existingAdmin[0]["seq"]){
                $isExist = true;        
            }
        }
        return $isExist;
    }
    public function getAdminObjectFromRequest(){
            $name = $_GET["adminName"];
            $username = $_GET["adminUserName"];
            $password = $_GET["adminPassword"];
            $email = $_GET["adminEmail"];
            $mobile = $_GET["adminMobile"];
            $isUpdate = "";
            if(isset($_GET["isUpdate"])){
               $isUpdate = $_GET["isUpdate"];    
            }
            $admin = new Admin();            
            $admin->setName($name);
            $admin->setUserName($username);
            $admin->setPassword($password); //TODO -- save encrypted password --
            $admin->setEmailId($email);
            $admin->setMobileNo($mobile);
            $admin->setIsSuper(false);
            $admin->setIsEnabled(true);
            $admin->setLastModifiedOn(new DateTime());
            $admin->setCreatedOn(new DateTime());
            if($isUpdate == "true"){
                $sessionUtil = SessionUtil::getInstance();
                $seq = $sessionUtil->getAdminLoggedInSeq();
                $admin->setSeq($seq);
            }
            return $admin;
    }
    public function saveAdmin($admin,$companySeq){
        $admin->setCompanySeq($companySeq);
        $ADS = AdminDataStore::getInstance();
        $id = $ADS->save($admin);
        if($id > 0){
            $sessionUtil = SessionUtil::getInstance();
            $sessionUtil->createAdminSession($admin);
        }
    }
    //calling from manager action for save manager
    public function saveAdminManager($admin){
        $ADS = AdminDataStore::getInstance();
        $id = $ADS->save($admin);
        return $id;
    }
    public function ChangePassword($password){
        $adminDataStore = AdminDataStore::getInstance();
        $sessionUtil = SessionUtil::getInstance();
        $adminSeq = $sessionUtil->getAdminLoggedInSeq();
        $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
        $adminDataStore->ChangePassword($password,$adminSeq);
    }

     public function FindBySeq($seq){
        $adminDataStore = AdminDataStore::getInstance();
        $adminObj =  new Admin();
        $adminObj = $adminDataStore->findBySeq($seq);
        return $adminObj;
    }
    //Calling form adminManagers->ManagerAction.php for save manager criteria
    public function SaveManagerCriteria($managerCriteria){
        $id = self::$managerCriteriaDataStore->save($managerCriteria);
        return $id;
    }
    //calling from manager action for delete managers from grid
    public function deleteManager($managerIds){
        self::$adminDataStore->deleteInList($managerIds);
        $this->deleteManagerCriteria($managerIds);
    }

    //calling from manager action
    public function deleteManagerCriteria($managerIds){
        $colValue["managerseq"] = $managerIds;
        self::$managerCriteriaDataStore->deleteByAttribute($colValue);
    }



    //calling from manager action for show the managers on grid
    private function FindManagers($isApplyFilter = false){
        $parentAdminSeq = self::$sessionUtil->getAdminLoggedInSeq();
        $colValue["ismanager"] = true;
        $colValue["parentadminseq"] =  $parentAdminSeq;
        $managerList = self::$adminDataStore->executeConditionQuery($colValue,$isApplyFilter);
        return $managerList;
    }
    //Calling from ManagerAction for show the managers on grid
    public function getManagersForGrid(){
        $isApplyFilter  = true;
        $managers = $this->FindManagers($isApplyFilter);
        $mainArr["Rows"] = $this->toJsonArray($managers);
        $mainArr["TotalRows"] =  $this->getManagerCount();
        $jsonString = json_encode($mainArr);
        return $jsonString;
    }

    private function getManagerCount(){
        $colValue["ismanager"] = true;
        return self::$adminDataStore->executeCountQuery($colValue,true);
    }

    
    //Calling from learningPlanMgr show the learningPlan in reporting section
    public function findLoggedinManagerCriteria(){
        $managerId = self::$sessionUtil->getAdminLoggedInSeq();
        $colValue["managerseq"] = $managerId;
        $managerCriteria = self::$managerCriteriaDataStore->executeConditionQuery($colValue);
        if(!empty($managerCriteria)){
            return $managerCriteria[0];    
        } 
        return null ;
    }

    //calling from adminManagers.php with ajax call for show the data in edit case
    public function getManagerCriteriaDetail($id){
        $colValue["managerseq"] = $id;
        $attributes[0] = "criteriatype";
        $attributes[1] = "criteriavalue";
        $managers = self::$managerCriteriaDataStore->executeAttributeQuery($attributes,$colValue);
        $manager = $managers[0];
        $criteriaType = $manager["criteriatype"];
        $criteriaValue = $manager["criteriavalue"];
        if($criteriaType == ManagerCriteriaType::CUSTOM_FIELD){
            $lines = explode(";",$criteriaValue);
            foreach($lines as $line)
            {
                list($key, $value) = explode(":", $line);
                $array[$key] = explode(",", $value);
            }
            $criteriaValue = $array;
        }
        $mainArr["criteriatype"] = $criteriaType;
        $mainArr["criteriavalue"] = $criteriaValue;
        $json = json_encode($mainArr);
        return $json;
    }

    private static function toJsonArray($managers){
        $fullArr = array();
        foreach($managers as $manager){
            $adminObj = new Admin();
            $adminObj = $manager;
            $arr = array();
            $arr['id'] = $adminObj->getSeq();
            $arr['username'] = $adminObj->getUserName();
            $arr['name'] = $adminObj->getName();
            $arr['password'] = $adminObj->getPassword();
            $arr['emailid'] = $adminObj->getEmailId();
            $arr['mobile'] = $adminObj->getMobileNo();
            array_push($fullArr,$arr);
        }
        return $fullArr;
    }
    
    //called from SignupFormAction for signup form loading
    public function getSignupFormDetails($adminSeq,$companyseq){
        $signupFieldMgr = SignupFormMgr::getInstance();
        $customFields = $signupFieldMgr->getSignupFormFields($adminSeq);
        $headerText = $this->getSignupFormHeaderTextByAdmin($adminSeq);
        $matchingRuleMgr = MatchingRuleMgr::getInstance();
        $matchingRule = $matchingRuleMgr->getRequiredMatchingRules($adminSeq,$companyseq);
        $response = array();
        $response["fields"] = $customFields;
        $response["headerText"] = $headerText;
        $response["matchingrule"] = $matchingRule;
        return $response;
    }
}
?>
