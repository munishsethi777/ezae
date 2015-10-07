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
    $moduleId = 2;//$_GET['id'];
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
                         <div id="progressbar" class="progress progress-bar-default">
                            <div style="width:0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar">
                               <span class="completionPercent">0</span>% completed
                            </div>
                        </div>
                    </div>
                    <?include("QuizType.php");?>
               </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>

var api = null;
slideCounter = 0;
$(document).ready(function(){
    <?if($userActivity != null){?>
        setProgress(<?echo$userActivity->getProgress()?>);    
    <?}?>
    
    $('#main-slider').liquidSlider();
    $(".liquid-slider .panel-container .clone form").attr("id","");
    api = $.data( $('#main-slider')[0], 'liquidSlider');
    $("#main-slider-nav-ul").hide();
     setValuesOnEdit();    
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
    
});

function finish(){
    window.location.href = "userTrainings.php";
}
function checkPossibleAnsValidation(quesSeq){
  selectedCount = 0;
  pcount = $("#form" + quesSeq + " #possibleAnsCount" + quesSeq).val();
  pcount = parseInt(pcount);  
  $("#form" + quesSeq + " input:checkbox").each(function() {
      if(this.checked){
        selectedCount++;    
      } 
  });
  if(selectedCount > pcount){
    toastr.error("You can't select more than " + pcount +" options","Failed");
    return false;
   // var input = $("#form" + quesSeq + ' input[id=chkOpt' + ansSeq + ']');
    //input.iCheck('uncheck');
  }
  return true;
}

function setValuesOnEdit(){
    var isLast = false;
   <?$i = 0;
   $questionCount = 0;
   $quesSeqArr = array();
   
   foreach($quizProgressList as $qp){
       if(!in_array($qp->getQuestionSeq(),$quesSeqArr)){
            array_push($quesSeqArr,$qp->getQuestionSeq());
            $questionCount++;
       }
       ?>
        var quesSeq = "<?echo $qp->getQuestionSeq()?>";
        var ansSeq  = "<?echo$qp->getAnswerSeq()?>";
        var formId = "#form" + quesSeq;
        $(formId + " input:radio[value=<?echo$qp->getAnswerSeq()?>]").attr('checked',true);
        $(formId + " input:checkbox[value=<?echo$qp->getAnswerSeq()?>]").attr('checked',true);
        
       <?if($questionCount == $totalCount){?>
            $("#finishBtn").show(); 
            isLast = true;           
        <?}else{?>
            $(formId + " #nextBtnDiv" + quesSeq).show();
        <?}?>
        $(formId +  " #submitBtnDiv" + quesSeq).hide(); 
        <?if($i > 0){?>
            $(formId + " #prevBtnDiv" + quesSeq).show();               
        <?}?>
        <?$ans = getFeedback($qp->getAnswerSeq(),$qp->getQuestionSeq());?>
            var feedback = "<?echo$ans->getTitle() ." - " .$ans->getFeedback()?>";
            <?if(intval($ans->getMarks()) > 0){?>
                $(formId + " #success" + quesSeq).html(feedback);
                $(formId + " #success" + quesSeq).show();
                $(formId + " #check" + ansSeq).show();
            <?}else{?>
                $(formId + " #danger" + quesSeq).html(feedback);
                $(formId + " #danger" + quesSeq).show(); 
                <?$correctAnsSeqs = getCorrectAns($qp->getQuestionSeq());
                    foreach($correctAnsSeqs as $seq){?>
                        $(formId + " #check" + "<?echo$seq?>").show();
                    <?}
                ?>
           <? }?>
   <?$i++;}?>
    var slide = "<?echo $questionCount?>"
    
    
        slide = slide - 1;
    
    api.setNextPanel(slide);api.updateClass($(formId)); 
    slideCounter = slide;
}



function setNextPannel(btn){
    slideCounter++;
    api.setNextPanel(slideCounter);api.updateClass($(btn));
}
function setPrevPannel(btn){
    slideCounter--;
    api.setNextPanel(slideCounter);api.updateClass($(btn));
}

function checkValidations(quesSeq,type){
    inputType = "radio"
    if(type == "multi"){
        inputType = "checkbox";    
    }
    hasChecked = false;
    var inputs = $("#form" + quesSeq + " input:" + inputType).each(function() {
      if(this.checked){
         hasChecked = true;
      }
  });
   return hasChecked;
}
function submitAns(quesSeq,btn,questionNumber,quesType){
     if(!checkValidations(quesSeq,quesType)){
         toastr.error("Select at least one option");  
         return;  
     }
     //var form = $(btn).parents('form:first');
     if(quesType == "multi"){
         isValid = checkPossibleAnsValidation(quesSeq)
         if(!isValid){             
             return;
         }
      }
      var l = Ladda.create(btn);
      l.start();
      var percent = 0;
      var totalCount = "<?echo $totalCount?>";
      percent = (questionNumber/totalCount) * 100 ;
     $("#form" + quesSeq + " #progress").val(percent);
     $("#form" + quesSeq).ajaxSubmit(function( data ){
        l.stop();
        var obj = $.parseJSON(data);
        var dataRow = "";
        var divClass = "#form" + quesSeq + " #success" + quesSeq;
        anslist = obj.ansList.correct;
        if(obj.success == 0){
            divClass = "#form" + quesSeq + " #danger" + quesSeq;
            anslist =  obj.ansList.incorrect;
        }
        htmlCont = "";
        html = "";
        $.each(anslist, function(key, value){
           htmlCont += value + "<br/>";
        })
        $.each(obj.ansList.correct, function(key, value){
           $("#form" + quesSeq + " #check" + key).show();
           if(value != ""){
                html += value + "<br/>";     
           }
        })
        if(quesType == "multi"){
            var sucessDiv = "#form" + quesSeq + " #success" + quesSeq;
            $(sucessDiv).html(html);
            $(sucessDiv).show();    
        }
        $(divClass).html(htmlCont);
        $(divClass).show();
        
        //$("next");
        if(slideCounter > 0){
            $("#form" + quesSeq + " #prevBtnDiv" + quesSeq).show();
        }
        if((totalCount -1) != slideCounter ){
            $("#form" + quesSeq + " #nextBtnDiv" + quesSeq).show();
        }
        $("#form" + quesSeq + " #submitBtnDiv" + quesSeq).hide();
        setProgress(percent);
        if(slideCounter == (totalCount-1)){
            toastr.success("Quiz Completed.");
            $("#finishBtn").show();
        }
    })

        
}
function setProgress(percent){
    $(".completionPercent").html(percent);
    $(".progress-bar").width(percent+"%");
}

</script>