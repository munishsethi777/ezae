<?include("sessioncheck.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration - Easy Assessment Engine</title>
<script src="scripts/jquery-2.1.1.js"></script>

<link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
<link rel="stylesheet" href="jqwidgets/styles/jqx.arctic.css" type="text/css" />
<script type="text/javascript" src="jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="jqwidgets/jqxbuttons.js"></script>
<script type="text/javascript" src="jqwidgets/jqxscrollbar.js"></script>
<script type="text/javascript" src="jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="jqwidgets/jqxdropdownlist.js"></script>
<script type="text/javascript" src="jqwidgets/jqxmenu.js"></script>
<script type="text/javascript" src="jqwidgets/jqxdata.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.sort.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.selection.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.pager.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.filter.js"></script>
<script type="text/javascript" src="jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="jqwidgets/jqxcombobox.js"></script>
<script type="text/javascript" src="jqwidgets/jqxdraw.js"></script>
<script type="text/javascript" src="jqwidgets/jqxchart.core.js"></script>
<link type="text/css" href="styles/bootstrap.css" rel="stylesheet" />

    <script type="text/javascript">

        $(document).ready(function (){
            loadModulesCombo();
            loadCustomFieldsCombo();
            loadPerformanceCriterias();
            $('#showReportButton').jqxButton({ width: 100, height: 25, theme:'arctic' });
            $("#showReportButton").click(function () {
                var moduleSelectedItem = $("#trainingsCombo").jqxComboBox('getSelectedItem');
                var moduleSeq = moduleSelectedItem.value;

                var fieldSelectedItem = $("#customFieldCombo").jqxComboBox('getSelectedItem');
                var fieldName = fieldSelectedItem.value;

                var criteriaSelectedItem = $("#criteriaCombo").jqxComboBox('getSelectedItem');
                var criteria = criteriaSelectedItem.value;

                var moduleLabel = moduleSelectedItem.label;
                //loadPie(moduleSeq,moduleLabel);
                loadGraphChart(moduleSeq,moduleLabel,fieldName,criteria);
            });

            $("#jpegButton").jqxButton({theme:'arctic', width:200});
            $("#pngButton").jqxButton({theme:'arctic', width:200});
            $("#jpegButton").click(function () {
                // call the export server to create a JPEG image
                //$('#chartContainer').jqxChart('saveAsJPEG', 'myChart.jpeg', getExportServer());
                $('#chartContainer').jqxChart('saveAsJPEG', 'MyChart.jpeg','save-file.php');
            });
            $("#pngButton").click(function () {
                // call the export server to create a PNG image
                //$('#chartContainer').jqxChart('saveAsPNG', 'myChart.png', getExportServer());
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
                url: 'ajaxAdminMgr.php?call=getCustomFieldsJson',
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
        function loadModulesCombo(){
            var source =
            {
                datatype: "json",
                datafields: [
                { name: 'id'},
                { name: 'title'}
                ],
                url: 'ajaxAdminMgr.php?call=getModulesJson',
                async: false
            };

            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#trainingsCombo").jqxComboBox(
            {
                source: dataAdapter,
                width: 300,
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

        function loadGraphChart(moduleSeq,moduleLabel,fieldName,criteria){
             // prepare chart data
            var hitUrl =  'ajaxAdminMgr.php?call=getModuleComparativeData&moduleSeq='+moduleSeq;
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
                colorScheme: 'scheme06',
                seriesGroups:
                    [
                        {
                            type: 'column',
                            orientation: 'vertical',
                            valueAxis:
                            {
                                flip: false,
                                description: '',

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
        function getExportServer() {
            return 'http://www.jqwidgets.com/export_server/export.php';
        }
    </script>
</head>
<body class='default'>
<div id="wrapper">
        <?include("adminMenu.php");?>
        <div style="float:left;margin-top:5px;margin-right:6px;">Select Module : </div>
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
