<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/UserCustomfield.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php5");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/UserCustomFieldsDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "Utils/SessionUtil.php5");
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
        return json_encode($row);
    }
    function getCustomfieldsForGrid($companySeq){
        $fullArr = array();
        $dataStore  = UserCustomFieldsDataStore::getInstance();
        //$cFields = $dataStore->findByCompany($companySeq);
        $cFields = $dataStore->findAllByCompany();
        foreach($cFields as $customField){
            $field = new UserCustomField();
            $field = $customField;
            $arr = array();
            $arr['id'] = $field->getSeq();
            $arr['name'] = $field->getTitle();
            $arr['type'] = $field->getFieldType();
            array_push($fullArr,$arr);
        }
        return json_encode($fullArr);
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
  }
?>
