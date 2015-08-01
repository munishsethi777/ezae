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
    saveScores(moduleId, progress, score, 1);
}
function saveScores(moduleId, progress, score,learningPlanSeq){
    var url = "http://localhost:8080/Actions/ActivityAction.php?call=saveActivityData&moduleId="+moduleId+"&progress="+progress+"&score="+score +"&lpid="+learningPlanSeq;
    $.get(url, function(data){
        //alert(data);
    });
}