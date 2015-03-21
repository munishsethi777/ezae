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
        $row["name"] = $customField->getName();
        $row["type"] = $customField->getFieldType();
        $row["required"] = $customField->getIsRequired();
        return json_encode($row);
    }
    function getCustomfieldsForGrid($companySeq){
        $fullArr = array();
        $dataStore  = UserCustomFieldsDataStore::getInstance();
        //$cFields = $dataStore->findByCompany($companySeq);
        $cFields = $dataStore->findAll();
        foreach($cFields as $customField){
            $field = new UserCustomField();
            $field = $customField;
            $arr = array();
            $arr['id'] = $field->getSeq();
            $arr['name'] = $field->getTitle();
            $arr['type'] = $field->getFieldType();
            $arr['required'] = $field->getIsRequired();
            array_push($fullArr,$arr);
        }
        return json_encode($fullArr);
    }

    public function deleteCustomFields($ids){
        $dataStore = new BeanDataStore("UserCustomField",UserCustomField::$tableName);
        $dataStore->deleteInList($ids);
        return json_encode($row);
    }
  }
?>
