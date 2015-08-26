<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/UserCustomField.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php5");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/UserCustomFieldsDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "Utils/SessionUtil.php5");
require_once($ConstantsArray['dbServerUrl']. "Utils/CustomFieldsFormGenerator.php");
  class CustomFieldMgr{
  private static $customFieldMgr;
    public static function getInstance()
    {
        if (!self::$customFieldMgr)
        {
            self::$customFieldMgr = new CustomFieldMgr();
        }
        return self::$customFieldMgr;
    }

    public function saveCustomFields($customField,$isAjaxCall = false){
        $dataStore = new BeanDataStore(get_class($customField),UserCustomField::$tableName);
        $id = $dataStore->save($customField);
        if($isAjaxCall){
            $customField->setSeq($id);
            return $this->getSavedRowArray($customField);
        }
        return $id;
    }
    private function getSavedRowArray($customField){
        $row = array();
        $row["id"] = $customField->getSeq();
        $row["name"] = $customField->getTitle();
        $row["type"] = $customField->getFieldType();
        $row["lastmodifiedon"] = $customField->getLastModifiedOn()->format("m-d-Y h:m:s A");
        return $row;
    }
    
    
    function getJson($customField) {
        $arr = array();
        $title = $customField->getTitle();
        $arr['id'] = $customField->getSeq();
        $arr['name'] = $title;
        $arr['type'] = $customField->getFieldType();
        $arr['lastmodifiedon'] = $customField->getLastModifiedOn();
        $matchinRuleMgr = MatchingRuleMgr::getInstance();
        $mappedField = $matchinRuleMgr->findNameForCustomfield($customField->getTitle());
        $arr["mappedfield"] = $mappedField;
        $arr['title'] = $title;
        $fields = array();
        if (strpos($mappedField,'usernamefield') !== false) {
            array_push($fields,"UserName");
        }
        if (strpos($mappedField,'passwordfield') !== false){
             array_push($fields,"Password");
        }
        if (strpos($mappedField,'emailfield') !== false){
             array_push($fields,"Email");            
        }
        if(!empty($fields)){
            $arr['title']  = $title . " (" . implode(", ",$fields) . ")";
        }
        return $arr;     
    }
    
    function getCustomfieldsForGrid($isApplyFilter){
        $fullArr = array();
        $dataStore  = UserCustomFieldsDataStore::getInstance();
        $cFields = $dataStore->findAllByCompany($isApplyFilter);
        foreach($cFields as $customField){
            $arr = $this->getJson($customField);
            array_push($fullArr,$arr);
        }
        $gridData["Rows"] = $fullArr;
        $gridData["TotalRows"] = $dataStore->executeCountQuery(null,$isApplyFilter);
        return json_encode($gridData);
     }

    public function deleteCustomFields($ids){
        $dataStore = new BeanDataStore("UserCustomField",UserCustomField::$tableName);
        $dataStore->deleteInList($ids);
    }

    public function isExists($adminSeq,$companyseq){
        $dataStore = new BeanDataStore("UserCustomField",UserCustomField::$tableName);
        $params = array();
        $params['adminseq'] = $adminSeq;
        $params['companyseq'] = $companyseq;
        $count = $dataStore->executeCountQuery($params);
        return $count > 0;
    }
    public function getCustomfieldTitles($adminSeq,$companyseq){
        $dataStore = new BeanDataStore("UserCustomField",UserCustomField::$tableName);
        $params = array();
        $attributes = array();
        array_push($attributes,"title");
        $params['adminseq'] = $adminSeq;
        $params['companyseq'] = $companyseq;
        $titles = $dataStore->executeAttributeQuery($attributes,$params);
        $titleArr = array();
        foreach($titles as $arr ){
            array_push($titleArr,$arr[0]);
        }
        return $titleArr;
    }
    //Calling From CustomFieldAction For show the values on adminManagers.php
    public function getCustomFieldValuesByName($customFieldName,$adminSeq){
        $userMgr = UserMgr::getInstance();
        $customfieldFormGenreator = CustomFieldsFormGenerator::getInstance();
        $customFields = $userMgr->getCustomFieldsByAdmin($adminSeq);
        $customFieldValueArr = array();
        foreach($customFields as $customField){
            $customFieldArr = $customfieldFormGenreator->getCustomFieldsArray($customField[0]);
            $value = $customFieldArr[$customFieldName];
            if(!in_array($value,$customFieldValueArr)){
                $customFieldValueArr[$customFieldName ."_" . $value] =  $value;
            }
               
        }
        return $customFieldValueArr;
    }
  }
?>
