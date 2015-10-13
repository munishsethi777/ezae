<?
     $moduleQuestions = $moduleMgr->getQuestions($module["seq"]);
     $allOptions = $moduleMgr->getModuleQuestionAnswer($module["seq"]);
?>
            <div class="ibox-content liquid-slider-parent">
                    <div id="main-slider" class="liquid-slider">
                        <?$totalCount = count($moduleQuestions);
                         $i = 1;
                         foreach($moduleQuestions as $question){
                                $questionSeq = $question->getSeq();
                                $questionType = $question->getQuestionType();?>
                        <div>
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
                                    <table class="table table-hover table-mail">
                                        <tbody>
                                            <?
                                            $possibleAns = $allOptions[$question->getSeq()];
                                            foreach($possibleAns as $ans){?>
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
                                        </tbody>
                                     </table>
                                     
                                    </form>
                                    
                                </div>
                             </div>
                         </div>
                         <?$i++;}?>
                      </div>
                      <div class="p-xl">
                        <button class="btn btn-sm btn-primary m-t-n-xs pull-left" onclick="setPrevPannel(this)" id="prevBtnDiv" style="display: none;" type="button"><strong><i class="fa fa-long-arrow-left"></i> Previous</strong></button>
                        <button class="btn btn-sm btn-primary m-t-n-xs pull-right" onclick="setNextPannel(this)" id="nextBtnDiv" type="button"><strong>Next <i class="fa fa-long-arrow-right"></i></strong></button>
                      </div>                                    
                    <div class="p-xl">
                        <button class="btn btn-sm btn-primary m-t-n-xs pull-right" style="display: none;"  id="finishBtn" type="button"><strong>Finish <i class="fa fa-long-arrow-right"></i></strong></button>
                    </div>
                         
            </div>
                    
<script>
var api = null;
slideCounter = 0;
$(document).ready(function(){
    $('#main-slider').liquidSlider();
    $(".liquid-slider .panel-container .clone form").attr("id","");
    api = $.data( $('#main-slider')[0], 'liquidSlider');
    $("#main-slider-nav-ul").hide(); 
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
});

function setNextPannel(btn){
    var totalCount = "<?echo $totalCount?>";
    slideCounter++;
    api.setNextPanel(slideCounter);api.updateClass($(btn));
    if(slideCounter > 0){
        $("#prevBtnDiv").show();
    }
    if(slideCounter == (totalCount-1)){
        $("#nextBtnDiv").hide();
        $("#finishBtn").show();
    }
}
function setPrevPannel(btn){
    slideCounter--;
    api.setNextPanel(slideCounter);api.updateClass($(btn));
    if(slideCounter == 0){
        $("#prevBtnDiv").hide();    
    }else{
         $("#nextBtnDiv").show();
         $("#finishBtn").hide();
    }
}
</script>