<?php
 require_once('../IConstants.inc');
 require_once($ConstantsArray['dbServerUrl'] ."Managers/ActivityMgr.php");
  require_once($ConstantsArray['dbServerUrl'] ."Managers/ModuleMgr.php");
   $call = "";
   if(isset($_GET["call"])){
        $call = $_GET["call"];
   }else{
       $call = $_POST["call"];
   }

   $success = 1;
   $message = "";
   $sessionUtil = SessionUtil::getInstance();
   $companySeq = $sessionUtil->getUserLoggedInCompanySeq();
   $userSeq =  $sessionUtil->getUserLoggedInSeq();

   if($call == "saveActivityData"){
        try{
            $moduleSeq = $_GET['moduleId'];
            $learningPlanSeq = $_GET['lpid'];
            $progress = $_GET['progress'];
            $score = $_GET['score'];
            $activityMgr = ActivityMgr::getInstance();
            $activityMgr->saveActivityData($moduleSeq, $learningPlanSeq, $userSeq, $progress, $score);
            $message = "Scores Saved Successfully";
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject();
        $response["success"]  = $success;
        $response["message"]  = $message;
        echo json_encode($response);
    }
   if($call == "getActivityHeadersForGrid"){
        $sessionUtil = SessionUtil::getInstance();
        $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
        $moduleSeq = $_GET['moduleSeq'];
        $adminMgr = AdminMgr::getInstance();
        $activityGridJSON = $adminMgr->getActivitiesGridHeardersJSON($companySeq,$moduleSeq);
        echo $activityGridJSON;
        return;
   }
   
   if($call == "getActivityDataForGrid"){
        $sessionUtil = SessionUtil::getInstance();
        $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
        $moduleSeq = $_GET['moduleSeq'];
        $adminMgr = AdminMgr::getInstance();
        $activityGridJSON = $adminMgr->getActivitiesGridJSON($companySeq,$moduleSeq);
        echo $activityGridJSON;
        return;
   }

    /* ---------------------REPORTING ACTIONS STARTS HERE---------------------*/
    //Analytics Module Completion
    if($call == "getModuleCompletionData"){
        $learningPlanSeq = $_GET["learningPlanSeq"];
        $moduleId = $_GET["moduleSeq"];
        $mode = $_GET['mode'];
        $adminMgr = AdminMgr::getInstance();
        echo $adminMgr->getModuleCompletionForChart($learningPlanSeq,$moduleId, $mode);
        return;
    }

    //called for performance Metrics Mean Mediam Mode table
    if($call == "getModuleMeanMediamModePercent"){
        $learningPlanSeq = $_GET["learningPlanSeq"];
        $moduleId = $_GET["moduleSeq"];
        $adminMgr = AdminMgr::getInstance();
        echo $adminMgr->getMeanMedianModeOfPassPercent($learningPlanSeq,$moduleId);
        return;
    }

    if($call == "getModulePerformanceData"){
        $learningPlanSeq = $_GET["learningPlanSeq"];
        $moduleId = $_GET["moduleSeq"];
        $moduleMgr = ModuleMgr::getInstance();
        $module = $moduleMgr->getModule($moduleId);
        $activityMgr = ActivityMgr::getInstance();
        $dataArr = $activityMgr->getPerformanceData($learningPlanSeq,$moduleId,$module->getMaxScore());
        $scoresArr = array();
        $scoresArr['86PLUS'] = 0;
        $scoresArr['66TO85'] = 0;
        $scoresArr['46TO65'] = 0;
        $scoresArr['0TO45'] = 0;
        foreach($dataArr as $data){
        $val = intval($data[0]);
        if($val>=86){
            $scoresArr['86PLUS']++;
        }elseif($val>=65 && $val<=85){
            $scoresArr['66TO85']++;
        }elseif($val>=46 && $val<=65){
             $scoresArr['46TO65']++;
        }elseif($val<=45){
            $scoresArr['0TO45']++;
        }

        }
        $mainArr = array();
        $arr = array();
        $arr['Score'] = '>85%';
        $arr['Participants'] = $scoresArr['86PLUS'];
        array_push($mainArr,$arr);

        $arr['Score'] = '65%-85%';
        $arr['Participants'] = $scoresArr['66TO85'];
        array_push($mainArr,$arr);

        $arr['Score'] = '45%-65%';
        $arr['Participants'] = $scoresArr['46TO65'];
        array_push($mainArr,$arr);

        $arr['Score'] = '0%-45%';
        $arr['Participants'] = $scoresArr['0TO45'];
        array_push($mainArr,$arr);

        echo json_encode($mainArr);
    }

    if($call == "getModulePassPercentageChartData"){
      $learningPlanSeq = $_GET["learningPlanSeq"];
      $moduleId = $_GET["moduleSeq"];
      $percentage = $_GET["percentage"];
      $adminMgr = AdminMgr::getInstance();
      echo $adminMgr->getModulePercentagePerformanceForChart($learningPlanSeq,$moduleId,$percentage);
      return;
    }

    //called from comparative analytics page
    if($call == "getCustomFieldsJson"){
        $sessionUtil = SessionUtil::getInstance();
        $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
        $adminMgr = AdminMgr::getInstance();
        $customFieldsJSON =  $adminMgr->getCustomFieldsJSON($companySeq);
        echo $customFieldsJSON;
        return;
    }
    if($call == "getModuleComparativeData"){
        $sessionUtil = SessionUtil::getInstance();
        $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
        $learningPlanSeq = $_GET["learningPlanSeq"];
        $moduleSeq = $_GET["moduleSeq"];
        $fieldName = $_GET["fieldName"];
        $criteria = $_GET["criteria"];
        $adminMgr = AdminMgr::getInstance();
        $json = $adminMgr->getModuleComparativeForChart($learningPlanSeq,$moduleSeq, $fieldName, $criteria,$companySeq);
        echo $json;
        return;
    }
    /* ---------------------REPORTING ACTIONS ENDS HERE---------------------*/


   //To be moved to Admin action file
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
   if($call == "updateProfilePicture"){
        try{
            $img = $_POST['imgSrc'];
            $orgImg = $_POST['imgSrcOrg'];
            $path = $ConstantsArray['ImagePath'];
            $uploaded = ImageUtil::uploadImage($path,$img,$orgImg,$adminSeq);
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

     if($call == "submitAnswer"){
         $isCorrect = 0;
         try{
            $moduleid = $_POST['moduleseq'];
            $questionid = $_POST['questionseq'];
            $selectedAns = $_POST['answer'.$questionid];
            $learningPlanSeq = $_POST['learningplanseq'];
            $progress = $_POST['progress'];
            if(is_array($selectedAns)){
                $ansSeqs =   $selectedAns;  
            }else{
                $ansSeqs = explode(",",$selectedAns);     
            }
            foreach($ansSeqs as $anseq){
                $quizProgress = new QuizProgress();
                $quizProgress->setModuleSeq($moduleid); 
                $quizProgress->setDated(new DateTime());
                $quizProgress->setQuestionSeq($questionid);
                $quizProgress->setAnswerSeq($anseq);
                $quizProgress->setLearningPlanSeq($learningPlanSeq);
                $quizProgress->setUserSeq($userSeq);
                $activityMgr = ActivityMgr::getInstance();
                $id = $activityMgr->saveQuizProgress($quizProgress);    
            }
            $moduleMgr = ModuleMgr::getInstance();
            $ansList = $moduleMgr->getCorrectAnswers($ansSeqs,$questionid);
            $scores = $ansList["score"];
            $activityMgr->saveActivityData($moduleid,$learningPlanSeq,$userSeq,$progress,$scores);
            $incorrectAns = $ansList["incorrect"];
            if(!empty($incorrectAns)){
                $success = 0;         
            }
         }catch (Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject();
        $response["success"]  = $success;
        $response["message"]  = $message;
        $response["ansList"]  = $ansList;
        $json = json_encode($response);
        echo $json;
         
         
     }
?>
