<?require("sessionCheckForUser.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration - Easy Assessment Engine</title>
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
            <div class="col-sm-4">
                <h2>Trainings List</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="active">
                        <strong>Trainings</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>All trainings assigned to munish</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div style="float:left;margin-top:5px;margin-right:6px;">Learning Plan : </div>
                                <div style="float:left" id="learningPlanComboBox"></div>
                            </div>

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
          { text: 'Status' , datafield: 'status', width: '5%'},
          { text: 'Module' , datafield: 'moduleName', width: '30%'},
          { text: 'Completing In', datafield: 'daysToComplete', width: '10%'},
          { text: 'Scores', datafield: 'scores', width: '5%' },
          { text: 'Percent', datafield: 'completionPercent', width: '15%' },
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
                { name: 'daysToComplete', type: 'integer' },
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
    var source =
    {
        datatype: "json",
        datafields: [
        { name: 'id'},
        { name: 'title'}
        ],
        url: 'Actions/UserAction.php?call=getLearningPlansForUser',
        async: true
    };

    var dataAdapter = new $.jqx.dataAdapter(source);

    $("#learningPlanComboBox").jqxComboBox({
        source: dataAdapter,
        width: '300',
        height: 25,
        selectedIndex: 0,
        displayMember: 'title',
        valueMember: 'id',
        theme: 'arctic'
    });
    $('#learningPlanComboBox').on('change', function (event){
        var args = event.args;
        if (args) {
           var item = args.item;
           loadGrid(item.value);
           //alert(item.value);
        }
    });

}
</script>
