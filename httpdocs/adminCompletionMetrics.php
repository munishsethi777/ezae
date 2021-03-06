<?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php"?>

    <script type="text/javascript">
        var isloaded = false
        $(document).ready(function (){
            loadLearningPlansCombo();
            $("#showReportButton").click(function () {
                   populatePie();
            });

        });
        function populatePie(){
            $(".list-group").fadeOut();
                var learningPlanSeq = $("#learningPlanComboBox").val();
                var moduleSeq = $("#moduleComboBox").val();
                var moduleLabel = $("#moduleComboBox").val();
                loadPie(learningPlanSeq,moduleSeq,moduleLabel,"attemptedNotAttempted");
                loadPie(learningPlanSeq,moduleSeq,moduleLabel,"completedNotCompleted");
                loadPie(learningPlanSeq,moduleSeq,moduleLabel,"completedNotCompletedNotAttempted");
                loadTablesStats(learningPlanSeq,moduleSeq);
        }
        function loadLearningPlansCombo(){
            var url = 'Actions/LearningPlanAction.php?call=getLearnerPlansForReporting';
            $.getJSON(url, function(data){
                var options = "";
                $.each(data.Rows, function(index , value){
                    options += "<option value='" + value.id + "'>" + value.title + "</option>";
                });
                $("#learningPlanComboBox").html(options);
                loadModulesCombo(data.Rows[0].id);
            });
            $('#learningPlanComboBox').change(function(){
                loadModulesCombo(this.value);
            });
        }
        function loadModulesCombo(learningPlanSeq){
            var url = 'Actions/ModuleAction.php?call=getModulesByLearningPlanForReporting&learningPlanSeq='+learningPlanSeq;
            $.getJSON(url, function(data){
                var options = "";
                $.each(data, function(index , value){
                      options += "<option value='" + value.id + "'>" + value.title + "</option>";
                });
                $("#moduleComboBox").html(options);
                if(!isloaded){
                    populatePie();
                    isloaded = true;
                }
            });



        }

        function loadPie(learningPlanSeq,moduleSeq,moduleLabel,mode){
             // prepare chart data as an array
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'Status' },
                    { name: 'Share' }
                ],
                url: 'Actions/ActivityAction.php?call=getModuleCompletionData&moduleSeq='+ moduleSeq +'&mode='+mode +'&learningPlanSeq='+learningPlanSeq
            };
            var dataAdapter = new $.jqx.dataAdapter(source, {
                async: false,
                autoBind: true,
                loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
            // prepare jqxChart settings
            var settings = {
                title: "",
                description: "",
                enableAnimations: true,
                showLegend: true,
                showBorderLine: false,
                titlePadding: { left: 0, top: 20, right: 0, bottom: 10 },
                source: dataAdapter,
                colorScheme: 'scheme20',
                seriesGroups:
                    [
                    {
                    type: 'pie',
                    showLabels: true,
                    series:
                        [
                        {
                            dataField: 'Share',
                            displayText: 'Status',
                            labelRadius: 0,
                            initialAngle: 45,
                            radius: 100,
                            centerOffset: 0,
                            formatFunction: function (value) {
                                if (isNaN(value))
                                    return value;
                                return parseFloat(value) + '%';
                            },
                        }
                        ]
                    }
                    ]
            };
            // setup the chart

            $('#'+ mode).jqxChart(settings);
        }

        function loadTablesStats(learningPlanSeq,moduleSeq){
            var url = 'Actions/ActivityAction.php?call=getModuleCompletionData&moduleSeq='+ moduleSeq +'&mode=getOverAllInfo&learningPlanSeq='+learningPlanSeq;;
            $.getJSON(url, function(data){
                $(".list-group").slideDown("slow");
                data = data[0];
                $(".totalRequestsCount").html(data.total);
                $(".totalAttemptedCount").html(data.attempted);
                $(".totalUnattemptedCount").html(data.unattempted);
                $(".totalCompletedCount").html(data.completed);
                $(".totalUncompletedCount").html(data.uncompleted);
            });
        }

    </script>
    <style>
        .chartDiv{
            height:300px;
            width:100%;
        }
    </style>
</head>
<body>
<div id="wrapper">
        <?include("adminMenu.php");?>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins ">
                    <div class="ibox-title">
                        <h5>Completion Metrics Report <small>View completion reports selecting Learning Plan and Learning Module</small></h5>
                    </div>
                    <div class="ibox-content mainDiv">
                        <div class="row">
                            <div class="form-group form-horizontal">
                                <label class="col-lg-2 control-label">Learning Plan</label>
                                <div class="col-lg-3">
                                    <select class="form-control" id="learningPlanComboBox" name="learningPlanComboBox"></select>
                                </div>
                                <label class="col-lg-2 control-label">Learning Module</label>
                                <div class="col-lg-3">
                                    <select class="form-control" id="moduleComboBox" name="moduleComboBox"></select>
                                </div>
                                    <input class="btn btn-primary" style="margin-left:10px;" type="button" value="Show Report" id="showReportButton" />
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                        <h3 class="panel-title">Attempts Information</h3>
                                  </div>
                                  <div class="panel-body">
                                        <div class="chartDiv" id="attemptedNotAttempted"></div>
                                        <ul class="list-group" style="display:none;">
                                          <li class="list-group-item badge-primary">
                                            <span class="badge totalRequestsCount"></span>
                                            Total Requests
                                          </li>
                                          <li class="list-group-item">
                                            <span class="badge totalAttemptedCount"></span>
                                            Attempted
                                          </li>
                                          <li class="list-group-item">
                                            <span class="badge totalUnattemptedCount"></span>
                                            Not Attempted
                                          </li>
                                        </ul>
                                  </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                        <h3 class="panel-title">Completion Information</h3>
                                  </div>
                                  <div class="panel-body">
                                        <div class="chartDiv" id="completedNotCompleted"></div>
                                        <ul class="list-group" style="display:none;">
                                          <li class="badge-primary list-group-item">
                                            <span class="badge totalRequestsCount"></span>
                                            Total Requests
                                          </li>
                                          <li class="list-group-item">
                                            <span class="badge totalCompletedCount"></span>
                                            Completed
                                          </li>
                                          <li class="list-group-item">
                                            <span class="badge totalUncompletedCount"></span>
                                            Not Completed
                                          </li>
                                        </ul>
                                  </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                        <h3 class="panel-title">Base Information</h3>
                                  </div>
                                  <div class="panel-body">
                                        <div class="chartDiv" id="completedNotCompletedNotAttempted"></div>
                                        <ul class="list-group" style="display:none;">
                                          <li class="list-group-item badge-primary">
                                            <span class="badge totalRequestsCount"></span>
                                            Total Requests
                                          </li>
                                          <li class="list-group-item">
                                            <span class="badge totalCompletedCount"></span>
                                            Completed
                                          </li>
                                          <li class="list-group-item">
                                            <span class="badge totalUncompletedCount"></span>
                                            Not Completed
                                          </li>
                                          <li class="list-group-item">
                                            <span class="badge totalUnattemptedCount"></span>
                                            Not Attempted
                                          </li>
                                        </ul>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
</body>
</html>
