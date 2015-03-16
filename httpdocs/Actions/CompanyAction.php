<?php
 require_once('../IConstants.inc');  
 require_once($ConstantsArray['dbServerUrl'] ."Managers/CompanyMgr.php");
   $call = $_GET["call"]; 
   $success = 1;
   $message = "";  
    if($call == "saveCompany"){
        try{       
            $companyMgr = CompanyMgr::getInstance();
            $companyMgr->SignUpCompany(); 
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject(); 
        $response["success"]  = $success;
        $response["message"]  = $message;
        echo json_encode($response);  
    }
?>
