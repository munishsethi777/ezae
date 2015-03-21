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
<script type="text/javascript" src="jqwidgets/jqxgrid.edit.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.sort.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.selection.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.pager.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.filter.js"></script>
<script type="text/javascript" src="jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="jqwidgets/jqxcombobox.js"></script>
<script type="text/javascript" src="jqwidgets/jqxdraw.js"></script>
<script type="text/javascript" src="jqwidgets/jqxchart.core.js"></script>
<script type="text/javascript" src="jqwidgets/jqxnumberinput.js"></script>
<script type="text/javascript" src="jqwidgets/jqxinput.js"></script>
<script type="text/javascript" src="jqwidgets/jqxcheckbox.js"></script>
<script type="text/javascript" src="jqwidgets/jqxcheckbox.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.columnsresize.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.columnsreorder.js"></script>

<link href="styles/plugins/iCheck/custom.css" rel="stylesheet">
<link href="styles/plugins/steps/jquery.steps.css" rel="stylesheet">
<!-- Steps -->
<script src="scripts/plugins/staps/jquery.steps.min.js"></script>

<!-- Jquery Validate -->
<script src="scripts/plugins/validate/jquery.validate.min.js"></script>
<!-- iCheck -->
<script src="scripts/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
        $(document).ready(function (){
            var url = 'ajaxAdminMgr.php?call=getLearnersForGrid';
            $.getJSON(url, function(data){
                loadGrid(data);

                //loadColsList(data.columns);
            });
            loadFormFields();
        });
        function loadFormFields(){
            var url = 'ajaxAdminMgr.php?call=getLearnersCustomFieldForm';
            $.get(url, function(data){
                $("#formFieldsDiv").html(data);
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green'
                });
            });


        }
        function loadGrid(data){
            var columns = Array();
            var rows = Array();
            var dataFields = Array();
            if(data != null){
                columns = $.parseJSON(data.columns);
                rows = $.parseJSON(data.data);
                dataFields = $.parseJSON(data.datafields);
            }

            var source =
            {
                datatype: "json",
                id: 'id',
                pagesize: 10,
                localData: rows,
                datafields: dataFields
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            // initialize jqxGrid
            $("#learnersGrid").jqxGrid(
            {
                width: '100%',
                height: 400,
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
                columnsreorder: true,
                selectionmode: 'checkbox',
                showstatusbar: true,
                renderstatusbar: function (statusbar) {
                    // appends buttons to the status bar.
                    var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
                    var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Add</span></div>");
                    var deleteButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
                    var exportButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-file-excel-o'></i><span style='margin-left: 4px; position: relative;'>Export</span></div>");
                    var editButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
                    var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");

                    container.append(addButton);
                    container.append(editButton);
                    container.append(deleteButton);
                    container.append(exportButton);
                    container.append(reloadButton);
                    statusbar.append(container);
                    addButton.jqxButton({  width: 65, height: 18 });
                    deleteButton.jqxButton({  width: 65, height: 18 });
                    editButton.jqxButton({  width: 65, height: 18 });
                    exportButton.jqxButton({  width: 65, height: 18 });
                    reloadButton.jqxButton({  width: 70, height: 18 });
                    // create new row.
                    addButton.click(function (event) {
                        $("#msgDiv").hide();
                        $("#errorDiv").hide();
                        $("#customFieldForm")[0].reset();
                        $('#createNewModalForm').modal('show');
                    });
                    // delete selected row.
                    deleteButton.click(function (event) {
                        var selectedrowindex = $("#learnersGrid").jqxGrid('getselectedrowindex');
                        var rowscount = $("#learnersGrid").jqxGrid('getdatainformation').rowscount;
                        var id = $("#learnersGrid").jqxGrid('getrowid', selectedrowindex);
                        $("#learnersGrid").jqxGrid('deleterow', id);
                    });
                    // edit grid data.
                    editButton.click(function (event) {
                        $("#msgDiv").hide();
                        $("#errorDiv").hide();
                        var selectedrowindex = $("#learnersGrid").jqxGrid('getselectedrowindex');
                        var row = $('#learnersGrid').jqxGrid('getrowdata', selectedrowindex);
                        $("#id").val(row.id);
                        $.each(columns, function (key, value){
                            $("#"+value.datafield).val(row[value.datafield]);
                            if(value.type == "boolean" && row[value.datafield] == true){
                                $('#'+value.datafield).iCheck('check');
                            }
                        });

                        $('#createNewModalForm').modal('show');
                    });
                    // reload grid data.
                    reloadButton.click(function (event) {
                        $("#learnersGrid").jqxGrid({ source: dataAdapter });
                    });

                }
            });

        }
</script>
</head>
<body class='default'>
<div class="wrapper wrapper-content animated fadeInRight">
    <?include("adminMenu.php");?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Manage learners</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a>Learners</a>
                </li>
                <li class="active">
                    <strong>Manage Learners</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Manage Learners</h5>
                    </div>
                    <div class="ibox-content">
                        <div id="learnersGrid"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="createNewModalForm" class="modal fade" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Create/Edit Learner</h4>
                </div>
                <div class="modal-body">
                    <div class="row" >
                        <div class="col-sm-12">
                            <form role="form" id="customFieldForm" class="form-horizontal">
                                <input type="hidden" id="id" name="id" value="0">
                                <div id="msgDiv" class="alert alert-success alert-dismissable" style="display:none;"></div>
                                <div id="errorDiv" class="alert alert-danger alert-dismissable" style="display:none;"></div>
                                <div id="formFieldsDiv"></div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" id="saveButton" type="button"><strong>Save</strong></button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
