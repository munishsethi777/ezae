<?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php"?>

    <script type="text/javascript">

        $(document).ready(function (){

            loadLearningPlansCombo();
            //loadModulesCombo();
            loadCustomFieldsCombo();
            //$('#showReportButton').jqxButton({ width: 100, height: 25, theme:'arctic' });
            $("#showReportButton").click(function () {
                var learningPlanSeq = $("#learningPlanComboBox").val();
                var moduleSeq = $("#trainingsCombo").val();
                var fieldName = $("#customFieldCombo").val();
                var criteria = $("#criteriaCombo").val();
                var moduleLabel = $("#trainingsCombo").text();
                loadGraphChart(learningPlanSeq,moduleSeq,moduleLabel,fieldName,criteria);
            });

            //$("#jpegButton").jqxButton({theme:'arctic', width:200});
            //$("#pngButton").jqxButton({theme:'arctic', width:200});
            $("#jpegButton").click(function () {
                $('#chartContainer').jqxChart('saveAsJPEG', 'MyChart.jpeg','save-file.php');
            });
            $("#pngButton").click(function () {
                $('#chartContainer').jqxChart('saveAsPNG', 'MyChart.png','save-file.php');
            });
        });
        //loading modules, extrafields, performance criterion
        function loadCustomFieldsCombo(){
            var url = 'Actions/ActivityAction.php?call=getCustomFieldsJson';
            $.getJSON(url, function(data){
                var options = "";
                $.each(data, function(index , value){
                      options += "<option value='" + value.datafield + "'>" + value.text + "</option>";
                });
                $("#customFieldCombo").html(options);
            });
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
                $("#trainingsCombo").html(options);
            });
        }



        function loadGraphChart(learningPlanSeq,moduleSeq,moduleLabel,fieldName,criteria){
             // prepare chart data
            var hitUrl =  'Actions/ActivityAction.php?call=getModuleComparativeData&moduleSeq='+moduleSeq;
            hitUrl += '&learningPlanSeq=' + learningPlanSeq;
            hitUrl += '&fieldName=' + fieldName;
            hitUrl += '&criteria=' + criteria;
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'fieldname' },
                    { name: 'score' }
                ],
                url: hitUrl
            };
            var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error);} });

            // prepare jqxChart settings
            var settings = {
                title: "",
                description: "",
                enableAnimations: true,
                padding: { left: 20, top: 5, right: 20, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: dataAdapter,
                xAxis:
                    {
                        dataField: 'fieldname',
                        flip: false,
                        textRotationAngle: 90,
                    },
                colorScheme: 'scheme20',
                seriesGroups:
                    [
                        {
                            type: 'column',
                            orientation: 'vertical',
                            valueAxis:
                            {
                                flip: false,
                                description: 'Score',

                            },
                            series: [
                                    { dataField: 'score', displayText: 'Criteria Value' }
                                ]
                        }
                    ]
            };
            // setup the chart
            $('#chartContainer').jqxChart(settings);

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
                        <h5>Comparative Metrics Report <small>View comparative reports selecting Learning Plan and Learning Module</small></h5>
                    </div>
                    <div class="ibox-content mainDiv">
                        <div class="row">
                            <div class="form-group">

                                <div class="col-lg-3">
                                    <label class="control-label">Learning Plan</label><br>
                                    <select class="form-control" id="learningPlanComboBox" name="learningPlanComboBox"></select>
                                </div>


                                <div class="col-lg-3">
                                    <label class="control-label">Module</label><br>
                                    <select class="form-control" id="trainingsCombo" name="trainingsCombo"></select>
                                </div>


                                <div class="col-lg-2">
                                    <label class="control-label">Field</label><br>
                                    <select class="form-control" id="customFieldCombo" name="customFieldCombo"></select>
                                </div>

                                <div class="col-lg-2">
                                    <label class="control-label">Criteria</label><br>
                                    <select class="form-control" id="criteriaCombo" name="criteriaCombo">
                                        <option value = "average">Average</option>
                                        <option value = "median">Median</option>
                                        <option value = "mode">Mode</option>
                                        <option value = "range">Range</option>
                                        <option value = "passPercent">Pass Percentage</option>
                                        <option value = "completePercent">Complete Percentage</option>
                                    </select>
                                </div>
                                <input class="btn btn-primary" style="margin:20px;" type="button" value="Show Report" id="showReportButton" />
                            </div>
                        </div>
                        <div class="row">
                            <div id='chartContainer' style="width:100%;margin-bottom:10px; height: 500px;float:left"></div>
                            <input style='float: left;' class="btn-sm btn-primary"id="jpegButton" type="button" value="Save As JPEG" />
                            <input style='float: left; margin-left: 5px;' class="btn-sm btn-primary" id="pngButton" type="button" value="Save As PNG" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</body>
</html>
