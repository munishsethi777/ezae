<?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php"?>

    <script type="text/javascript">

        $(document).ready(function (){
            
            loadLearningPlansCombo();
            //loadModulesCombo();
            loadCustomFieldsCombo();
            loadPerformanceCriterias();
            $('#showReportButton').jqxButton({ width: 100, height: 25, theme:'arctic' });
            $("#showReportButton").click(function () {
                var lpSelectedItem = $("#learningPlanComboBox").jqxComboBox('getSelectedItem');
                var learningPlanSeq = lpSelectedItem.value;

                var moduleSelectedItem = $("#trainingsCombo").jqxComboBox('getSelectedItem');
                var moduleSeq = moduleSelectedItem.value;

                var fieldSelectedItem = $("#customFieldCombo").jqxComboBox('getSelectedItem');
                var fieldName = fieldSelectedItem.value;

                var criteriaSelectedItem = $("#criteriaCombo").jqxComboBox('getSelectedItem');
                var criteria = criteriaSelectedItem.value;

                var moduleLabel = moduleSelectedItem.label;
                //loadPie(moduleSeq,moduleLabel);
                loadGraphChart(learningPlanSeq,moduleSeq,moduleLabel,fieldName,criteria);
            });

            $("#jpegButton").jqxButton({theme:'arctic', width:200});
            $("#pngButton").jqxButton({theme:'arctic', width:200});
            $("#jpegButton").click(function () {
                $('#chartContainer').jqxChart('saveAsJPEG', 'MyChart.jpeg','save-file.php');
            });
            $("#pngButton").click(function () {
                $('#chartContainer').jqxChart('saveAsPNG', 'MyChart.png','save-file.php');
            });
        });
        //loading modules, extrafields, performance criterion
        function loadCustomFieldsCombo(){
             var source =
            {
                datatype: "json",
                datafields: [
                { name: 'datafield'},
                { name: 'text'}
                ],
                url: 'Actions/ActivityAction.php?call=getCustomFieldsJson',
                async: false
            };

            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#customFieldCombo").jqxComboBox(
            {
                source: dataAdapter,
                width: 200,
                height: 25,
                selectedIndex: 0,
                displayMember: 'text',
                valueMember: 'datafield',
                theme: 'arctic'
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
                url: 'Actions/LearningPlanAction.php?call=getLearnerPlansForReporting',
                async: true
            };

            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#learningPlanComboBox").jqxComboBox({
                source: dataAdapter,
                width: '180',
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
                   loadModulesCombo(item.value);
                }
            });

        }
        function loadModulesCombo(learningPlanSeq){
            var source1 =
            {
                datatype: "json",
                datafields: [
                { name: 'id'},
                { name: 'title'}
                ],
                url: 'Actions/ModuleAction.php?call=getModulesByLearningPlanForReporting&learningPlanSeq='+learningPlanSeq,
                async: true
            };

            var dataAdapter1 = new $.jqx.dataAdapter(source1);

            $("#trainingsCombo").jqxComboBox({
                source: dataAdapter1,
                width: '180',
                height: 25,
                selectedIndex: 0,
                displayMember: 'title',
                valueMember: 'id',
                theme: 'arctic'
            });
        }


        function loadPerformanceCriterias(){
            var criterias =
                [
                    {"name":"average","Label":"Average"},
                    {"name":"median","Label":"Median"},
                    {"name":"mode","Label":"Mode"},
                    {"name":"range","Label":"Range"},
                    {"name":"passPercent","Label":"Pass Percentage"},
                    {"name":"completePercent","Label":"Complete Percentage"}
                ];
            var source =
                {
                    datatype: "json",
                    datafields: [
                        { name: 'name' },
                        { name: 'Label' }
                    ],
                    localdata: criterias,
                    async: false
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                $("#criteriaCombo").jqxComboBox({ selectedIndex: 0, source: dataAdapter,
                    displayMember: "Label", valueMember: "name", width: 170, height: 25});
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
        <div style="float:left;margin-top:5px;margin-right:6px;">LearningPlan</div>
        <div style="float:left" id="learningPlanComboBox"></div>
        <div style="float:left;margin-top:5px;margin-right:6px;">Module</div>
        <div style="float:left" id="trainingsCombo"></div>
        <div style="float:left;margin-top:5px;margin:6px;">Select Field : </div>
        <div style="float:left" id="customFieldCombo"></div>
        <div style="float:left;margin-top:5px;margin:6px;">Select Criteria : </div>
        <div style="float:left" id="criteriaCombo"></div>
        <input style="margin-left:10px;" type="button" value="Show Report" id="showReportButton" />


        <hr>
        <div id='chartContainer' style="margin-top:5px;width:100%;margin-bottom:10px; height: 500px;float:left"></div>
        <input style='float: left;' id="jpegButton" type="button" value="Save As JPEG" />
        <input style='float: left; margin-left: 5px;' id="pngButton" type="button" value="Save As PNG" />
</div>
</body>
</html>
