<?php
  require_once('IConstants.inc');
  require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
  require_once($ConstantsArray['dbServerUrl'] ."Managers/ActivityMgr.php");
  require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php5");
  require_once($ConstantsArray['dbServerUrl'] ."Utils/MailerUtils.php");

  $call = $_GET["call"];
  if($call == "getUsersForGrid"){
    $sessionUtil = SessionUtil::getInstance();
    $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
    $userMgr = UserMgr::getInstance();
    $userGridJSON = $userMgr->getUsersGridJSON($companySeq);
    echo $userGridJSON;
  }

  if($call == "loginUser"){
      $username = $_GET["username"];
      $password = $_GET["password"];
      $userMgr = new UserMgr();
      $user = $userMgr->logInUser($username, $password);
      if($user){
          $sessionUtil = SessionUtil::getInstance();
          $sessionUtil->createUserSession($user);
          echo 1;
      }else{
          echo 0;
      }
  }

  if($call == "saveActivityData"){
      $moduleId = $_GET["moduleId"];
      $progress = $_GET["progress"];
      $score = $_GET["score"];
      $userSeq= $_GET["userSeq"];
      $activityMgr = ActivityMgr::getInstance();
      try{     
        $activityMgr->saveActivityData($moduleId, $progress, $score,$userSeq);
        echo "null";
      }catch(Exception $e){
        echo "error occured while saving progress (Detail: ". $e->getMessage() .")";
        return;
      }
      
      return;
  }

  if($call == "submitContactForm"){
      $bool = MailerUtils::sendContactEmail($_GET);
      if($bool){
          echo "Your ticket has been successfully submitted. We will get back to you shortly";
      }
  }

?>