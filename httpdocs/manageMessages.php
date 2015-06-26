<?include("sessioncheck.php");?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration - Easy Assessment Engine</title>
 <?include "ScriptsInclude.php"?>

<script type="text/javascript">
        var mathingRule = "";

        $(document).ready(function (){
            var url = 'ajaxAdminMgr.php?call=getLearnersForGrid';
            $.getJSON(url, function(data){
                loadGrid(data);
            })
        });


        function loadGrid(data){
            var columns = [
              { text: 'id', datafield: 'id' , hidden:true},
              { text: 'Message Subject' , datafield: 'messageSubject', width: 250 },
              { text: 'Dated', datafield: 'dated' },
              { text: 'Condition', datafield: 'condition' },
              { text: 'Status', datafield: 'status'},
              { text: 'Learning Plans', datafield: 'learningplans'}
            ]
            var rows = Array();
            var dataFields = Array();
            if(data != null){
                //columns = $.parseJSON(data.columns);
                //rows = $.parseJSON(data.data);
                //dataFields = $.parseJSON(data.datafields);
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
            $("#messagesGrid").jqxGrid(
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
                        $("#saveNewBtnDiv").show();
                        $("#msgDiv").hide();
                        $("#errorDiv").hide();
                        $("#id").val("0");
                        $("#customFieldForm")[0].reset();
                        $('#changePasswordChkDiv').hide();
                        $("#passwordDiv").show();
                        $('#createNewModalForm').modal('show');
                    });
                    // delete selected row.
                    deleteButton.click(function (event) {
                        deleteRows("learnersGrid","Actions/LearnerAction.php?call=deleteLearners");
                    });
                    // edit grid data.
                    editButton.click(function (event) {
                        $("#saveNewBtnDiv").hide();
                        $("#msgDiv").hide();
                        $("#errorDiv").hide();
                        $("#customFieldForm")[0].reset();
                        var selectedrowindex = $("#learnersGrid").jqxGrid('selectedrowindexes');
                        if(selectedrowindex.length != 1){
                             bootbox.alert("Please Select single row for edit.", function() {});
                             return;
                        }
                        var row = $('#learnersGrid').jqxGrid('getrowdata', selectedrowindex);
                        $("#id").val(row.id);
                        $.each(columns, function (key, value){
                            $("#"+value.datafield).val(row[value.datafield]);
                            if(value.type == "boolean" && row[value.datafield] == true){
                                $('#'+value.datafield).iCheck('check');
                            }
                        });
                        $('#changePasswordChkDiv').show();
                        $("#passwordDiv").hide();
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
            <h2>Manage Communication Messages </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a>Messages</a>
                </li>
                <li class="active">
                    <strong>Manage Messages</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">

                    <div class="ibox-content">
                        <div id="messagesGrid"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>