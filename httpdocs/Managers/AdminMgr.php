<?php
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/Module.php5");
require_once($ConstantsArray['dbServerUrl']. "DataStores/AdminDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "DataStores/ModuleDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "DataStores/ActivityDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "Utils/ChartsUtil.php");
class AdminMgr{

    private static $adminMgr;

    public static function getInstance()
    {
        if (!self::$adminMgr)
        {
            self::$adminMgr = new AdminMgr();
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

    private static function getUsersDataJson($users){
        $fullArr = array();
        foreach($users as $user){
            $userObj = new User();
            $userObj = $user;
            $arr = array();
            $arr['id'] = $userObj->getSeq();
            $arr['username'] = $userObj->getUserName();
            $arr['password'] = $userObj->getPassword();
            //$arr['emailid'] = $userObj->getEmailId();
            $arrCustomFields = ActivityMgr::getCustomValuesArray($userObj->getCustomFieldValues());
            $arr = array_merge($arr,$arrCustomFields);
            array_push($fullArr,$arr);
        }
        return json_encode($fullArr);
    }

    private static function getUserFieldsGridHeadersJSON($customFields,$isOnlyCustomFields = false){
        $fullArr = array();
        if($isOnlyCustomFields == false){
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
            //array_push($fullArr,$arr);
        }

        foreach($customFields as $customField){
            $field = new UserCustomField();
            $field = $customField;
            $arr = array();
            $arr['text'] = $field->getTitle();
            $arr['datafield'] = $field->getName();
            $arr['type'] = $field->getFieldType();
            if($field->getFieldType() == "date"){
                $arr['cellsformat'] = "d";
                //$arr['filtertype'] = "date";
            }
            array_push($fullArr,$arr);
        }
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

}
?>
