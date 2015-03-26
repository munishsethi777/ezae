<?php
 require_once('../IConstants.inc');  
 require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomFieldMgr.php"); 
   $call = $_POST["call"];  
   $success = 1;
   $message = "";
   $response["message"]  = "";
   $sessionUtil = SessionUtil::getInstance();
   $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
   $adminSeq =  $sessionUtil->getAdminLoggedInSeq(); 
    if($call == "importLearners"){
        $data = "";
        try{
           $file = $_FILES["fileUpload"];
           $firstRowContainsFields = "";
           if(isset($_POST["isfirstRowField"])){
             $firstRowContainsFields = $_POST["isfirstRowField"];   
           }           
           $isFirstRowContainsFields = $firstRowContainsFields == "on" ? true : false;
           $learnerMgr = UserMgr::getInstance();
           $importedData = $learnerMgr->importLearners($file);
           $customFieldMgr = CustomFieldMgr::getInstance();
           $isCustomfieldsExists = $customFieldMgr->isExists($adminSeq,$companySeq);
           $fieldGriddata = $learnerMgr->getLearnersFieldGridData($importedData,$isFirstRowContainsFields,$isCustomfieldsExists);
           $data = $learnerMgr->getLearnersDataForGrid($importedData,$isFirstRowContainsFields);
           $message = "Learners Imported Successfully.<br/>Click Next For Manage Imported Data.";          
        }catch(Exception $e){
           $success = 0;
           $message  = $e->getMessage(); 
        }
        $response = new ArrayObject(); 
        $response["success"]  = $success;
        $response["message"]  = $message;
        $response["fieldGridData"]  = $fieldGriddata;
        $response["data"]  = $data;        
        echo json_encode($response);
    }
?>
