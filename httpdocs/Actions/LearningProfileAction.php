<?php
    require_once('../IConstants.inc');  
    require_once($ConstantsArray['dbServerUrl'] ."Managers/LearningProfileMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomFieldMgr.php");

    $call = "";
    $success = 1;
    $message = "";
    $sessionUtil = SessionUtil::getInstance();
    $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
    $adminSeq =  $sessionUtil->getAdminLoggedInSeq();
    if(isset($_GET["call"])){
        $call = $_GET["call"];    
    }
    if(isset($_POST["call"]) && $_POST["call"] == "saveLearningProfile"){
        try{
            $id =  0;
            if(isset($_POST["id"])){
                $id = intval($_POST["id"]);    
            }
            $tag = $_POST["name"];
            $description = $_POST["description"];
            
            $learner = new tag();
            $learner->setSeq($id);
            $learner->setTag($tag);
            $learner->setDescription($description);
            $learner->setAdminSeq($adminSeq);
            $learner->setCompanySeq($companySeq);
            $learner->setCreatedOn(new DateTime());
            
            $lpMgr = LearningProfileMgr::getInstance();
            $data = $lpMgr->Save($learner,true);
            $message = "Learner Profile Saved Successfully."; 
            if($id > 0){
                $message = "Learner Profile Updated Successfully.";     
            }
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject();
        $response["message"]  = $message;
        $response["success"]  = $success;
        $response["row"] = $data;
        $json = json_encode($response);
        echo $json;
    }  
    if($call == "getLearnerProfilesForGrid"){
        try{
            $lpMgr = LearningProfileMgr::getInstance();
            $data = $lpMgr->getLearnerProfilesForGrid($adminSeq,$companySeq);
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject();
        $response["data"] = $data;
        $json = json_encode($response);
        echo $json;
    }
    if($call == "deleteLearningProfile"){
         $ids = $_GET["ids"];
         try{
            $lpMgr = LearningProfileMgr::getInstance();
            $lpMgr->deleteCustomFields($ids);
            $message = "Record Deleted successfully";
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        writeResponse($message,$success);
    }
    
    function writeResponse($message,$success){
        $response = new ArrayObject();
        $response["message"]  = $message;
        $response["success"]  = $success;
        echo json_encode($response);   
     }      
?>
