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
    $learningPlanSeq = 2;//$_GET['lpid'];
    $moduleId = 3;//$_GET['id'];
    $userSeq = 18116;
    $moduleMgr = ModuleMgr::getInstance();
    $activityMgr = ActivityMgr::getInstance();
    $module = $moduleMgr->getModule($moduleId);
    $moduleQuestions = $moduleMgr->getQuestions($moduleId);
    $allOptions = $moduleMgr->getModuleQuestionAnswer($moduleId);
    $userActivity = $activityMgr->getActivityByUser($userSeq,$moduleId);
    //$selecedOptions = $activityMgr->getSelectedAnswerSeqs($userSeq,$moduleId,$learningPlanSeq);
    $quizProgressList = $activityMgr->getQuizProgressByUser($userSeq,$moduleId,$learningPlanSeq);
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