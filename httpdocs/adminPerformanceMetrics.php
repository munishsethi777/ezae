<?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php"?>
    <script type="text/javascript">
        var isloaded = false;
        $(document).ready(function (){
            loadPercentages();
            loadLearningPlansCombo();
            $("#showReportButton").click(function () {
                 populatePie();
            });
        });
        function populatePie(){
            var learningPlanSeq = $("#learningPlanComboBox").val();
            var moduleSeq = $("#moduleComboBox").val();
            var moduleLabel = $("#moduleComboBox").text();
            var passPercent = $("#percentages").jqxComboBox('getSelectedItem');
            loadGraphChart(learningPlanSeq,moduleSeq,moduleLabel);
            loadPassPie(learningPlanSeq,moduleSeq, moduleLabel, passPercent.value);
            loadPerformanceTablesStats(learningPlanSeq,moduleSeq);
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


        function loadPercentages(){
            var source = [
                {value: "20", label: "20"},
                {value: "30", label: "30"},
                {value: "40", label: "40"},
                {value: "50", label: "50"},
                {value: "60", label: "60"},
                {value: "70", label: "70"},
                {value: "80", label: "80"},
                {value: "90", label: "90"},
            ];
            // Create a jqxComboBox
            $("#percentages").jqxComboBox({ source: source, width: '70px', height: '20px',selectedIndex: 4, })
            $('#percentages').on('change', function (event)
            {
                var args = event.args;
                if (args) {
                    var value = args.item.value;
                    var module = $("#combobox").jqxComboBox('getSelectedItem');

                    loadPassPie(module.value, module.label, value);

                }
            });

        }

        function loadGraphChart(learningPlanSeq,moduleSeq,moduleLabel){

            var source = {
                datatype: "json",
                datafields: [
                    { name: 'Score' },
                    { name: 'Participants' }
                ],
                url: 'Actions/ActivityAction.php?call=getModulePerformanceData&moduleSeq='+moduleSeq +'&learningPlanSeq='+learningPlanSeq
            };
            var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error);} });
            // prepare jqxChart settings
            var settings = {
                title: "Performance Metrics",
                description: moduleLabel,
                showLegend: true,
                enableAnimations: true,
                padding: { left: 20, top: 5, right: 20, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: dataAdapter,
                xAxis:
                    {
                        dataField: 'Score',
                        showGridLines: true,
                        flip: false
                    },
                colorScheme: 'scheme20',
                seriesGroups:
                    [
                        {
                            type: 'column',
                            orientation: 'horizontal',
                            columnsGapPercent: 100,
                            toolTipFormatSettings: { thousandsSeparator: ',' },
                            valueAxis:
                            {
                                flip: true,
                                unitInterval: 10,
                                description: '',
                            },
                            series: [
                                    { dataField: 'Participants', displayText: 'Number of Participants' }
                                ]
                        }
                    ]
            };
            // setup the chart
            $('#chartContainer').jqxChart(settings);
        }

        function loadPassPie(learningPlanSeq,moduleSeq,moduleLabel,percent){
             // prepare chart data as an array
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'Status' },
                    { name: 'Share' }
                ],
                url: 'Actions/ActivityAction.php?call=getModulePassPercentageChartData&moduleSeq='+ moduleSeq +'&percentage='+ percent +'&learningPlanSeq='+learningPlanSeq
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
                legendLayout : { left: 400, top: 0, width: 200, height: 100, flow: 'vertical' },
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

            $('#passPercentageChartDiv').jqxChart(settings);
        }

        function loadPerformanceTablesStats(learningPlanSeq,moduleSeq){
            var url = 'Actions/ActivityAction.php?call=getModuleMeanMediamModePercent&moduleSeq='+ moduleSeq +'&learningPlanSeq='+learningPlanSeq;
            $.getJSON(url, function(data){
                $(".meanCount").html(data.mean);
                $(".medianCount").html(data.median);
                $(".modeCount").html(data.mode);
            });
        }
    </script>
</head>
<body class='default'>
<div id="wrapper">
        <?include("adminMenu.php");?>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins ">
                    <div class="ibox-title">
                        <h5>Performance Metrics Report <small>View performance reports selecting Learning Plan and Learning Module</small></h5>
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
                            <div class="col-sm-8" style="height:600px">
                                <div id='chartContainer' style="width:100%;height:100%"></div>
                            </div>

                            <div class="col-sm-4" style="height:600px">
                                <div class="panel panel-default" style="height:60%">
                                    <div class="panel-heading badge-primary">
                                        <h3 class="panel-title" style="float: left;margin-right:60px">Pass Chart</h3>
                                        <div>
                                            <div id="percentages" style="margin-left:6px;float:right"></div>
                                        </div>
                                        <div style="clear:both"></div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="chartDiv" style="width:100%;height:83%" id="passPercentageChartDiv"></div>

                                    </div>
                                 </div>


                                <div class="panel panel-default">
                                    <div class="panel-heading badge-primary">
                                        <h3 class="panel-title">Performance Information of Selected Module <span class="moduleName"></span></h3>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="list-group">
                                          <li class="list-group-item">
                                            <span class="badge meanCount"></span>Mean
                                          </li>
                                          <li class="list-group-item">
                                            <span class="badge medianCount"></span>Median
                                          </li>
                                          <li class="list-group-item">
                                            <span class="badge modeCount"></span>Mode
                                          </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

</div>
</body>
</html>
