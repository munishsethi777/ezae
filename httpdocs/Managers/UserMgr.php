<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Classes/');    
require_once($ConstantsArray['dbServerUrl']. "DataStores/UserDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "Managers/ActivityMgr.php"); 
require_once($ConstantsArray['dbServerUrl']. "DataStores/UserCustomFieldsDataStore.php5");         
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
            $fieldName =  "field" . $i;
            $dataFields = array();
            $dataFields['name'] = $fieldName;
            $dataFields['type'] = "string";
            array_push($dataFieldArr,$dataFields);            
            
            $col = array();
            $col['text'] = "Field " . $i;
            $col['datafield'] = $fieldName;
            $col['width'] = 250;
            $col['columntype'] = "template";        
            //$col['createeditor'] = '%createGridEditor%';
           // $col['initeditor'] = "initGridEditor"; 
          // $col['geteditorvalue'] = "gridEditorValue";
            //$col = $this->replaceQuotes($col);
            array_push($columnsArr,$col);
            if($isFirstRowContainsFields || $isCustomfieldsExists){
                $fieldNameRow[$fieldName] =  $value;                
            }else{
                $fieldNameRow[$fieldName] =  "{FieldName}";
            }
            $fieldTypeRow[$fieldName] =   "Text";     
            
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
            $dataFields = array();
            $dataFields['name'] = $value;
            $dataFields['type'] = "string";
            array_push($dataFieldArr,$dataFields);
            
            $col = array();
            $col['text'] = $value;
            $col['datafield'] = $value;
            $col['width'] = 250;
            array_push($colArr,$col);  
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
                $rowData[$dataFields[$i]['name']] = $value;
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
    public function Save($user,$isAjaxCall = false,$isChangePassword){
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
        $row["createDate"] = $userObj->getCreatedOn();
        $userCustomFields = $userObj->getCustomFieldValues();
        $activityMgr = ActivityMgr::getInstance();
        $customfieldArry = $activityMgr->getCustomValuesArray($userCustomFields);
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
        $profiles = implode(", " ,$profiles);
        return $profiles;
    }
}

?>
