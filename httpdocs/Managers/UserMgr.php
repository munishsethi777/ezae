<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Classes/');
require_once($ConstantsArray['dbServerUrl']. "DataStores/UserDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "Utils/CustomFieldsFormGenerator.php");
require_once($ConstantsArray['dbServerUrl']. "Managers/ActivityMgr.php");
require_once($ConstantsArray['dbServerUrl']. "DataStores/UserCustomFieldsDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "Utils/StringUtil.php");
include $ConstantsArray['dbServerUrl'] . '//PHPExcel/IOFactory.php';

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

    public function logInUser($username, $password){
        $userDataStore = UserDataStore::getInstance();
        $user = $userDataStore->findByUserName($username);
        if ($user != null){
            $userObj = new User();
            $userObj = $user;
            if($userObj->getPassword() == $password){
                return $userObj;
            }
        }
        return null;
    }

    //Import Learners
    public function importLearners($file){
        //$inputFileName = 'sampleData/Users.xlsx';
        $inputFileName = $file['tmp_name'];
        //echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
       // echo '<hr />';
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        return $sheetData;
    }

    public function getLearnersFieldGridData($sheetData,$isFirstRowContainsFields,$isCustomfieldsExists){
        $firstRow = $sheetData[1];
        $i = 1;
        $dataFieldArr = array();
        $columnsArr = array();
        $fieldNameRow = array();
        $fieldTypeRow = array();
        $rows = array();
        
        foreach ($firstRow as $key => $value) {
            //if(!StringUtil::IsNullOrEmptyString($value)){
                $fieldName =  "field" . $i;
                $dataFields = array();
                $dataFields['name'] = $fieldName;
                $dataFields['type'] = "string";
                array_push($dataFieldArr,$dataFields);

                $col = array();
                $col['text'] = "Field " . $i;
                $col['datafield'] = $fieldName;
                $col['width'] = 250;
               
                $col['columntype'] = "custom";    

                array_push($columnsArr,$col);
                if($isFirstRowContainsFields){
                    $fieldNameRow[$fieldName] =  $value;
                }else if($isCustomfieldsExists){
                    $fieldNameRow[$fieldName] =  "Select Field";
                }
                else{
                    $fieldNameRow[$fieldName] =  "{FieldName}";
                }
                $fieldTypeRow[$fieldName] =   "Text";
            //}
            $i++;

        }
        array_push($rows,$fieldNameRow);
        if(!$isCustomfieldsExists){
            array_push($rows,$fieldTypeRow);
        }
        $mainJsonArray = array();
        $mainJsonArray["columns"] = $columnsArr;
        $mainJsonArray["rows"] = $rows;
        $mainJsonArray["dataFields"] = $dataFieldArr;
        $mainJsonArray["fieldNames"] = $fieldNameRow;
        $mainJsonArray["fieldTypes"] = $fieldTypeRow;
        $json = json_encode($mainJsonArray);
        //$replace_keys[] = '"' . "%createGridEditor%" . '"';
        //$value_arr[] = "createGridEditor";
        //$jsonStr = str_replace($replace_keys, $value_arr, $json);
        return $json;
    }
    private function getDataFieldsAndColumns($row){
        $fullArr = array();
        $colArr = array();
        $dataFieldArr = array();
        foreach ($row as $key => $value) {
            //if(!StringUtil::IsNullOrEmptyString($value)){
                $dataFields = array();
                $dataFields['name'] = $value;
                $dataFields['type'] = "string";
                array_push($dataFieldArr,$dataFields);

                $col = array();
                $col['text'] = $value;
                $col['datafield'] = $value;
                $col['width'] = 250;
                array_push($colArr,$col);
            //}
        }
        array_push($fullArr,$dataFieldArr);
        array_push($fullArr,$colArr);
        return $fullArr;
    }
    public function getLearnersDataForGrid($sheetData,$isFirstRowContainsFields){
        $rows = array();
        $learnersArr =  $sheetData;
        $fieldRow = $learnersArr[1];
        $dataFieldAndColArr = $this->getDataFieldsAndColumns($fieldRow);
        $dataFields = $dataFieldAndColArr[0];
        $columns = $dataFieldAndColArr[1];
        if($isFirstRowContainsFields){
            unset($learnersArr[1]);
        }
          //Remove fields Row
        foreach($learnersArr as $row){
            $i = 0;
            $col = array();
            foreach ($row as $key => $value){
             //if(!StringUtil::IsNullOrEmptyString($value)){
                $rowData[$dataFields[$i]['name']] = $value;
             ///}
                $i++;
            }
            array_push($rows,$rowData);
        }
        $mainJsonArray = array();
        $mainJsonArray["dataFields"] = $dataFields;
        $mainJsonArray["columns"] = $columns;
        $mainJsonArray["rows"] = $rows;
        return json_encode($mainJsonArray);
    }

    public function deleteUsersByIds($ids){
        $dataStore = UserDataStore::getInstance();
        $dataStore->deleteInList($ids);
    }
    public function Save($user,$isAjaxCall = false,$isChangePassword = false){
        $dataStore = UserDataStore::getInstance();
        $id = $dataStore->saveUser($user,$isChangePassword);
        if($isAjaxCall){
            $user->setSeq($id);
            return $this->getSavedRowArray($user);
        }
        return $id;
    }
    private function getSavedRowArray($user){
        $userObj = new User();
        $userObj = $user;
        $row = array();
        $row["id"] = $userObj->getSeq();
        $row["username"] = $userObj->getUserName();
        $row["password"] = $userObj->getPassword();
        $row["emailid"] = $userObj->getEmailId();
        $userCustomFields = $userObj->getCustomFieldValues();
        $activityMgr = ActivityMgr::getInstance();
        $customfieldArry = $activityMgr->getCustomValuesArray($userCustomFields);
        $row["lastmodifiedon"] = $userObj->getLastModifiedOn()->format("m-d-Y h:m:s A");
        $row = array_merge($row,$customfieldArry);
        return json_encode($row);
    }

    public function getUserLearningProfileArray($userSeq){
        $userDataStore = UserDataStore::getInstance();
        $profiles = $userDataStore->getUserLearningProfiles();
        return $profiles;
    }

    public function getUserLearningProfiles($userSeq){
        $userDataStore = UserDataStore::getInstance();
        $profiles = $userDataStore->getUserLearningProfiles($userSeq);
        return $profiles;
    }
    public function getUserLearningProfileByProfileSeq($profileSeqs){
        $userLearningProfileDataStore = new BeanDataStore("UserLearningProfile","userlearningprofiles");
        $params["tagseq"] = $profileSeqs;
        $profile = $userLearningProfileDataStore->executeConditionQuery($params);
        return $profile;
    }

    public function getUserLearningProfileByLearningPlan($learningPlanSeq){
        $userDataStore = UserDataStore::getInstance();
        $profilesArr = $userDataStore->getUserLearningProfilesByLearnigPlan($learningPlanSeq);
        return $profilesArr;
    }

    public function isPasswordExist($password){
        $userDataStore = UserDataStore::getInstance();
        $sessionUtil = SessionUtil::getInstance();
        $userSeq = $sessionUtil->getUserLoggedInSeq();
        $params["password"] = $password;
        $params["seq"] = $userSeq;
        $count = $userDataStore->executeCountQuery($params);
        return $count > 0;
    }

    public function ChangePassword($password){
        $userDataStore = UserDataStore::getInstance();
        $sessionUtil = SessionUtil::getInstance();
        $userSeq = $sessionUtil->getUserLoggedInSeq();
        $colVal = array();
        $condition  = array();
        $colVal["password"] = $password;
        $condition["seq"] = $userSeq ;
        $userDataStore->updateByAttributes($colVal,$condition);
    }

    public function getCustomFields($seq){
        $userDataStore = UserDataStore::getInstance();
        $customFieldString = $userDataStore->findCustomfield($seq);
        return $customFieldString;
    }
    public function getCustomFieldsByAdmin($adminseq){
        $userDataStore = UserDataStore::getInstance();
        $customFields = $userDataStore->findCustomfieldsByAdmin($adminseq);
        return $customFields;
    }

     public function findBySeq($seq){
        $userDataStore = UserDataStore::getInstance();
        $user = $userDataStore->findBySeq($seq);
        return $user;
    }
    
    public function getUserSeqsByCustomfield($expectedCustomFieldsArr){
        $userDataStore = UserDataStore::getInstance();
        $users = $userDataStore->findAllByCompany();
        $userArr = array();
        $customFieldsFormGenerator = CustomFieldsFormGenerator::getInstance();
        foreach($users as $user){
            $userObj = new User();
            $userObj = $user;
            $custFieldsArr = $customFieldsFormGenerator->getCustomFieldsArray($userObj->getCustomFieldValues());
            $flag = false;
            foreach($expectedCustomFieldsArr as $key=>$fieldValue ){
                $values[$key] = explode(",",$fieldValue);   
                foreach($values[$key] as $col=>$value){
                    if($custFieldsArr[$key] == urldecode($value)){
                        $flag = true;    
                    }
                }
                if(!$flag){
                    break;
                }
            }
            if($flag){
                 array_push($userArr,$userObj->getSeq());    
            }
           
        }
        return $userArr;
    }
}

?>
