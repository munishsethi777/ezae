<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/UserCustomfield.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php5");
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
    
    public function saveCustomFields($isAjaxCall = false){
        $id = $_GET["id"];
        $fieldName = $_GET["fieldName"];
        $fieldType = $_GET["fieldType"];
        $required = $_GET["isRequired"];
        $isRequired = false;
        if($required == "on"){
             $isRequired  =  true;
        } 
        $customField = new UserCustomField();
        $customField->setSeq(intval($id));
        $customField->setName($fieldName);
        $customField->setTitle($fieldName);
        $customField->setFieldType($fieldType);
        $customField->setIsRequired($isRequired);
       // $sessionUtil = SessionUtil::getInstance();
       // $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
       // $adminSeq =  $sessionUtil->getAdminLoggedInSeq();       
        $customField->setCompanySeq(10);//Todo;
        $customField->setAdminSeq(2);
        $customField->setDescription("test");
        
        $dataStore = new BeanDataStore(get_class($customField),UserCustomField::$tableName);
        $id = $dataStore->save($customField);
        if($isAjaxCall){
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
    function getCustomfieldsForGrid(){
        $fullArr = array();          
        $dataStore  = new BeanDataStore("UserCustomField",UserCustomField::$tableName);
        $customFields = $dataStore->findAll();
        foreach($customFields as $customField){
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
    
    public function deleteCustomFields(){
        $ids = $_GET["ids"];
        $dataStore = new BeanDataStore("UserCustomField",UserCustomField::$tableName);
        $dataStore->deleteInList($ids);
        return json_encode($row);   
    }
  }
?>
