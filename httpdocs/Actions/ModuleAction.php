<?
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ModuleMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php5");
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

if($call == "getModulesForGrid"){
    try{
        $moduleMgr = ModuleMgr::getInstance();
        $data = $moduleMgr->getModulesForGrid($companySeq);
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
    echo $data;
}

//used in create learning plan ui in edit mode to display modules in grid
if($call == "getLearningPlanModulesForGrid"){
    try{
        $moduleMgr = ModuleMgr::getInstance();
        $id =  intval($_GET["id"]);
        $data = "";
        if($id > 0){
            $data = $moduleMgr->getLearningPlanModulesForGrid($id);
        }
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
    echo $data;
}

if($call == "getModulesBySelectedLearningPlan"){
    try{
        $moduleMgr = ModuleMgr::getInstance();

        if(isset($_GET["ids"]) && !empty($_GET["ids"])){
            $ids =  $_GET["ids"];
            $data = $moduleMgr->getModulesByLearningPlans($ids);
        }else{
            $data = $moduleMgr->getModulesJSON($companySeq);
        }
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
    echo $data;
}

//used to display modules in user training grid
if($call == "getModulesForUserTrainingGrid"){
    try{
        $sessionUtil = SessionUtil::getInstance();
        $loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
        $moduleMgr = ModuleMgr::getInstance();
        if($loggedInUserSeq > 0){
            $data = $moduleMgr->getModulesForUserTrainingGrid($loggedInUserSeq);
        }
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
    echo $data;
}

//* REPORTING METHODS STARTS HERE //*
//Completion Metrics Reporting page, load modules by learningplan
if($call == "getModulesByLearningPlanForReporting"){
    try{
        $moduleMgr = ModuleMgr::getInstance();
        if(isset($_GET["learningPlanSeq"]) && !empty($_GET["learningPlanSeq"])){
            $id =  $_GET["learningPlanSeq"];
            $data = $moduleMgr->getModulesByLearningPlans($id);
        }
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
    echo $data;
}
//* REPORTING METHODS ENDS HERE //*
?>

