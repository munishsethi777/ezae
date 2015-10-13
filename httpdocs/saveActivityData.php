    <script>
    $(document).ready(function(){
        $.getJSON("Actions/ActivityAction.php?call=saveActivityData&moduleId=<?echo$moduleId?>&lpid=<?echo$learningPlanSeq?>&progress=100&score=<?echo$module->getMaxScore()?>", 
            function(data){
            
            }
        )
    });
    </script>