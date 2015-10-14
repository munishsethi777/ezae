<?
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/LearningPlanMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/LeaderBoardMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/LearningPlan.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/LearningPlanProfile.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/LeaderBoard.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/LearningPlanModule.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/LearningPlanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php5");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ErrorUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/MailMessageUtil.php");
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

if($call== "getLearnerPlansForGrid"){
    try{
        $lpMgr = LearningPlanMgr::getInstance();
        $isApplyFilter = true;
        $data =  $lpMgr->getLearningPlanForGrid($isApplyFilter);
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
    echo $data;
}

//* REPORTING METHODS STARTS HERE //*
//Completion Metrics Reporting load plans method
if($call== "getLearnerPlansForReporting"){
    try{
        $lpMgr = LearningPlanMgr::getInstance();
        $isApplyFilter = true;
        $data =  $lpMgr->getLearningPlanForGrid($isApplyFilter);
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
    echo $data;
}
//* REPORTING METHODS ENDS HERE //*


if($call == "saveLearningPlan"){
    try{
        $id = $_POST["id"];
        $moduleIds = $_POST["moduleIds"];
        $enableModuleLeaderboard = $_POST["isModuleLeaderboard"];
        $name = $_POST["name"];
        $des = $_POST["description"];
        $profile = $_POST["profile"];
        $actOption = $_POST["actOption"];
        $activateOn = null;
        if($actOption == "futureActive"){
            $activateOn = DateTime::createFromFormat('m/d/Y h:i A', $_POST["activationDate"]);
        }
        $deactivateOn = null;
        if(isset($_POST["deactivate"]) && isset($_POST["deactivate"]) == "on"){
           $deactivateOn =  DateTime::createFromFormat('m/d/Y h:i A', $_POST["deactiveDate"]);
        }
        $isEnableLeaderboard = 0;
        if(isset($_POST["enableLeaderboard"])){
          $isEnableLeaderboard =  isset($_POST["enableLeaderboard"]) == "on" ? 1 : 0;
        }
        $isLockSequence = 0;
        if(isset($_POST["locksequence"])){
          $isLockSequence =  isset($_POST["locksequence"]) == "on" ? 1 : 0;
        }
        $profileSeq = $_POST["profile"];
        $learningPlan = new LearningPlan();
        $learningPlan->setSeq($id);
        $learningPlan->setActivateOn($activateOn);
        $learningPlan->setAdminSeq($adminSeq);
        $learningPlan->setIsSequenceLocked(0);
        $learningPlan->setCompanySeq($companySeq);
        $learningPlan->setDeactivateOn($deactivateOn);
        $learningPlan->setDescription($des);
        $learningPlan->setIsActive($actOption == "active" ? 1 : 0);
        $learningPlan->setIsLeaderBoard($isEnableLeaderboard);
        $learningPlan->setTitle($name);
        $learningPlan->setCreatedOn(new DateTime());
        $learningPlan->setLastModifiedOn(new DateTime());
        $learningPlan->setIsSequenceLocked($isLockSequence);
        $learningPlanMgr = LearningPlanMgr::getInstance();
        $moduleIdArr = explode(",",$moduleIds);
        $modules = $moduleIdArr;
        $earlierModulesArr = array();
        if(!empty($id)){
            $earlierModules = $learningPlanMgr->getCoursesIdBylearnigPlanSeq($id);
            if(!empty($earlierModules)){
                $earlierModulesArr = explode(",",$earlierModules);
            }
            $modules = array_diff($moduleIdArr,$earlierModulesArr);   
        }
        //nableModuleLeaderboard = 1;
       //enableLeaderboardArr = getArray($enableModuleLeaderboard);
        $id = $learningPlanMgr->saveLearningPlan($learningPlan,$moduleIdArr,null);
        $leaderBoardMgr = LeaderBoardMgr::getInstance();
        $leaderBoardMgr->deleteByLearningPlan($id);

        if($learningPlan->getIsLeaderBoard() == 1){
            SaveLeaderBoard($id);
        }
        $profileId = saveLearningPlanProfile($id);
        $message = "Learning Plan saved successfully.";
        $mailMessageUtil = MailMessageUtil::getInstance();
        $mailMessageUtil->checkForModuleEnrolementNotification($modules,$profileSeq);
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
        $trace = $e->getTrace();
        if($trace[0]["args"][0][1] == "1062"){
            $message = StringConstants::DUPLICATE_LEARNING_PLAN;        
        }
    }
    $response = new ArrayObject();
    $response["message"] = $message;
    $response["success"] =  $success;

    echo json_encode($response);
}
if($call == "deleteLearningPlan"){
    $ids = $_GET["ids"];
    try{
        $lpMgr = LearningPlanMgr::getInstance();
        $lpMgr->deleteLearningPlans($ids);
        $message = "Record Deleted successfully";
    }catch(Exception $e){
        $success = 0;
        $message = ErrorUtil::checkReferenceError(LearningPlan::$className,$e);
    }
    $response = new ArrayObject();
    $response["message"] = $message;
    $response["success"] =  $success;
    echo json_encode($response);
}

//To be moved to mgr class
function getArray($string){
    $a = explode(',', $string);
    foreach ($a as $result) {
        $b = explode('=', $result);
        $array[$b[0]] = $b[1];
    }
    return $array;
}

function saveLearningPlanProfile($id){
    $profile = $_POST["profile"];
    $learningPlanProfile = new LearningPlanProfile();
    $learningPlanProfile->setLearningPlanSeq($id);
    $learningPlanProfile->setLearningProfileSeq($profile);
    $dataStore = new BeanDataStore("LearningPlanProfile","learningplanprofiles");
    $id = $dataStore->save($learningPlanProfile);
    return $id;
}

function SaveLeaderBoard($id){
    $name = $_POST["name"];
    $leaderBoard = new LeaderBoard();
    $leaderBoard->setName($name);
    $leaderBoard->setIsEnabled(1);
    $leaderBoard->setCreatedOn(new DateTime());
    $leaderBoard->setLastModifiedOn(new DateTime());
    $leaderBoard->setModuleSeq(0);
    $leaderBoard->setLearningPlanSeq($id);
    $leaderBoard->setLeaderBoardType("LearningPlan");//TODO -- Create enum for Leaderboard Type.
    $leaderBoardMgr = LeaderBoardMgr::getInstance();
    $id = $leaderBoardMgr->Save($leaderBoard);
}
