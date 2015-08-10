<?php
    require_once('../IConstants.inc');  
    require_once($ConstantsArray['dbServerUrl'] ."Managers/AdminMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/ManagerCriteriaType.php");
    require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
      require_once($ConstantsArray['dbServerUrl'] ."Utils/StringUtil.php"); 
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
            validateCriteria();
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
    function validateCriteria(){
        $customFieldNames = $_POST["customFieldNames"];
        $arr_unique = array_unique($customFieldNames);
        $arr_duplicates = array_diff_assoc($customFieldNames, $arr_unique);
        if(count($arr_duplicates) > 0){
            throw new RuntimeException("Duplicate custom field name !");
        }
    }
    
    function saveManagerCriteria($managerId){
        $criteriaType = $_POST["actOption"];
        if($criteriaType == ManagerCriteriaType::LEARNING_PLAN){
             $criteriavalues = $_POST["learningPlans"];    
        }else if($criteriaType == ManagerCriteriaType::LEARNING_PROFILE){
             $criteriavalues = $_POST["learningProfiles"]; 
        }else if($criteriaType == ManagerCriteriaType::CUSTOM_FIELD){
              $customFieldStr = ""; 
              $customFieldNames = $_POST["customFieldNames"];
              $customFieldValues = $_POST["customFieldValues"];
              $values = array();
              foreach($customFieldNames as $name){
                $startwith = $name. "_";                
                foreach($customFieldValues as $value){
                    $val = urlencode(str_replace($startwith,"",$value));
                    $cus_value = $val;    
                    if(strpos($value, $startwith) === 0){                         
                        if(array_key_exists($name,$values)){
                            $cus_value = $values[$name];
                            $cus_value .= "," . $val;    
                        }                          
                        $values[$name] =  $cus_value;     
                    }    
                }
                if(empty($customFieldStr)){
                    $customFieldStr = $name. ":" .$values[$name];   
                }else{
                    $customFieldStr .= ";" . $name. ":" .$values[$name];
                }
              }
              $criteriavalues[0] =  $customFieldStr;  
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
