<?include("sessioncheck.php");?>
<html lang="en">
<head>
<title>EZAE - User Custom Fields</title>

<?include "ScriptsInclude.php"?>
<script type="text/javascript">
    $(document).ready(function(){
        //populateGrid();
        checkBindingCompleted();
        loadGrid();        
        $('#customFieldForm').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            rules: [
               { input: '#fieldName', message: 'Field Name is required!', action: 'keyup, blur', rule: 'required' }
               ]
        });

        $("#saveButton").click(function (e) {
            validateAndSave(e,this);
        });
        $("#saveNewBtn").click(function (e) {
            validateAndSave(e,this);
        });
        $("#customFieldForm").on('validationSuccess', function (){
            $("#createCompanyForm-iframe").fadeIn('fast');
        });
    })
    function populateGrid(){
         var url = 'Actions/CustomFieldAction.php?call=getCustomFields';
                $.getJSON(url, function(data){
                loadGrid(data);
        });
    }
    function checkBindingCompleted(){
         var url = 'Actions/CustomFieldAction.php?call=isBindingCompleted';
            $.getJSON(url, function(data){
                $("#bindingMsgDiv").html(data.message);    
           });
    }
    function validateAndSave(e,btn){
        $("#errorDiv").hide();
        $("#msgDiv").hide();
        var validationResult = function (isValid) {
            if (isValid) {
                submitCreate(e,btn);
            }
        }
        $('#customFieldForm').jqxValidator('validate', validationResult);
    }
    function submitCreate(e,btn){
         e.preventDefault();
         var l = Ladda.create(btn);
         l.start();
         $formData = $("#customFieldForm").serializeArray();
            $.get( "Actions/CustomFieldAction.php?call=saveCustomField", $formData,function( data ){
                if(data != ""){
                   var obj = $.parseJSON(data);
                   if(obj.success == 1){
                       var dataRow = $.parseJSON(obj.row);
                       var id = $("#id").val();
                       $("#jqxgrid").jqxGrid('updatebounddata');
                       l.stop();
                   }
                  if(btn.id == "saveButton"){
                     showResponseToastr(data,"createNewModalForm","customFieldForm","mainDiv");
                  }else{
                     showResponseNotification(data,"mainDiv","customFieldForm");
                  }
                  $("#jqxgrid").jqxGrid('clearselection');

                }
                checkBindingCompleted();
        });
    }
    function HandleCheckbox(value,isChecked){
        $('#usernamechk').prop('checked',(value == "username" && isChecked));
        $('#passwordchk').prop('checked',(value == "password" && isChecked));
        $('#emailchk').prop('checked',(value == "email" && isChecked));
    }
    function loadGrid(){
        var columns = [
          { text: 'id', datafield: 'id' , hidden:true},
          { text: 'mappedfield', datafield: 'mappedfield' , hidden:true},
          { text: 'name', datafield: 'name' , hidden:true},
          { text: 'Field Name' , datafield: 'title' },
          { text: 'Field Type', datafield: 'type' },
          { text: 'Modified On', datafield: 'lastmodifiedon',cellsformat: 'MM-dd-yyyy hh:mm:ss tt' }
        ]
        var rows = Array();
        var dataFields = Array();
        //if(data != null){
//            rows = $.parseJSON(data.data);
//        }
        var source =
        {
            datatype: "json",
            id: 'id',
            
            pagesize: 20,
            //localData: rows,
            datafields: [
                { name: 'id', type: 'integer' },
                { name: 'title', type: 'string' },
                { name: 'name', type: 'string' },
                { name: 'type', type: 'string' },
                { name: 'lastmodifiedon', type: 'date' },
                { name: 'mappedfield', type: 'string' },
            ],
            url: 'Actions/CustomFieldAction.php?call=getCustomFields',
            beforeprocessing: function(data)
            {        
                source.totalrecords = data.TotalRows;
            },
            filter: function()
            {
                // update the grid and send a request to the server.
                $("#jqxgrid").jqxGrid('updatebounddata', 'filter');
            },
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
            height: '75%',
            width: '100%',
            source: dataAdapter,
            filterable: true,
            sortable: true,
            autoshowfiltericon: true,
            columns: columns,
            pageable: true,
            altrows: true,
            enabletooltips: true,
            columnsresize: true,
            columnsreorder: true,
            selectionmode: 'checkbox',
            showstatusbar: true,
            virtualmode: true,
            rendergridrows: function()
            {
                  return dataAdapter.records;     
            },
            renderstatusbar: function (statusbar) {
                var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
                var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>    Add</span></div>");
                var deleteButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
                var editButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");


                container.append(addButton);
                container.append(editButton);
                container.append(deleteButton);

                statusbar.append(container);
                addButton.jqxButton({  width: 65, height: 18 });
                deleteButton.jqxButton({  width: 70, height: 18 });
                editButton.jqxButton({  width: 65, height: 18 });


                // create new row.
                addButton.click(function (event) {
                    $("#saveNewBtnDiv").show();
                    $("#msgDiv").hide();
                    $("#errorDiv").hide();
                    $("#id").val(0);
                    $("#mappedField").val("");
                    $("#customFieldForm")[0].reset();
                    $('#createNewModalForm').modal('show');
                });
                // update row.
                editButton.click(function (event) {
                    $("#saveNewBtnDiv").hide();
                    $("#msgDiv").hide();
                    $("#errorDiv").hide();
                    var selectedrowindex = $("#jqxgrid").jqxGrid('selectedrowindexes');
                    if(selectedrowindex.length != 1){
                         bootbox.alert("Please Select single row for edit.", function() {});
                         return;
                    }
                    $("#customFieldForm")[0].reset();
                    var row = $('#jqxgrid').jqxGrid('getrowdata', selectedrowindex);
                    $("#id").val(row.id);
                    $("#fieldName").val(row.name);
                    $('#fieldType').val(row.type).attr("selected", "selected");
                    isUserName = false;
                    isPassword = false;
                    isEmail = false;
                    fields = row.mappedfield.split(",");
                     $.each(fields,function(key,value) {
                        if(value == "usernamefield" ){
                            isUserName = true;    
                        }
                        if(value == "passwordfield" ){
                            isPassword = true;
                        }
                        if(value == "emailfield" ){
                            isEmail = true;
                        }
                     })
                    $('#usernamechk').attr('checked', isUserName);
                    $('#passwordchk').attr('checked', isPassword);
                    $('#emailchk').attr('checked', isEmail);
                    $("#mappedField").val(row.mappedfield);
                    $('#createNewModalForm').modal('show');
                });
                // delete row.
                deleteButton.click(function (event) {
                     deleteRows("jqxgrid","Actions/CustomFieldAction.php?call=deleteCustomfield");
                });

            }
        });
     }

