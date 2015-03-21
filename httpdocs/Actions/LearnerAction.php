<?php
 require_once('../IConstants.inc');  
 require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
   $call = $_POST["call"];  
   $success = 1;
   $message = "";
   $response["message"]  = "";
     
    if($call == "importLearners"){
        $data = "";
        try{
           $file = $_FILES["fileUpload"];
           $learnerMgr = UserMgr::getInstance();
           $importedData = $learnerMgr->importLearners($file); 
           $fieldGriddata = $learnerMgr->getLearnersFieldGridData($importedData);
           $data = $learnerMgr->getLearnersDataForGrid($importedData);
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
