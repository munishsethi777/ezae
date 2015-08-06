<?php
    require_once('../IConstants.inc');  
    require_once($ConstantsArray['dbServerUrl'] ."Managers/AdminMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/ManagerCriteriaType.php");
    require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
    $call = "";
    if(isset($_GET["call"])){
        $call = $_GET["call"];     
    }else{
       $call = $_POST["call"];
    }
    $success = 1;
    $message = "";
    $sessionUtil = SessionUtil::getInstance();
    $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
    $adminSeq =  $sessionUtil->getAdminLoggedInSeq();
    $adminMgr = AdminMgr::getInstance(); 
    if($call == "saveAdminMgr"){
        try{
            $userName = $_POST["username"];
            $name = $_POST["name"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            $mobile = $_POST["mobile"];
            $admin = new Admin();
            $admin->setCompanySeq($companySeq);
            $admin->setName($name);
            $admin->setUserName($name);
            $admin->setPassword($password); //TODO -- save encrypted password --
            $admin->setEmailId($email);
            $admin->setMobileNo($mobile);
            $admin->setIsSuper(false);
            $admin->setIsManager(true);
            $admin->setParentAdminSeq($adminSeq);
            $admin->setIsSuper(false);
            $admin->setIsEnabled(true);
            $admin->setLastModifiedOn(new DateTime());
            $admin->setCreatedOn(new DateTime());
            $id = $adminMgr->saveAdminManager($admin); 
            if($id > 0){
                saveManagerCriteria($id);
                $message = StringConstants::MANAGER_SAVED;      
            }   
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject(); 
        $response["success"]  = $success;
        $response["message"]  = $message;
        echo json_encode($response);  
        return;
    }
    function saveManagerCriteria($managerId){
        $criteriaType = $_POST["actOption"];
        if($criteriaType == ManagerCriteriaType::LEARNING_PLAN){
             $criteriavalues = $_POST["learningPlans"];    
        }else if($criteriaType == ManagerCriteriaType::LEARNING_PROFILE){
             $criteriavalues = $_POST["learningProfiles"]; 
        }else if($criteriaType == ManagerCriteriaType::CUSTOM_FIELD){
              $criteriavalues = $_POST["customFieldNames"];
              $customFieldValues = $_POST["customFieldValues"];   
        }
        global $adminMgr;
        foreach($criteriavalues as $value){
            $managerCriteria = new ManagerCriteria();
            $managerCriteria->setCriteriaType($criteriaType);
            $managerCriteria->setCriteriaValue($value);
            $managerCriteria->setManagerSeq($managerId);
            $id = $adminMgr->SaveManagerCriteria($managerCriteria);  
        }
       
    }
?>