</script>
</head>
<body class='default'>
    <div id="wrapper">
        <?include("adminMenu.php");?>
        <div class="adminSingup animated fadeInRight" >
        <div class="bb-alert alert alert-info" style="display:none;">
            <span>The examples populate this alert with dummy content</span>
        </div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Custom Field List</h5>
                    </div>
                    <span style="color: red;margin-left: 50px;" id ="bindingMsgDiv"></span> 
                    <div class="ibox-content">
                        <div  id="jqxgrid"></div>
                        <div id="createNewModalForm" class="modal fade" aria-hidden="true">
                            <div class="modal-dialog" >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Create/Edit Custom Fields</h4>
                                    </div>
                                    <div class="modal-body mainDiv">
                                        <div class="row" >
                                            <div class="col-sm-12">
                                                <form role="form" id="customFieldForm" class="form-horizontal">
                                                    <input type="hidden" id="id" name="id" value="0">
                                                    <input type="hidden" id="mappedField" name="mappedField">
                                                    <div class="form-group">
                                                        <label>Field Name</label>
                                                        <input type="text" id="fieldName" name="fieldName" placeholder="Field Name" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Field Type</label>
                                                        <select id="fieldType" name="fieldType" class="form-control">
                                                        <option value="Text">Text</option>
                                                        <option value="Data">Date</option>
                                                        <option value="Numeric">Numeric</option>
                                                        <option value="Yes/No">Yes/No</option>
                                                        </select>
                                                    </div>
                                                     <div class="form-group">
                                                        <div class="col-sm-4">
                                                            <label class="checkbox-inline"><input type="checkbox" value="username" name="username_map" checked="checked" id="usernamechk"> UserName </label></div>
                                                        <div class="col-sm-4">
                                                            <label class="checkbox-inline"><input type="checkbox" value="password" name="password_map" id="passwordchk"> Password </label></div>
                                                        <div class="col-sm-3">
                                                            <label class="checkbox-inline"><input type="checkbox" value="email" name="email_map" id="emailchk"> Email </label></div>
                                                     </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveButton" type="button">
                                                            <span class="ladda-label">Save</span>
                                                        </button>
                                                        <span id="saveNewBtnDiv">
                                                            <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveNewBtn" type="button">
                                                                <span class="ladda-label">Save & New</span>
                                                            </button>
                                                        </span>
                                                         <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
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
