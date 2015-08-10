<?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php"?>

    <script type="text/javascript">

        $(document).ready(function (){
            loadCombo();
            $('#showReportButton').jqxButton({ width: 100, height: 25, theme:'arctic' });
            $("#showReportButton").click(function () {
                $(".list-group").fadeOut();
                var item = $("#combobox").jqxComboBox('getSelectedItem');
                var moduleSeq = item.value;
                var moduleLabel = item.label;
                loadPie(moduleSeq,moduleLabel,"attemptedNotAttempted");
                loadPie(moduleSeq,moduleLabel,"completedNotCompleted");
                loadPie(moduleSeq,moduleLabel,"completedNotCompletedNotAttempted");
                loadTablesStats(moduleSeq);
            });
        });
        function loadCombo(){
            var source =
            {
                datatype: "json",
                datafields: [
                { name: 'id'},
                { name: 'title'}
                ],
                url: 'Actions/ModuleAction.php?call=getModulesForGrid',
                async: false
            };

            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#combobox").jqxComboBox(
            {
                source: dataAdapter,
                width: '300',
                height: 25,
                selectedIndex: 0,
                displayMember: 'title',
                valueMember: 'id',
                theme: 'arctic'
            });
        }

        function loadPie(moduleSeq,moduleLabel,mode){
             // prepare chart data as an array
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'Status' },
                    { name: 'Share' }
                ],
                url: 'Actions/ActivityAction.php?call=getModuleCompletionData&moduleSeq='+ moduleSeq +'&mode='+mode
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
                colorScheme: 'scheme06',
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

        function loadTablesStats(moduleSeq){
            var url = 'Actions/ActivityAction.php?call=getModuleCompletionData&moduleSeq='+ moduleSeq +'&mode=getOverAllInfo';
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
            height:100%;
            width:100%;
        }
    </style>
</head>
<body class='default'>
<div id="wrapper">
        <?include("adminMenu.php");?>
        <div style="float:left;margin-top:5px;margin-right:6px;">Select Module : </div>
        <div style="float:left" id="combobox"></div>
        <input style="margin-left:10px;" type="button" value="Show Report" id="showReportButton" />

        <hr>

        <div class="col-sm-12" style="height:300px;">
            <div class="col-sm-4">
                <div class="panel panel-default">
                  <div class="panel-heading">
                        <h3 class="panel-title">Attempts Information</h3>
                  </div>
                  <div class="panel-body">
                        <div class="chartDiv" id="attemptedNotAttempted"></div>
                        <ul class="list-group" style="display:none;">
                          <li class="list-group-item active">
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
                          <li class="list-group-item active">
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
                          <li class="list-group-item active">
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
</body>
</html>
