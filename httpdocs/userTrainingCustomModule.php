<?require("sessionCheckForUser.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration - Easy Assessment Engine</title>
<?include "ScriptsInclude.php"?>
<?
    require_once($ConstantsArray['dbServerUrl'] ."Managers/ModuleMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/ActivityMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php5");
    $learningPlanSeq = $_GET['lpid'];
    $moduleId = $_GET['id'];
    $sessionUtil = SessionUtil::getInstance();
    $userSeq = intval($sessionUtil->getUserLoggedInSeq());
    $moduleMgr = ModuleMgr::getInstance();
    $activityMgr = ActivityMgr::getInstance();
    $module = $moduleMgr->getModule($moduleId);
    $moduleQuestions = $moduleMgr->getQuestions($moduleId);
    $allOptions = $moduleMgr->getModuleQuestionAnswer($moduleId);
    $userActivity = $activityMgr->getActivityByUser($userSeq,$moduleId);
    //$selecedOptions = $activityMgr->getSelectedAnswerSeqs($userSeq,$moduleId,$learningPlanSeq);
    $quizProgressList = $activityMgr->getQuizProgressByUser($userSeq,$moduleId,$learningPlanSeq);
    if(($module->getMaxQuestions() != null)){
        $randomModuleQuestions = array();
        $random_keys = null;
        if(count($quizProgressList) > 0){//Edit mode with some ansered questions
            foreach($quizProgressList as $key=>$value){
                $randomModuleQuestions[$key] = $moduleQuestions[$key];
                unset($moduleQuestions[$key]);
            }
            if($module->getMaxQuestions() - count($quizProgressList) > 0){
                $random_keys = array_rand($moduleQuestions,$module->getMaxQuestions() - count($quizProgressList));
            }
        }else{
            $random_keys = array_rand($moduleQuestions,$module->getMaxQuestions());
        }
        if($random_keys != null){
            if(!is_array($random_keys)){
                $random_keys = array($random_keys);
            }
            foreach($random_keys as $key){
                $randomModuleQuestions[$key] = $moduleQuestions[$key];
            }
        }
        if($randomModuleQuestions != null){
            $moduleQuestions = $randomModuleQuestions;
        }
    }
    function getFeedback($anseq,$quesSeq){
        global $allOptions;
        $options = $allOptions[intval($quesSeq)];
        foreach($options as $option){
            if($option->getSeq() == intval($anseq)){
                return $option;
            }
        }
    }
    function getCorrectAns($quesSeq){
        global $allOptions;
        $options = $allOptions[intval($quesSeq)];
        $correctAnsArrSeqs = array();
        foreach($options as $option){
            if($option->getMarks() > 0){
                array_push($correctAnsArrSeqs,$option->getSeq());
            }
        }
        return $correctAnsArrSeqs;
    }
    ?>

<script language="javascript">
    var learningPlanSeq = "<?echo $learningPlanSeq;?>";
</script>
</head>
<body class='default no-js'>
<div id="wrapper">
    <?include("userMenu.php");?>
    <div class="row">
        <div class="col-md-12">
            <div class="wrapper wrapper-content">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5><?echo $module->getTitle()?></h5><br><br>
                        <div><?echo $module->getDescription()?></div>

                    </div>
                    <?$type =$module->getModuleType();
                      $fileName = $type ."TypeModule.php";
                      include($fileName);
                    ?>
               </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
function setProgress(percent){
    $(".completionPercent").html(percent);
    $(".progress-bar").width(percent+"%");
}

</script>