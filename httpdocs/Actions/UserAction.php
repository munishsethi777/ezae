<?php
 require_once('../IConstants.inc');  
 require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."Managers/LearningProfileMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomFieldMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."Utils/ImageUtil.php");
 require_once($ConstantsArray['dbServerUrl'] ."Utils/CustomFieldsFormGenerator.php");
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
          $user = $userMgr->logInUser($username,$password);
          if($user){
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
      $customFieldsFormGenerator = CustomFieldsFormGenerator::getInstance();
      $html = $customFieldsFormGenerator->getFormHtmlForUser($userSeq);
      echo $html;
  }
?>
