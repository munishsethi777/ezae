<?php
    require_once('../IConstants.inc');
    require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php5");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/SecurityUtil.php");

    require_once($ConstantsArray['dbServerUrl'] ."Managers/SignupFormMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/AdminMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/CompanyMgr.php");

    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/SignupFormField.php");
    $call = "";
    if(isset($_POST["call"])){
        $call = $_POST["call"];
    }else{
        $call = $_GET["call"];
    }
    $success = 1;
    $message = "";
    $sessionUtil = SessionUtil::getInstance();
    $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
    $adminSeq =  $sessionUtil->getAdminLoggedInSeq();

    if($call == "saveSignupFormFields"){
        $seqArr = $_POST["seq"];
        try{
            $signupFormMgr = SignupFormMgr::getInstance();
            $signupFormMgr->deleteAll();
            foreach($seqArr as $key=>$value){
                $isRequired = 0;
                if(isset($_POST["required_" . $value])){
                   $required = $_POST["required_" . $value];
                   $isRequired = $required == "on" ? 1 : 0;
                }
                $isVisible = 0;
                if(isset($_POST["show_" . $value])){
                   $show = $_POST["show_" . $value];
                   $isVisible = $show == "on" ? 1 : 0;
                }
                $signupFormField = new SignupFormField();
                $signupFormField->setAdminSeq($adminSeq);
                $signupFormField->setCompanySeq($companySeq);
                $signupFormField->setCustomFieldSeq($value);
                $signupFormField->setIsRequired($isRequired);
                $signupFormField->setIsVisible($isVisible);
                $id = $signupFormMgr->SaveSignupFormFields($signupFormField);
                $message = "Settings Saved Successfully";
            }
            $headerText = $_POST["headerText"];
            $adminMgr = AdminMgr::getInstance();
            $adminMgr->updateHeaderText($headerText,$adminSeq);
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

    if($call == "getSignupFormFields"){
        $aidEncrypted = $_GET["aid"];
        $cidEncrypted = $_GET["cid"];
        $adminSeq = SecurityUtil::Decode($aidEncrypted);
        $compnaySeq = SecurityUtil::Decode($cidEncrypted);
        $adminMgr = AdminMgr::getInstance();
        $details = $adminMgr->getSignupFormDetails($adminSeq,$compnaySeq);
        echo json_encode($details);
    }
?>
