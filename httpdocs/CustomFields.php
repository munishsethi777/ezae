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
                  { text: 'Field Type', datafield: 'id' , hidden:true}, 
                  { text: 'Field Name' , datafield: 'name', width: 250 },
                  { text: 'Field Type', datafield: 'type' },
                  { text: 'Required', datafield: 'required'}
                ]
                var rows = Array();
                var dataFields = Array();
                if(data != null){
//                    columns = $.parseJSON(data.columns);
                    rows = $.parseJSON(data.data);
//                    dataFields = $.parseJSON(data.datafields);
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
                    // synchronize with the server - send insert command
                    // call commit with parameter true if the synchronization with the server is successful 
                    //and with parameter false if the synchronization failed.
                    // you can pass additional argument to the commit callback which represents the new ID if it is generated from a DB.
                    commit(true);
                    },
                    deleterow: function (rowid, commit) {
                        // synchronize with the server - send delete command
                        // call commit with parameter true if the synchronization with the server is successful 
                        //and with parameter false if the synchronization failed.
                        commit(true);
                    },
                    updaterow: function (rowid, newdata, commit) {
                        // synchronize with the server - send update command
                        // call commit with parameter true if the synchronization with the server is successful 
                        // and with parameter false if the synchronization failed.
                        commit(true);
                    }
                };
                
                var dataAdapter = new $.jqx.dataAdapter(source);
                
                $("#jqxgrid").jqxGrid(
                {
                    theme:'arctic',
                    height: '100%',
                    width: '100%',
                    source: dataAdapter,
                    filterable: true,
                    sortable: true,
                    autoshowfiltericon: true,
                    columns: columns,
                    rendertoolbar: function (toolbar) {
                    var me = this;
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    
                    container.append('<input id="addrowbutton" type="button" value="Create" />');                    
                    container.append('<input style="margin-left: 5px;" id="updaterowbutton" type="button" value="Edit" />');
                    container.append('<input style="margin-left: 5px;" id="deleterowbutton" type="button" value="Delete" />');
                    $("#addrowbutton").jqxButton();
                    $("#deleterowbutton").jqxButton();
                    $("#updaterowbutton").jqxButton();
                    // update row.
                    $("#updaterowbutton").on('click', function () {
                           $("#msgDiv").hide();
                           $("#errorDiv").hide();
                           var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                            var row = $('#jqxgrid').jqxGrid('getrowdata', selectedrowindex);                          
                            $("#id").val(row.id);
                            $("#fieldName").val(row.name);
                            $('#fieldType').val(row.type).attr("selected", "selected");
                            $('#isRequired').attr('checked', row.required);
                            $('#modal-form').modal('show');
                            
                            
                             
                    });
                    // create new row.
                    $("#addrowbutton").on('click', function () {
                          $("#msgDiv").hide();
                          $("#errorDiv").hide();
                          $("#customFieldForm")[0].reset(); 
                          $('#modal-form').modal('show');
                    });
                    
                   
                    // delete row.
                    $("#deleterowbutton").on('click', function () { 
                         deleteRow();
                       
                    });
                },
                    pageable: true,
                    autoheight: true,
                    altrows: true,
                    enabletooltips: true,
                    columnsresize: true,
                    columnsreorder: true,
                    showtoolbar: true
                });
            }
            function deleteRow(){
                var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                if(selectedrowindex != -1){
                    bootbox.confirm("Are you sure you want to delete selected row?", function(result) {                                                 
                     if(result){                         
                        var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                        var row = $('#jqxgrid').jqxGrid('getrowdata', selectedrowindex);  
                        if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                        $.get( "Actions/CustomFieldAction.php?call=deleteCustomfield&ids=" + row.id,function( data ){                    
                            if(data != ""){
                                var obj = $.parseJSON(data);
                                var message = obj.message; 
                                if(obj.success == 1){
                                    toastr.success(message,'Success'); 
                                     var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
                                      var commit = $("#jqxgrid").jqxGrid('deleterow', id); 
                                } else{
                                     toastr.error(message,'Failed');  
                                }
                            }
                        });                        
                       
                        }
                     }                                        
                });    
                }else{
                     bootbox.alert("No row selected.Please select row to delete!", function() {
                         
                     });
                }
                
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
                <div class="col-lg-8" >
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Custom Field List</h5>
                        </div>
                        <div class="ibox-content">
                            <div  id="jqxgrid"></div>
                            <div class="text-center">
                               
                            </div>
                            <div id="modal-form" class="modal fade" aria-hidden="true">
                                <div class="modal-dialog" >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Create/Edit Custom Fields</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row" >
                                                <div class="col-sm-6">
                                                   <form role="form" id="customFieldForm" class="form-horizontal">
                                                   <input type="hidden" id="id" name="id" value="0">     
                                                    <div id="msgDiv" class="alert alert-success alert-dismissable" style="display:none;">                                                         
                                                    </div>
                                                    <div id="errorDiv" class="alert alert-danger alert-dismissable" style="display:none;">                                                        
                                                    </div>
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
