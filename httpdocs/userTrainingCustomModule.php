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
    $learningPlanSeq = 11;//$_GET['lpid'];
    $moduleId = 5;//$_GET['id'];
    $moduleMgr = ModuleMgr::getInstance();
    $module = $moduleMgr->getModule($moduleId);
    $moduleQuestions = $moduleMgr->getQuestions($moduleId);
    $questionPossibleAns = $moduleMgr->getModuleQuestionAnswer($moduleId)?>
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
                        <div class="ibox-content liquid-slider-parent">
                        <div id="main-slider" class="liquid-slider">
                         <?$totalCount = count($moduleQuestions);
                             $i = 1;
                             foreach($moduleQuestions as $question){
                                    $questionSeq = $question->getSeq();?>
                             <div style="width:100%">
                                 <div class="col-md-8 col-md-offset-2" >
                                     <div  style="border:silver solid 1px;height:500px">
                                        <div class="ibox-content">
                                            <span class="pull-left">Question <?echo $i?> of <?echo $totalCount?></span>
                                            <span class="pull-right">Marks:<?echo $question->getMaxMarks()?></span>
                                        </div>
                                        <div class="ibox-content ibox-heading">
                                            <h2 style="padding-bottom:10px;">Question <?echo $i?>. <?echo $question->getTitle()?> ?</h2>
                                        </div>
                                        <form method="post" id="form<?echo$questionSeq?>" name="form<?echo$questionSeq?>" action="Actions/ActivityAction.php">
                                            <input type="hidden" name="call" value="submitAnswer" />
                                            <input type="hidden" name="questionseq" value="<?echo $questionSeq?>"/>
                                            <input type="hidden" name="moduleseq" value="<?echo $module->getSeq()?>"/>
                                            <input type="hidden" name="learningplanseq" value="<?echo $module->getSeq()?>"/>

                                            <table class="table table-hover table-mail">
                                                <tbody>
                                                <?$possibleAns = $questionPossibleAns[$question->getSeq()];
                                                foreach($possibleAns as $ans){?>
                                                    <tr class="read">
                                                        <td class="check-mail">
                                                            <div class="i-checks">
                                                                <label>
                                                                    <input type="radio" value="<?echo $ans->getSeq()?>" name="answer<?echo$questionSeq?>">
                                                                <i></i></label></div>
                                                        </td>
                                                        <td width="90%"><?echo $ans->getTitle()?></td>
                                                        <td><i id="check<?echo $ans->getSeq()?>" class="fa fa-check text-navy" style="display: none;"></i></td>
                                                    </tr>
                                                 <?}?>
                                                </tbody>
                                             </table>
                                            <div class="p-xl">
                                                 <div class="col-sm-offset-5">
                                                    <button class="btn btn-primary" id="submitBtnDiv<?echo $questionSeq?>" onclick="submitAns(<?echo $questionSeq?>,<?echo $i?>,this)" type="submit"><strong><i class="fa fa-lock"></i> <span class="ladda-label">Submit Answer</strong></span></button>
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
                        </div>
                   </div>
                </div>
            </div>
        </div>
</div>
</body>
</html>
<script>

var api = null;
$slideCounter = 0;
$(document).ready(function(){
    $('#main-slider').liquidSlider();
    $(".liquid-slider .panel-container .clone form").attr("id","");
    api = $.data( $('#main-slider')[0], 'liquidSlider');
    $("#main-slider-nav-ul").hide();
});
function setNextPannel(btn){
    $slideCounter++;
    api.setNextPanel($slideCounter);api.updateClass($(btn));
}
function setPrevPannel(btn){
    $slideCounter--;
    api.setNextPanel($slideCounter);api.updateClass($(btn));
}
function submitAns(quesSeq,questionNumber,btn){
    var l = Ladda.create(btn);
    l.start();
     //var form = $(btn).parents('form:first');
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
        $.each(anslist, function(key, value){
           htmlCont = value + "<br/>";
        })
        $.each(obj.ansList.correct, function(key, value){
           $("#form" + quesSeq + " #check" + key).show();
        })
        $(divClass).html(htmlCont);
        $(divClass).show();
        var totalCount = "<?echo $totalCount?>";
        var percent = (questionNumber/totalCount) * 100 ;
        //$("next");
        if($slideCounter > 0){
            $("#form" + quesSeq + " #prevBtnDiv" + quesSeq).show();
        }
        if((totalCount -1) != $slideCounter ){
            $("#form" + quesSeq + " #nextBtnDiv" + quesSeq).show();
        }
        $("#form" + quesSeq + " #submitBtnDiv" + quesSeq).hide();
        $(".completionPercent").html(percent);
        $(".progress-bar").width(percent+"%");
    })


}


</script>