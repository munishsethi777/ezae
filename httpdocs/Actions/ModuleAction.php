<?
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ModuleMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CompanyMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/ModuleType.php");    
require_once($ConstantsArray['dbServerUrl'] ."Managers/QuestionMgr.php"); 
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php5");
require_once($ConstantsArray['dbServerUrl'] ."Utils/FileUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Question.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/QuestionAnswer.php");
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
if($call == "saveModule"){
    $moduleMgr = ModuleMgr::getInstance();
    try{
        $id = $_POST["id"];
        $name = $_POST["name"];
        $isalreadyExist = $moduleMgr->moduleAlreadyExist($id,$name);
        if($isalreadyExist){
            throw new Exception("Module is already exist with this name!");    
        }
        $description = $_POST["description"];
        $type = $_POST["moduleType"];
        $tagline = $_POST["tagline"];
        $preReq = $_POST["prereq"];
        $tags = $_POST["tags"];
        $maxMarks = $_POST["maxmarks"];
        $passPercent = $_POST["passpercent"];
        $timeAllowed = $_POST["time"];
        $questions = $_POST["selectedQuestions"];
        $moduleType = $_POST["moduleType"];
        $typeDetail = "";
        $imgfilePath = "";
        $module = new Module();
        
        if($id > 0){
            $moduleObj = $moduleMgr->getModule($id);
            $typeDetail = $moduleObj->getTypeDetails();
            $imgfilePath = $moduleObj->getImagePath();
        }
        if($type == ModuleType::EASSY){
            $typeDetail = $_POST["eassy"];    
        }else if($type == ModuleType::VIDEO){
            $typeDetail = $_POST["vembedCode"];
        }else if($type == ModuleType::AUDIO){
            $typeDetail = $_POST["aembedCode"];
        }else if($type == ModuleType::DOCUMENT){  
             if(isset($_FILES["fileToUpload"])){
                $file = $_FILES["fileToUpload"];
                $uploaddir = $ConstantsArray["docspath"] . "moduledocs\\";
                $fileName = FileUtil::uploadFiles($file,$uploaddir);
                $typeDetail = $fileName;        
             }   
        }
        $module->setSeq($id);
        $module->setCompanySeq($companySeq);
        $module->setDescription($description);
        $module->setCreatedOn(new DateTime());
        $module->setIsEnabled(1);
        $module->setIsPaid(0);
        $module->setPrerequisties($preReq);
        $module->setModuleType($moduleType);
        $module->setTagLine($tagline);
        $module->setTimeAllowed($timeAllowed);
        $module->setTitle($name);
        $module->setImagePath($imgfilePath);
        $module->setTags($tags);
        $module->setMaxScore($maxMarks);
        $module->setPassPercent($passPercent);
        $module->setTypeDetails($typeDetail);
        $module->setLastModifiedOn(new DateTime());
        $id = $moduleMgr->saveModule($module);
        if($type == ModuleType::QUIZ){
            $moduleMgr->saveModuleQuestion($questions,$id);
        }
        $companyMgr = CompanyMgr::getInstance();
        $companyMgr->saveCompanyModule($id);
        if(isset($_FILES["imgfileToUpload"])){
            $file = $_FILES["imgfileToUpload"];
            $moduleImageName = $id.".jpg";
            $uploaddir = $ConstantsArray["imagefolderpath"] . "modules\\";
            $imgfilePath = FileUtil::uploadImageFiles($file,$uploaddir,$moduleImageName);
            $moduleMgr->updateMoudleImageName($id,$imgfilePath);
        }
        $message = "Module Added Sucessfully";     
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
     $response = array();
     $response["success"] = $success;
     $response["message"] = $message;
     echo json_encode($response);
    
}
if($call == "getQuestions"){
    try{
        $questionMgr = QuestionMgr::getInstance();
        $data = $questionMgr->getQuestions();
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
    echo $data;
}

if($call == "saveQuestion"){
    $questionMgr = QuestionMgr::getInstance();
    $addedQuestionArr = array(); 
    try{
        $name = $_POST["questionname"];
        $isalreadyExist = $questionMgr->isAlreadyExist($name);
        if($isalreadyExist){
            throw new Exception("Question is already exist with this name!");    
        }
        $questionType = $_POST["questiontype"];
        $options = $_POST["option"];
        $feedbacks = $_POST["feedback"];
        $marks = $_POST["marks"];
        $maxMarks = 0;
        if(isset($_POST["totalMarks"])){
            $maxMarks = $_POST["totalMarks"];    
        }    
        $addedQuestionArr = array();  
        $question = new Question();
        $question->setAdminSeq($adminSeq);
        $question->setCompanySeq($companySeq);
        $question->setCreatedOn(new DateTime());
        $question->setIsEnabled(1);
        $question->setLastModifiedOn(new DateTime());
        $question->setMaxMarks($maxMarks);
        $question->setQuestionType($questionType);
        $question->setTitle($name);
        $id = $questionMgr->saveQuestion($question);
        $question->setSeq($id); 
        for($i = 0;$i < count($options);$i++){
            $feedback = $feedbacks[$i];
            $option = $options[$i];
            $mar = $marks[$i];
            $questionAnswer =  new QuestionAnswer();
            $questionAnswer->setFeedback($feedback);
            $questionAnswer->setQuestionSeq($id);
            $questionAnswer->setMarks($mar);
            $questionAnswer->setTitle($option);
            $questionMgr->saveQuestionAnswer($questionAnswer);
        }
        $message = "Question Added Sucessfully"; 
        $addedQuestionArr = $questionMgr->toArray($question);                               
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
     $response = array();
     $response["success"] = $success;
     $response["message"] = $message;
     $response["question"] = $addedQuestionArr;
     echo json_encode($response);
     return; 
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

