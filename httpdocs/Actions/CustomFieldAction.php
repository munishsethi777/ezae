 <?php
 require_once('../IConstants.inc');
 require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomFieldMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/UserCustomfield.php");
   $call = $_GET["call"];
   $success = 1;
   $message = "";
   $response["message"]  = "";

    if($call == "saveCustomField"){

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
        $sessionUtil = SessionUtil::getInstance();
        $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
        $adminSeq =  $sessionUtil->getAdminLoggedInSeq();
        $customField->setCompanySeq($companySeq);
        $customField->setAdminSeq($adminSeq);

        $dataRow = "";
        try{
            $customFieldMgr = CustomFieldMgr ::getInstance();
            $dataRow = $customFieldMgr->saveCustomFields($customField,true);
            $id = $_GET["id"];
            $message  = "Custom Field Saved Sucessfully";
            if(intval($id) > 0){
              $message  = "Custom Field Updated Sucessfully";
            }
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject();
        $response["success"]  = $success;
        $response["message"]  = $message;
        $response["row"] = $dataRow;
        echo json_encode($response);
    }

    if($call == "getCustomFields"){
        try{
            $customFieldMgr = CustomFieldMgr ::getInstance();
            $customfields = $customFieldMgr->getCustomfieldsForGrid();
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject();
        $response["data"] = $customfields;
        echo json_encode($response);
    }

     if($call == "deleteCustomfield"){
         $ids = $_GET["ids"];
         try{
            $customFieldMgr = CustomFieldMgr ::getInstance();
            $customfields = $customFieldMgr->deleteCustomFields($ids);
            $message = "Record Deleted successfully";
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject();
        $response["message"]  = $message;
        $response["success"]  = $success;
        $response["data"] = $customfields;

        echo json_encode($response);
     }
?>
