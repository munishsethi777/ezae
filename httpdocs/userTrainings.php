<?require("sessionCheckForUser.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trainings - Easy Assessment Engine</title>
<?include "ScriptsInclude.php"?>
<style>
.jqx-widget .jqx-grid-cell, .jqx-widget .jqx-grid-column-header, .jqx-widget .jqx-grid-group-cell{
    border-top:none !important;
    border-left:none !important;
    border-right:none !important;

}
#contenttablejqxgrid > div{
    height:50px !important;
    line-height:20px;
}
.jqx-grid-header{
    height:50px !important;
    font-weight:500;

}
#columntablejqxgrid > div{
    background:#F9F9F9;
    line-height:30px;
}
</style>
</head>
<body class='default'>
<div id="wrapper">
        <?include("userMenu.php");?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-12">
                <h2>Trainings List</h2><hr>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Select Learning Plan</label>
                    <div class="col-lg-3">
                        <select class="form-control" id="learningPlanComboBox" name="learningPlanComboBox"></select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                    <div class="ibox">

                        <div class="ibox-content">
                            <div id="jqxgrid"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</body>
</html>
<script>
$(document).ready(function(){
    //loadGrid();
    loadLearningPlansCombo();
})
function loadGrid(learningPlanSeq){
        var columns = [
          { text: 'id', datafield: 'id' , hidden:true},
          { text: 'Status' , datafield: 'status', width: '8%'},
          { text: 'Module' , datafield: 'moduleName', width: '30%'},
          { text: 'Completion Percent', datafield: 'completionPercent', width: '20%' },
          //{ text: 'Completing In', datafield: 'daysToComplete', width: '10%'},
          { text: 'Scores', datafield: 'scores', width: '7%' },
          { text: 'Rank', datafield: 'leaderboardRank', width: '5%' },
          { text: 'Remarks', datafield: 'inactiveRemarks', width: '20%' },
          { text: 'Action', datafield: 'action' , width: '10%'}
        ]
        var source =
        {
            datatype: "json",
            id: 'id',
            pagesize: 20,
            //localData: rows,
            datafields: [
                { name: 'id', type: 'integer' },
                { name: 'status', type: 'string' },
                { name: 'moduleName', type: 'string' },
                //{ name: 'daysToComplete', type: 'integer' },
                { name: 'scores', type: 'string' },
                { name: 'completionPercent', type: 'integer' },
                { name: 'leaderboardRank', type: 'integer' },
                { name: 'inactiveRemarks', type: 'string' },
                { name: 'action', type: 'string' }
            ],
            url: 'Actions/UserAction.php?call=getModulesForUserTrainingGrid&learningPlanSeq='+ learningPlanSeq
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#jqxgrid").jqxGrid(
        {
            width: '100%',
            height: '400px',
            source: dataAdapter,
            columns: columns,
            columnsresize: true
        });
    }
function loadLearningPlansCombo(){
    var url = 'Actions/UserAction.php?call=getLearningPlansForUser';
    $.getJSON(url, function(data){
        var options = "";
        $.each(data, function(index , value){
            options += "<option value='" + value.id + "'>" + value.title + "</option>";
        });
        $("#learningPlanComboBox").html(options);
        loadGrid(data[0].id);
    });
    $('#learningPlanComboBox').change(function(){
        loadGrid(this.value);
    });
}
</script>
