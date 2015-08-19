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
    public function getLearnersWithCustomFieldsGridJSON($companySeq){
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
            $arr['emailid'] = $user["emailid"];
            $profile = $userMgr->getUserLearningProfiles($user["seq"]);
            $arr['prof_profiles'] = $profile;
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

   private function FilterUserGridData(){

   }
    //called from ajaxAdminMgr
    public function getActivitiesGridHeardersJSON($companySeq,$moduleSeq){
        $userFieldsJSON = $this->getUserAllFieldsJsonByCompany($companySeq);
        $userFieldsArr = json_decode($userFieldsJSON);
        unset($userFieldsArr[1]);//removing password field

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
    
    public function getActivitiesGridJSON($companySeq,$moduleSeq){
        $activityDS = ActivityDataStore::getInstance();
        $data = $activityDS->getUsersAndActivity($moduleSeq,$companySeq,true);
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
            //$arr['password'] = $dataArr['password'];
            $profile = $userMgr->getUserLearningProfiles($dataArr['seq']);
            $arr['prof_profiles'] = $profile;
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

    //called from ajaxAdminMgr for registration form settings
    public function getLearnersFieldsForFormManagementHtml($companySeq){
        $customFieldsFormGenerator = CustomFieldsFormGenerator::getInstance();
        $signupFieldMgr = SignupFormMgr::getInstance();
        $customFields = $signupFieldMgr->getSignupFormFields($companySeq);
        $isExists =  count($customFields) > 0;
        if(!$isExists){
            $customFields =  $this->getCustomFieldsByCompany($companySeq);
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
            $arrCustomFields = ActivityMgr::getCustomValuesArray($userObj->getCustomFieldValues());
            $arr = array_merge($arr,$arrCustomFields);
            $arr['lastmodifiedon'] = $userObj->getLastModifiedOn();
            array_push($fullArr,$arr);
        }
        return json_encode($fullArr);
    }

    private static function getUserFieldsGridHeadersJSON($customFields,$isOnlyCustomFields = false){
        $fullArr = array();
        if($isOnlyCustomFields == false){
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


        }

        foreach($customFields as $customField){
            $field = new UserCustomField();
            $field = $customField;
            $arr = array();
            $arr['text'] = $field->getTitle();
            $prefix = "cus_";
            $arr['datafield'] = $prefix . $field->getName();
            $arr['type'] = $field->getFieldType();
            $arr['filtertype'] = "custom";
            if($field->getFieldType() == "date"){
                $arr['cellsformat'] = "d";
                //$arr['filtertype'] = "date";
            }
            array_push($fullArr,$arr);
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

    public function saveAdmin($companySeq){
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
            $admin->setCompanySeq($companySeq);
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
}
?>
