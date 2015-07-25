<?include("sessioncheck.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration - Eazy Assessment Engine</title>
<?include("ScriptsInclude.php");?>
<script type="text/javascript">

        $(document).ready(function (){
            loadCombo();
            $('#showReportButton').jqxButton({ width: 100, height: 25, theme:'arctic' });
            $("#showReportButton").click(function () {
                var item = $("#combobox").jqxComboBox('getSelectedItem');
                var moduleSeq = item.value;
                var moduleLabel = item.label;
                loadPie(moduleSeq,moduleLabel);
                loadGraphChart(moduleSeq,moduleLabel);
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
                url: 'ajaxAdminMgr.php?call=getModulesJson',
                async: false
            };

            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#combobox").jqxComboBox(
            {
                source: dataAdapter,
                width: 250,
                height: 25,
                selectedIndex: 0,
                displayMember: 'title',
                valueMember: 'id',
                theme: 'arctic'
            });
        }

        function loadPie(moduleSeq,moduleLabel){
             // prepare chart data as an array
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'Status' },
                    { name: 'Share' }
                ],
                url: 'ajaxAdminMgr.php?call=getModuleCompletionData&moduleSeq='+moduleSeq
            };
            var dataAdapter = new $.jqx.dataAdapter(source, {
                async: false,
                autoBind: true,
                loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
            // prepare jqxChart settings
            var settings = {
                title: "Completion /Coverage Metrics",
                description: moduleLabel,
                enableAnimations: true,
                showLegend: true,
                showBorderLine: true,
                //legendLayout: { left: 700, top: 160, width: 300, height: 200, flow: 'vertical' },
                padding: { left: 5, top: 5, right: 5, bottom: 5 },
                titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
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
                                        labelRadius: 170,
                                        initialAngle: 15,
                                        radius: 145,
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
            $('#pieContainer').jqxChart(settings);
        }

        function loadGraphChart(moduleSeq,moduleLabel){
             // prepare chart data
            var sampleData = [
                { Score: '0%-45%', Participants: 100},
                { Score: '45%-65%', Participants: 200},
                { Score: '65%-85%', Participants: 140},
                { Score: '>85%', Participants: 180}];
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'Score' },
                    { name: 'Participants' }
                ],
                url: 'ajaxAdminMgr.php?call=getModulePerformanceData&moduleSeq='+moduleSeq
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
                colorScheme: 'scheme06',
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
                                unitInterval: 100,
                                maxValue: 800,
                                //displayValueAxis: true,
                                description: '',
                                //formatFunction: function (value) {
                                    //return parseInt(value / 1000000);
                                //}
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
</script>
</head>


<body class='default'>

<div id="wrapper">
        <?include("adminMenu.php");?>
        <div class="row  border-bottom white-bg dashboard-header">
            <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">
                <div style="float:left;margin-top:5px;margin-right:6px;">Select Module : </div>
                <div style="float:left" id="combobox"></div>
                <input style="margin-left:10px;" type="button" value="Show Report" id="showReportButton" />
                <hr>
                <div id='pieContainer' style="margin-top:40px;width: 500px; height: 500px;float:left"></div>
                <div id='chartContainer' style="margin-top:40px;width: 500px; height: 500px;float:left"></div>
            </div>
        </div>
</div>
</body>
</html>
