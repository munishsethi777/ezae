<div id="progressbar" class="progress progress-bar-default" style="margin:10px 0px 10px 0px">
                            <div style="width:0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar">
                               <span class="completionPercent">0</span>% completed
                            </div>
                        </div>
<div class="ibox-content liquid-slider-parent">
                    <div id="main-slider" class="liquid-slider">
                     <?$totalCount = count($moduleQuestions);
                         $i = 1;
                         foreach($moduleQuestions as $question){
                                $questionSeq = $question->getSeq();
                                $questionType = $question->getQuestionType();?>
                         <div style="width:100%">

                             <div class="col-md-8 col-md-offset-2" >
                                 <div  style="border:silver solid 1px;height:500px">
                                    <div class="ibox-content">
                                        <span class="pull-left">Question <?echo $i?> of <?echo $totalCount?></span>
                                        <span class="pull-right">Marks: <?echo $question->getMaxMarks()?></span>
                                    </div>
                                    <div class="ibox-content ibox-heading">
                                        <h2 style="padding-bottom:10px;">Question <?echo $i?>. <?echo $question->getTitle()?> ?</h2>
                                    </div>
                                    <form method="post" id="form<?echo$questionSeq?>" name="form<?echo$questionSeq?>" action="Actions/ActivityAction.php">
                                        <input type="hidden" name="call" value="submitAnswer" />
                                        <input type="hidden" name="questionseq" value="<?echo $questionSeq?>"/>
                                        <input type="hidden" name="moduleseq" value="<?echo $module->getSeq()?>"/>
                                        <input type="hidden" name="learningplanseq" value="<?echo $learningPlanSeq?>"/>
                                        <input type="hidden" name="progress" id="progress"/>
                                    <table class="table table-hover table-mail">
                                        <tbody>
                                            <?$possibleAnsCount = 0;
                                            $possibleAns = $allOptions[$question->getSeq()];
                                            foreach($possibleAns as $ans){
                                            if($ans->getMarks() > 0){
                                                $possibleAnsCount++;
                                            }?>
                                                <tr class="read">
                                                    <td class="check-mail">

                                                        <div class="i-checks">
                                                        <?if($questionType == "multi"){?>
                                                            <label>
                                                                <input type="checkbox"  id="chkOpt<?echo$ans->getSeq()?>" onchange="checkPossibleAnsValidation(<?echo$questionSeq?>,<?echo$ans->getSeq()?>)" value="<?echo $ans->getSeq()?>" name="answer<?echo$questionSeq?>[]">
                                                            <i></i></label>
                                                        <?}else{?>
                                                            <label>
                                                                <input type="radio" value="<?echo $ans->getSeq()?>" name="answer<?echo$questionSeq?>">
                                                            <i></i></label>
                                                        <?}?>
                                                            </div>
                                                    </td>
                                                    <td width="90%"><?echo $ans->getTitle()?></td>
                                                    <td><i id="check<?echo $ans->getSeq()?>" class="fa fa-check text-navy" style="display: none;"></i></td>
                                                </tr>
                                             <?}?>

                                             <input type="hidden" id="possibleAnsCount<?echo $questionSeq?>" name="possibleAnsCount<?echo $questionSeq?>" value="<?echo $possibleAnsCount?>" />
                                        </tbody>
                                     </table>
                                     <div class="p-xl">
                                        <div class="col-sm-offset-5">
                                             <button class="btn btn-primary" id="submitBtnDiv<?echo $questionSeq?>" onclick="submitAns(<?echo $questionSeq?>,this,<?echo$i?>,'<?echo $questionType?>')" type="button"><strong><i class="fa fa-lock"></i>
                                                <span class="ladda-label">Submit Answer</strong></span>
                                             </button>
                                        </div>
                                        <div id="success<?echo $questionSeq?>" class="alert alert-success" style="display: none;"></div>
                                        <div id="danger<?echo $questionSeq?>" class="alert alert-danger" style="display: none;"></div>

                                        <button class="btn btn-sm btn-primary m-t-n-xs pull-left" onclick="setPrevPannel(this)" id="prevBtnDiv<?echo $questionSeq?>" style="display: none;" type="button"><strong><i class="fa fa-long-arrow-left"></i> Previous</strong></button>
                                        <button class="btn btn-sm btn-primary m-t-n-xs pull-right" onclick="setNextPannel(this)" id="nextBtnDiv<?echo $questionSeq?>" style="display: none;" type="button"><strong>Next <i class="fa fa-long-arrow-right"></i></strong></button>
                                     </div>
                                    </form>
                                </div>
                             </div>
                         </div>
                         <?$i++;}?>
                    </div>
                    <div class="p-xl">
                        <button class="btn btn-sm btn-primary m-t-n-xs pull-right" onclick="finish()" style="display: none;"  id="finishBtn" type="button"><strong>Finish <i class="fa fa-long-arrow-right"></i></strong></button>
                    </div>

                    </div>

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
    <?if(count($quizProgressList) > 0){?>
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
    <?}?>
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
        percent = Math.round(percent);
        setProgress(percent);
        if(slideCounter == (totalCount-1)){
            toastr.success("Quiz Completed.");
            $("#finishBtn").show();
        }
    })


}
</script>