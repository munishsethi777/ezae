<?php
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/Module.php");
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


    public static function getInstance()
    {
        if (!self::$adminMgr)
        {
            self::$adminMgr = new AdminMgr();
            self::$adminDataStore = AdminDataStore::getInstance();
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
        $userFieldsJSON = $this->getUserAllFieldsJsonByCompany($companySeq);
        $userFieldsArr = json_decode($userFieldsJSON);
        unset($userFieldsArr[2]);//removing password field
        $userMgr = UserMgr::getInstance();
        $usersDS = UserDataStore::getInstance();
        $users = $usersDS->findByCompany($companySeq);
        $fullArr = array();
        foreach($users as $userObj){
            $user = new User();
            $user = $userObj;
            $arr = array();
            $arr['id'] = $user->getSeq();
            $arr['username'] = $user->getUserName();
            $arr['emailid'] = $user->getEmailId();
            $profile = $userMgr->getUserLearningProfiles($user->getSeq());
            $arr['profiles'] = $profile;
            //$arr['password'] = $dataArr['password'];
            $arrCustomFields = ActivityMgr::getCustomValuesArray($user->getCustomFieldValues());
            $arr = array_merge($arr,$arrCustomFields);
            $arr["lastmodifiedon"] = $user->getLastModifiedOn();
            array_push($fullArr,$arr);
        }

        $mainJsonArray = array();
        $mainJsonArray["columns"] = json_encode($userFieldsArr);
        $mainJsonArray["data"] = json_encode($fullArr);
        $dataFieldsArr = $this->getDataFieldsArr($userFieldsArr);//for column types
        $mainJsonArray["datafields"] = json_encode($dataFieldsArr);;

        return json_encode($mainJsonArray);
    }

    //called from ajaxAdminMgr
    public function getActivitiesGridJSON($companySeq,$moduleSeq){
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

        $activityDS = ActivityDataStore::getInstance();
        $data = $activityDS->getUsersAndActivity($moduleSeq,$companySeq);
        $fullArr = array();
        foreach($data as $dataArr){

            $arr = array();
            $arr['id'] = $dataArr['useq'];
            $arr['username'] = $dataArr['username'];
            //$arr['password'] = $dataArr['password'];
            $arrCustomFields = ActivityMgr::getCustomValuesArray($dataArr['customfieldvalues']);
            $arr = array_merge($arr,$arrCustomFields);
            $arr['score'] = $dataArr['score'];
            $arr['progress'] = $dataArr['progress'];
            array_push($fullArr,$arr);
        }

        $mainJsonArray = array();
        $mainJsonArray["columns"] = json_encode($userFieldsArr);
        $mainJsonArray["data"] = json_encode($fullArr);
        $dataFieldsArr = $this->getDataFieldsArr($userFieldsArr);//for column types
        $mainJsonArray["datafields"] = json_encode($dataFieldsArr);;

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
    public function getModuleComparativeForChart($moduleSeq, $customFieldName, $criteria,$companySeq){
        $chartsUtil = ChartsUtil::getInstance();
        $data = $chartsUtil->getComparativeData($moduleSeq, $customFieldName, $criteria,$companySeq);
        return $data;
    }

    //called from ajaxAdminMgr for completion data
    public function getModuleCompletionForChart($moduleSeq, $mode){
        $chartsUtil = ChartsUtil::getInstance();
        $data = $chartsUtil->getCompletionData($moduleSeq, $mode);
        return $data;
    }

    //called from ajaxAdminMgr for performance data
    public function getModulePercentagePerformanceForChart($moduleSeq,$percentage){
        $chartsUtil = ChartsUtil::getInstance();
        $data = $chartsUtil->getPassPercentData($moduleSeq,$percentage);
        return $data;
    }

    //called from ajaxAdminMgr for performance page table MMM
    public function getMeanMedianModeOfPassPercent($moduleSeq){
        $activityMgr = ActivityMgr::getInstance();
        $data = $activityMgr->getMeanMedianModePassPercentForPerformance($moduleSeq);
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
            $arr['datafield'] = "profiles";
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
            $password = $_GET["adminPassword"];
            $email = $_GET["adminEmail"];
            $mobile = $_GET["adminMobile"];
            $isUpdate = $_GET["isUpdate"];
            $admin = new Admin();
            $admin->setCompanySeq($companySeq);
            $admin->setName($name);
            $admin->setUserName($name);
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

}
?>
