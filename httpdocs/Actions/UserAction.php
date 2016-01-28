<?php
 require_once('../IConstants.inc');
 require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/User.php");
 require_once($ConstantsArray['dbServerUrl'] ."Managers/LearningProfileMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomFieldMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."Utils/ImageUtil.php");
 require_once($ConstantsArray['dbServerUrl'] ."Utils/CustomFieldsFormGenerator.php");
 require_once($ConstantsArray['dbServerUrl'] ."Utils/SecurityUtil.php");
 require_once($ConstantsArray['dbServerUrl'] ."Utils/MailerUtils.php"); 
 require_once($ConstantsArray['dbServerUrl'] ."Managers/LearningPlanMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");

 $call = "";
   if(isset($_POST["call"])){
        $call = $_POST["call"];
    }else{
        $call = $_GET["call"];
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
        $response["imagepath"] = "images/UserImages/$userSeq.png";
        echo json_encode($response);
    }
     if($call == "forgotPassword"){
        $UDS = UserDataStore::getInstance();
        try{
            $username = $_POST['username'];
            if(!empty($username)){     
                $user = $UDS->findByUserName($username);
                if(!empty($user)){
                    $mailMessage = new MailMessage();
                    $mailMessage->setSubject("Ezae - Retreive Password");
                    $mailMessage->setMessage("Hello,<br/><br/>Password for UserName  " . $username . " is ". $user->getPassword()."<br/><br/>Ezae Team.");
                    MailMessageUtil::sendforgotPasswordEmail($mailMessage,$user);        
                }else{
                    throw new Exception("User Name is not exist");
                }
            }           
            $message = "your password emailed to your email account";
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
          $user = $userMgr->logInUser($username,$password);
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
    if($_POST["lpfId"]){
        $lpfSeq = SecurityUtil::Decode($post["lpfId"]);
        unset($post["lpfId"]);    
    }
    unset($post["aid"]);
    unset($post["cid"]);
    try{
        $userCustomFields = $customFieldsFormGenerator->getCustomfieldsFromArr($post);
        $matchingRuleMgr = MatchingRuleMgr::getInstance();
        $learningProfileMgr = LearningProfileMgr::getInstance(); 
        $matchingRule = $matchingRuleMgr->getRequiredMatchingRules($adminSeq,$companySeq);
        $user = new user();
        $userNameFieldName = StringConstants::DEFAULT_USERNAME_FIELDNAME;
        $PasswordFieldName = StringConstants::DEFAULT_PASSWORD_FIELDNAME;
        $emailFieldName = StringConstants::DEFAULT_EMAIL_FIELDNAME;
        if(isset($post[$matchingRule["usernamefield"]])){
            $userNameFieldName = $matchingRule["usernamefield"];
        }
        if(isset($post[$matchingRule["passwordfield"]])){
            $PasswordFieldName = $matchingRule["passwordfield"];
        }
        if(isset($post[$matchingRule["emailfield"]])){
            $emailFieldName = $matchingRule["emailfield"];
        }
        $username = $post[$userNameFieldName];
        $password = $post[$PasswordFieldName];
        $email = $post[$emailFieldName];
        $user->setUserName($username);
        $user->setPassword($password);
        $user->setEmailId($email);
        $user->setLastModifiedOn(new DateTime());
        $user->setCustomFieldValues($userCustomFields);
        $user->setCreatedOn(new DateTime());
        $user->setAdminSeq($adminSeq);
        $user->setCompanySeq($companySeq);
        $user->setSeq(0);
        $user->setIsEnabled(true);
        $userMgr = UserMgr::getInstance();
        $userMgr->Save($user);
        if(!empty($lpfSeq)){
            $userLearningProfile = new UserLearningProfile();
            $userLearningProfile->setAdminSeq($adminSeq);
            $userLearningProfile->setTagSeq($lpfSeq);
            $userLearningProfile->setUserSeq($user->getSeq());
            $learningProfileMgr->setProfileOnLearner($userLearningProfile);    
        }
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

     //used to display learningplans in user's training page learningplans dropdown
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
    
  if($call == "submitContactForm"){   
    try{
          $bool = MailerUtils::sendContactEmail($_POST);
          if($bool){
              $message =  "Your ticket has been successfully submitted. We will get back to you shortly";
          }else{
              $success = 0;
              $message = "Error During Submit Contact Us";
          }
    }catch(Exception $e){
          $success = 0;
          $message  = $e->getMessage();
    }
     $res = new ArrayObject();
     $res["success"]  = $success;
     $res["message"]  = $message;
     echo json_encode($res);
  }
    
    
?>