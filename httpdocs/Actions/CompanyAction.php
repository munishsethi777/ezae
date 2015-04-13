<?php
 require_once('../IConstants.inc');  
 require_once($ConstantsArray['dbServerUrl'] ."Managers/CompanyMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."Managers/AdminMgr.php");
   $call = $_GET["call"]; 
   $success = 1;
   $message = "";
   $sessionUtil = SessionUtil::getInstance();
   $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
   $adminSeq =  $sessionUtil->getAdminLoggedInSeq();   
    if($call == "saveCompany"){
        try{       
            $companyMgr = CompanyMgr::getInstance();
            $companyMgr->SignUpCompany();
            $message = "Settings Saved Successfully"; 
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject(); 
        $response["success"]  = $success;
        $response["message"]  = $message;
        echo json_encode($response);  
    }
    if($call == "getSettings"){
        $adminMgr = AdminMgr::getInstance();  
        $companyMgr = CompanyMgr::getInstance();
        $adminJson = "";
        $compnayJson = "";
        try{
            $compnay = $companyMgr->getCompanyBySeq($companySeq);            
            $admin = $adminMgr->FindBySeq($adminSeq);
            $adminArray =  (array) $admin;
            $companyArray =  (array) $compnay; 
            $adminJson = json_encode($adminArray, JSON_FORCE_OBJECT);
            $adminJson = str_replace("\\u0000Admin\\u0000","",$adminJson);
            
            $compnayJson = json_encode($companyArray, JSON_FORCE_OBJECT);
            $compnayJson = str_replace("\\u0000Company\\u0000","",$compnayJson);
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        } 
        $response = new ArrayObject(); 
        $response["success"]  = $success;
        $response["message"]  = $message;
        $response["company"]  = $compnayJson;
        $response["admin"]  = $adminJson;
        echo json_encode($response);        
    }
    if($call == "changePassword"){
        $password = $_GET["newPassword"];
        $earlierPassword = $_GET["earlierPassword"];
        try{ 
              
            $adminMgr = AdminMgr::getInstance();
            $isPasswordExists = $adminMgr->isPasswordExist($earlierPassword);
            if($isPasswordExists){
                 $adminMgr->ChangePassword($password);
                 $message = "Password Updated Successfully";    
            }else{
                $message = "Incorrect Current Password!";
                $success =0;     
            }
           
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject(); 
        $response["success"]  = $success;
        $response["message"]  = $message;
        echo json_encode($response);  
    }
    
    if($call == "getPrefix"){
        try{       
            $companyMgr = CompanyMgr::getInstance();
            $refix =   $companyMgr->getCompanyPrefix($companySeq); 
        }catch (Exception $e){
            $success = 0;
            $message  = $e->getMessage();    
        }
        echo $refix;
    }
    
?>
