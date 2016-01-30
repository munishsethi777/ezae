<?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php"?>

<script type="text/javascript">
    var isloaded = false;
    $(document).ready(function (){
        theme = "arctic";
        loadLearningPlansCombo();
        $("#showReportButton").click(function () {
            learningModuleSeq = $("#moduleComboBox").val();
            var url = 'Actions/ActivityAction.php?call=getActivityHeadersForGrid&moduleSeq='+ learningModuleSeq;
            $.getJSON(url, function(data){
                learningPlanSeq = $("#learningPlanComboBox").val();
                loadGrid(data,learningModuleSeq,learningPlanSeq);
            });
        });
        var exportInfo;
        $("#excelExport").jqxButton({ theme: theme, width:200 });
        $("#csvExport").jqxButton({ theme: theme , width:200});
        $("#htmlExport").jqxButton({ theme: theme , width:200});
        $("#excelExport").click(function () {
             $("#jqxgrid").jqxGrid('exportdata', 'xls',jqxgrid,true,null,true,'save-file.php');
        });
        $("#csvExport").click(function () {
            $("#jqxgrid").jqxGrid('exportdata', 'csv',jqxgrid,true,null,true,'save-file.php');
        });
        $("#htmlExport").click(function () {
            $("#jqxgrid").jqxGrid('exportdata', 'html',jqxgrid,true,null,true,'save-file.php');
        });

    });
    function loadGrid(data,value,learningPlanSeq){
        var columns = Array();
        var rows = Array();
        var dataFields = Array();
        if(data != null){
            columns = $.parseJSON(data.columns);
            dataFields = $.parseJSON(data.datafields);
        }
        var source =
        {
            datatype: "json",
            id: 'id',
            pagesize: 20,
            datafields: dataFields,
            url : 'Actions/ActivityAction.php?call=getActivityDataForGrid&moduleSeq='+ value +'&lpSeq='+learningPlanSeq,
            root: 'Rows',
            cache: false,
            beforeprocessing: function(data)
            {
                source.totalrecords = data.TotalRows;
            },
            filter: function()
            {
                // update the grid and send a request to the server.
                $("#jqxgrid").jqxGrid('updatebounddata', 'filter');
            },
            sort: function()
            {
                    // update the grid and send a request to the server.
                $("#jqxgrid").jqxGrid('updatebounddata', 'sort');
            },
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#jqxgrid").jqxGrid(
        {

            width: '100%',
            source: dataAdapter,
            filterable: true,
            sortable: true,
            autoshowfiltericon: true,
            columns: columns,
            pageable: true,
            autoheight: true,
            altrows: true,
            enabletooltips: true,
            columnsresize: true,
            columnsreorder: true ,
            virtualmode: true,
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var me = this;
                    var container = $("<div style='margin: 5px;float:right'></div>");
                    var span = $("<span style='float: left; margin-top: 5px; margin-right: 4px;'>Show/Hide Columns: </span>");
                    var input = $("<div id='columnsCombo' style='float: left; '></div>");

                    toolbar.append(container);
                    container.append(span);
                    container.append(input);
                    input.addClass('columnsCombo');
                    loadColsList(data.columns);
            },
            rendergridrows: function()
            {
                  return dataAdapter.records;
            }
        });
    }

    function loadColsList(columns){
        var listSource = new Array;
        var columnsJson = $.parseJSON(columns);
        if(columnsJson != null){
            $.each(columnsJson ,function(index,value){
                listSource.push($.parseJSON('{"label":"'+ this.text +'", "value": "'+ this.datafield +'", "checked":true}'));
            });
        }

        $("#columnsCombo").jqxComboBox({ checkboxes: true, source: listSource, displayMember: "label", valueMember: "value", width: 200, height: 20});
        $("#columnsCombo").jqxComboBox('checkIndex', 0);


        $("#columnsCombo").on('checkChange', function (event) {
            $("#jqxgrid").jqxGrid('beginupdate');
            if (event.args.checked) {
                $("#jqxgrid").jqxGrid('showcolumn', event.args.value);
            }else {
                $("#jqxgrid").jqxGrid('hidecolumn', event.args.value);
            }
            $("#jqxgrid").jqxGrid('endupdate');
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
            $("#moduleComboBox").html(options);
            if(!isloaded){
                var url = 'Actions/ActivityAction.php?call=getActivityHeadersForGrid&moduleSeq='+ data[0].id;
                $.getJSON(url, function(data1){
                    learningPlanSeq = $("#learningPlanComboBox").val();
                    loadGrid(data1,data[0].id,learningPlanSeq);
                });
                isloaded = true;
            }
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
                            <div class="col-sm-12">
                                <div id="jqxgrid"></div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="button" class="col-sm-1" value="Export to Excel" id='excelExport' />
                            <input style="margin-left:8px;" type="button" class="col-sm-1" value="Export to CSV" id='csvExport' />
                            <input style="margin-left:8px;" type="button" class="col-sm-1" value="Export to HTML" id='htmlExport' />
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
</body>
</html>
