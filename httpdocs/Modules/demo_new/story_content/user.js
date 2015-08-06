function ExecuteScript(strId)
{
  switch (strId)
  {
      case "5g2Cu4r1C1K":
        Script1();
        break;
  }
}

function Script1()
{
    var player=GetPlayer();
    var moduleId= "1";
    var progress= player.GetVar("Progress");
    var score=player.GetVar("Score");

    var learningPlan = parent.learningPlanSeq;
    saveScores(moduleId, progress, score, learningPlan);

}
function saveScores(moduleId, progress, score,learningPlanSeq){
    var url = "http://localhost:8083/httpdocs/Actions/ActivityAction.php?call=saveActivityData&moduleId="+moduleId+"&progress="+progress+"&score="+score +"&lpid="+learningPlanSeq;
    $.get(url, function(data){
        //alert(data);
    });
}