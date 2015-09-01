<?php
 require_once('../IConstants.inc');
<<<<<<< Updated upstream
 require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/User.php");
 require_once($ConstantsArray['dbServerUrl'] ."Managers/LearningProfileMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomFieldMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."Utils/ImageUtil.php");
 require_once($ConstantsArray['dbServerUrl'] ."Utils/CustomFieldsFormGenerator.php");
 require_once($ConstantsArray['dbServerUrl'] ."Utils/SecurityUtil.php");
 require_once($ConstantsArray['dbServerUrl'] ."Managers/LearningPlanMgr.php");

 $call = "";
   if(isset($_POST["call"])){
        $call = $_POST["call"];
    }else{
        $call = $_GET["call"];
<<<<<<< Updated upstream
   }
   $success = 1;
   $message = "";
   $sessionUtil = SessionUtil::getInstance();
   $userSeq = $sessionUtil->getUserLoggedInSeq();
   $customFieldsFormGenerator = CustomFieldsFormGenerator::getInstance();
  if($call == "updateProfilePicture"){
        try{
            $img = $_POST['imgSrc'];
            $orgImg = $_POST['imgSrcOrg'];
            $path = $ConstantsArray['UserImagePath'];
            $uploaded = ImageUtil::uploadImage($path,$img,$orgImg,$userSeq);
            $message = "Profile Picture Updated Successfully";
        }catch (Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject();
        $response["success"]  = $success;
        $response["message"]  = $message;
        echo json_encode($response);
    }
    if($call == "changePassword"){
        $password = $_POST["newPassword"];
        $earlierPassword = $_POST["earlierPassword"];
        try{

            $userMgr = UserMgr::getInstance();
            $isPasswordExists = $userMgr->isPasswordExist($earlierPassword);
            if($isPasswordExists){
                 $userMgr->ChangePassword($password);
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
    if($call == "loginUser"){
      $username = $_POST["username"];
      $password = $_POST["password"];
      $userMgr = UserMgr::getInstance();
      try{
         // $user = $userMgr->logInUser($username,$password);
          if($user != null){
              $sessionUtil->createUserSession($user);
          }else{
              $success = 0;
              $message = "Incorrect Username or Password";
          }
      }catch(Exception $e){
           $success = 0;
           $message  = $e->getMessage();
      }
      $res = new ArrayObject();
      $res["success"]  = $success;
      $res["message"]  = $message;
      echo json_encode($res);
      return;
    }
    if($call == "getUserFieldForm"){
      $sessionUtil = SessionUtil::getInstance();
      $userSeq = $sessionUtil->getUserLoggedInSeq();     
      $html = $customFieldsFormGenerator->getFormHtmlForUser($userSeq);
      echo $html;

  }
  
  if($call == "signup"){
    $post = $_POST;
    unset($post["call"]);
    $adminSeq = SecurityUtil::Decode($post["aid"]);
    $companySeq = SecurityUtil::Decode($post["cid"]);
    unset($post["aid"]);
    unset($post["cid"]);
    try{    
        $userCustomFields = $customFieldsFormGenerator->getCustomfieldsFromArr($post);
        $matchingRuleMgr = MatchingRuleMgr::getInstance();
        $matchingRule = $matchingRuleMgr->getRequiredMatchingRules($adminSeq,$companySeq);
        $user = new user();
        $user->setUserName($post[$matchingRule["usernamefield"]]);
        $user->setPassword($post[$matchingRule["passwordfield"]]);
        $user->setLastModifiedOn(new DateTime());
        $user->setCustomFieldValues($userCustomFields);
        $user->setCreatedOn(new DateTime());
        $user->setAdminSeq($adminSeq);
        $user->setSeq(0);
        $user->setIsEnabled(true);
        $userMgr = UserMgr::getInstance();
        $userMgr->Save($user);
        $sessionUtil->createUserSession($user);
        $message = "Sign up Successfully";
    }catch(Exception $e){
          $success = 0;
          $message  = $e->getMessage();
    }
     $res = new ArrayObject();
     $res["success"]  = $success;
     $res["message"]  = $message;
     echo json_encode($res);
    
  }
  

    if($call == "getLearningPlansForUser"){
        $learningPlanMgr = LearningPlanMgr::getInstance();
        $learningPlans = $learningPlanMgr->getLearningPlansForUser($userSeq);
        echo json_encode($learningPlans);
    }
    //used to display modules in user training grid
    if($call == "getModulesForUserTrainingGrid"){
        try{
            $moduleMgr = ModuleMgr::getInstance();
            $learningPlanSeq = $_GET["learningPlanSeq"];
            $data = $moduleMgr->getModulesForUserTrainingGrid($userSeq,$learningPlanSeq);
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        echo $data;
    }
?>