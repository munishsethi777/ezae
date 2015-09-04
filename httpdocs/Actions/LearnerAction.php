<?php
 require_once('../IConstants.inc');  
 require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."Managers/LearningProfileMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomFieldMgr.php");
    $call = "";
   if(isset($_POST["call"])){
        $call = $_POST["call"];    
   } 
     
   $success = 1;
   $message = "";
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
        $res = new ArrayObject(); 
        $res["success"]  = $success;
        $res["message"]  = $message;
        $res["fieldGridData"]  = $fieldGriddata;
        $res["data"]  = $data;        
        echo json_encode($res);
        return;
    }
    if($call == "exportLearners"){
        $exportOption = $_POST["exportOption"];
        $seqs = $_POST["learnerseqs"];
        $userMgr = UserMgr::getInstance();
        $userMgr->exportLearners($exportOption,$seqs);
    }
     if($call == "saveLearners"){
        $row = "";
        try{
            $id =  0;
            if(isset($_POST["id"])){
                $id = intval($_POST["id"]);    
            }
            $userName = $_POST["username"];
            $password = $_POST["password"];
            $email = $_POST["emailid"];
            $isChangePassword = false;
            if(isset($_POST["isChangePassword"])){
                $isChangePassword = $_POST["isChangePassword"] == "on";        
            }
            //$createDate = $_POST["createDate"];
            $user = new User();
            $user->setSeq($id);
            $user->setIsEnabled(1);
            $user->setUserName($userName);
            $user->setEmailId($email);
            $user->setLastModifiedOn(new DateTime());
            $user->setCreatedOn(new DateTime());
            $user->setPassword($password);
            //if($id > 0){
                //$user->getCreatedOn($createDate);
            //}
            $user->setCompanySeq($companySeq);
            $user->setAdminSeq($adminSeq);
            $customVal = ""; 
            foreach ($_POST as $k => $v) {
                if (strpos($k, $CUSTOM_FIELD_PREFIX) !== 0) continue;
                   $customVal .= substr($k, 4) .":". $v .";";
            }
            $user->setCustomFieldValues($customVal);
            $userMgr = UserMgr::getInstance();
            $row = $userMgr->Save($user,true,$isChangePassword);
            $message = "Learner Saved Successfully."; 
            if($id > 0){
                $message = "Learner Updated Successfully.";     
            }
            
        }catch(Exception $e){ 
            $success = 0;
            $message  = "Exception During Save Learner : - " . $e->getMessage();   
        }
        $res = new ArrayObject(); 
        $res["success"]  = $success;
        $res["message"]  = $message; 
        $res["row"]  = $row;        
        echo json_encode($res);
     }
     
     if(isset($_GET["call"]) && $_GET["call"] == "deleteLearners"){
         $ids = $_GET["ids"];
         try{
            $userMgr = UserMgr::getInstance();
            $userMgr->deleteUsersByIds($ids);
            $message = "Record Deleted successfully";
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        writeResponse($message,$success);
     }
     if(isset($_GET["call"]) && $_GET["call"] == "getLearningProfiles"){
         try{
            $lpMgr = LearningProfileMgr::getInstance();
            $data = $lpMgr->getLearnerProfilesForGrid($adminSeq,$companySeq);
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $res = new ArrayObject(); 
        $res["data"]  = $data;        
        echo json_encode($res);
     }
     
     if($call == "setProfile"){
         try{
            $ids = $_POST["ids"];
            $ids = explode(",",$ids);
            $profiles = $_POST["profileSelect"];
            $lpMgr = LearningProfileMgr::getInstance();
            $id = 0;
            if(count($ids) == 1){
                   
            }
            foreach($ids as $key=>$value){
                $lpMgr->removeProfileFromLearner($value);
                foreach($profiles as $k=>$v){
                    $userLearningProfile = new UserLearningProfile();
                    $userLearningProfile->setAdminSeq($adminSeq);
                    $userLearningProfile->setTagSeq($v);
                    $userLearningProfile->setUserSeq($value);
                    $id = $lpMgr->setProfileOnLearner($userLearningProfile);    
                }       
            }
            $data = $lpMgr->getLearnerProfilesForGrid($adminSeq,$companySeq);
            $message  = "Profile set successfully on selected learners";     
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $res = new ArrayObject();
        $res["message"]  = $message;
        $res["success"]  = $success; 
        //$res["data"]  = $data;        
        echo json_encode($res);
     }
     function writeResponse($message,$success){
        $response = new ArrayObject();
        $response["message"]  = $message;
        $response["success"]  = $success; 
        echo json_encode($response);   
     }  
    
?>
