<?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php"?>
<script type="text/javascript">
    $(document).ready(function(){
        var url = 'Actions/CustomFieldAction.php?call=getCustomFields';
                $.getJSON(url, function(data){
                loadGrid(data);
        });
        $('#customFieldForm').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            rules: [
               { input: '#fieldName', message: 'Field Name is required!', action: 'keyup, blur', rule: 'required' }
               ]
        });

        $("#saveButton").click(function () {
             $("#errorDiv").hide();
             $("#msgDiv").hide();
            var validationResult = function (isValid) {
                if (isValid) {
                    submitCreate();
                }
            }
            $('#customFieldForm').jqxValidator('validate', validationResult);
        });
        $("#customFieldForm").on('validationSuccess', function () {
            $("#createCompanyForm-iframe").fadeIn('fast');
        });
    })
    function submitCreate(){
        $formData = $("#customFieldForm").serializeArray();
            $.get( "Actions/CustomFieldAction.php?call=saveCustomField", $formData,function( data ){
                if(data != ""){
                   var obj = $.parseJSON(data);
                   var statusDiv = '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>';
                   statusDiv += obj.message;
                   if(obj.success == 1){
                       $("#msgDiv").show();
                       $("#msgDiv").html(statusDiv)
                       $('#customFieldForm')[0].reset();
                       var dataRow = $.parseJSON(obj.row);
                       var id = $("#id").val();
                       if(id != "0"){
                           var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                           $("#jqxgrid").jqxGrid('updaterow', id, dataRow);
                       }else{
                         $("#jqxgrid").jqxGrid('addrow', null, dataRow);
                       }

                   }else{
                       $("#errorDiv").show();
                       $("#errorDiv").html(statusDiv)
                   }
                }
        });
    }
    function loadGrid(data){
        var columns = [
          { text: 'id', datafield: 'id' , hidden:true},
          { text: 'Field Name' , datafield: 'name', width: 250 },
          { text: 'Field Type', datafield: 'type' },
          { text: 'Required', datafield: 'required', columntype: 'checkbox'}
        ]
        var rows = Array();
        var dataFields = Array();
        if(data != null){
            rows = $.parseJSON(data.data);
        }
        var source =
        {
            datatype: "json",
            id: 'id',
            pagesize: 20,
            localData: rows,
            datafields: [
                { name: 'id', type: 'integer' },
                { name: 'name', type: 'string' },
                { name: 'type', type: 'string' },
                { name: 'required', type: 'bool' }
            ],
            addrow: function (rowid, rowdata, position, commit) {
                commit(true);
            },
            deleterow: function (rowid, commit) {
                commit(true);
            },
            updaterow: function (rowid, newdata, commit) {
                commit(true);
            }
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
            columnsreorder: true,
            selectionmode: 'checkbox',
            showstatusbar: true,
            renderstatusbar: function (statusbar) {
                var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
                var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>    Add</span></div>");
                var deleteButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
                var editButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
                var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");

                container.append(addButton);
                container.append(editButton);
                container.append(deleteButton);
                container.append(reloadButton);
                statusbar.append(container);
                addButton.jqxButton({  width: 65, height: 18 });
                deleteButton.jqxButton({  width: 70, height: 18 });
                editButton.jqxButton({  width: 65, height: 18 });
                reloadButton.jqxButton({  width: 70, height: 18 });

                // create new row.
                addButton.click(function (event) {
                    $("#msgDiv").hide();
                    $("#errorDiv").hide();
                    $("#customFieldForm")[0].reset();
                    $('#createNewModalForm').modal('show');
                });
                // update row.
                editButton.click(function (event) {
                    $("#msgDiv").hide();
                    $("#errorDiv").hide();
                    var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                    var row = $('#jqxgrid').jqxGrid('getrowdata', selectedrowindex);
                    $("#id").val(row.id);
                    $("#fieldName").val(row.name);
                    $('#fieldType').val(row.type).attr("selected", "selected");
                    $('#isRequired').attr('checked', row.required);
                    $('#createNewModalForm').modal('show');
                });
                // delete row.
                deleteButton.click(function (event) {
                     deleteRows();
                });
                // reload grid data.
                reloadButton.click(function (event) {
                    $("#jqxgrid").jqxGrid({ source: dataAdapter });
                });
            }
        });
    }
    function deleteRows(){
        var selectedRowIndexes = $("#jqxgrid").jqxGrid('selectedrowindexes');
        if(selectedRowIndexes.length > 0){
            bootbox.confirm("Are you sure you want to delete selected row(s)?", function(result) {
                if(result){
                    var ids = [];
                    $.each(selectedRowIndexes, function(index , value){
                        var dataRow = $("#jqxgrid").jqxGrid('getrowdata', value);
                        ids.push(dataRow.id);
                    });
                    $.get( "Actions/CustomFieldAction.php?call=deleteCustomfield&ids=" + ids,function( data ){
                        if(data != ""){
                            var obj = $.parseJSON(data);
                            var message = obj.message;
                            if(obj.success == 1){
                                toastr.success(message,'Success');
                                $.each(selectedRowIndexes, function(index , value){
                                    var id = $("#jqxgrid").jqxGrid('getrowid', value);
                                    var commit = $("#jqxgrid").jqxGrid('deleterow', id);
                                });
                            }else{
                                toastr.error(message,'Failed');
                            }
                        }
                    });
                }
            });
        }else{
             bootbox.alert("No row selected.Please select row to delete!", function() {});
        }

    }
</script>
</head>
<body class='default'>
    <div id="wrapper">
        <?include("adminMenu.php");?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Manage Learner's Profiles</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a>Learners</a>
                    </li>
                    <li class="active">
                        <strong>Manage Learner's Profile</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="adminSingup animated fadeInRight" >
        <div class="row">
            <div class="col-lg-12" >
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Manage Learner's Profiles</h5>
                    </div>
                    <div class="ibox-content">
                        <div  id="jqxgrid"></div>
                        <div id="createNewModalForm" class="modal fade" aria-hidden="true">
                            <div class="modal-dialog" >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Create/Edit Custom Fields</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row" >
                                            <div class="col-sm-12">
                                                <form role="form" id="customFieldForm" class="form-horizontal">
                                                    <input type="hidden" id="id" name="id" value="0">
                                                    <div id="msgDiv" class="alert alert-success alert-dismissable" style="display:none;"></div>
                                                    <div id="errorDiv" class="alert alert-danger alert-dismissable" style="display:none;"></div>
                                                    <div class="form-group">
                                                        <label>Field Name</label>
                                                        <input type="text" id="fieldName" name="fieldName" placeholder="Field Name" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Field Type</label>
                                                        <select id="fieldType" name="fieldType" class="form-control">
                                                        <option value="string">Text</option>
                                                        <option value="date">Date</option>
                                                        <option value="numeric">Numeric</option>
                                                        <option value="boolean">Yes/No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label> <input name="isRequired" id="isRequired" type="checkbox" class="i-checks"> Required </label>
                                                    </div>
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
                </div>
            </div>
        </div>
    </div>
</body>
</html>
