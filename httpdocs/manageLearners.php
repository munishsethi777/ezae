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
            toggleForm(true);
            getMatchingRule();
            var url = 'ajaxAdminMgr.php?call=getLearnersGridHeaders';
            $.getJSON(url, function(data){
                loadGrid(data);
            })
            loadFormFields();
            var url = 'Actions/LearnerAction.php?call=getLearningProfiles';
            $.getJSON(url, function(data){
                profiles = $.parseJSON(data.data);
                populateDropdown(profiles);
            })
            $("#saveBtn").click(function(e){
                ValidateAndSave(e,this);
            });
            
            $("#setProfileBtn").click(function(e){
                var btn = this
                var validationResult = function (isValid) {
                    if (isValid) {
                        setProfile(e,btn);
                    }
                }
                $('#setProfileForm').jqxValidator('validate', validationResult);
            });
             
            $("#saveNewBtn").click(function(e){
                ValidateAndSave(e,this); 
            });
            $("#isMakeChange").change(function(e){
                var isChecked = this.checked;
                if(isChecked){
                    toggleForm(false);     
                }else{
                    toggleForm(true); 
                } 
            });
            //$('input[type="checkbox"][name="isChangePassword"]').on('ifChecked', function(event){
//                alert(event.type + ' callback');
//            });
        });
        
        function populateDropdown(profiles){
            var options = ""; 
            $.each(profiles, function(key, value){
                options += "<option value='" + value.id + "'>" + value.tag + "</option>";
                $("#profileSelect").html(options);  
            })
            $(".chosen-select").chosen({width:"100%"});
        }
        
        function ValidateAndSave(e,btn){
            var validationResult = function (isValid) {
                if (isValid) {
                    saveLearners(e,btn);
                }
            }
            $('#customFieldForm').jqxValidator('validate', validationResult);
        }
        
        function toggleForm(disabled){
            $('#username').prop('readonly',disabled);
            $('#password').prop('readonly',disabled);
            $('#emailid').prop('readonly',disabled);
        }
        
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
                //rows = $.parseJSON(data.Rows);
                dataFields = $.parseJSON(data.datafields);
            }
            var source =
            {
                datatype: "json",
                id: 'id',
                pagesize: 20,
                datafields: dataFields,
                url: 'ajaxAdminMgr.php?call=getLearnersForGrid',
                root: 'Rows',
                cache: false,
                beforeprocessing: function(data)
                {        
                    source.totalrecords = data.TotalRows;
                },                
                filter: function()
                {
                    // update the grid and send a request to the server.
                    $("#learnersGrid").jqxGrid('updatebounddata', 'filter');
                },
                sort: function()
                {
                        // update the grid and send a request to the server.
                        $("#learnersGrid").jqxGrid('updatebounddata', 'sort');
                }
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
                virtualmode: true,
                rendergridrows: function()
                {
                      return dataAdapter.records;     
                },
                renderstatusbar: function (statusbar) {
                    // appends buttons to the status bar.
                    var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
                    var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Add</span></div>");
                    var deleteButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
                    var setProfile = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Set Profile</span></div>");
                    var exportButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-file-excel-o'></i><span style='margin-left: 4px; position: relative;'>Export</span></div>");
                    var editButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
                    var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");

                    container.append(addButton);
                    container.append(editButton);
                    container.append(deleteButton);
                    container.append(setProfile);   
                    container.append(exportButton);
                    container.append(reloadButton);
                    statusbar.append(container);
                    addButton.jqxButton({  width: 65, height: 18 });
                    deleteButton.jqxButton({  width: 65, height: 18 });
                    setProfile.jqxButton({  width: 110, height: 18 });
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
                    setProfile.click(function (event) {
                        $("#id").val("0");
                        var selectedRowIndexes = $("#learnersGrid").jqxGrid('selectedrowindexes');
                        var names = [];
                        $("#profileSelect").val("");
                        $.each(selectedRowIndexes, function(index , value){
                            var dataRow = $("#learnersGrid").jqxGrid('getrowdata', value);
                            names.push(dataRow.username);
                        });
                        $("#learnerNamesDiv").html(names.join()); 
                        $('#setProfileModelForm').modal('show');
                    });
                    // delete selected row.
                    deleteButton.click(function (event) {
                       // var selectedrowindex = $("#learnersGrid").jqxGrid('getselectedrowindex');
//                        var rowscount = $("#learnersGrid").jqxGrid('getdatainformation').rowscount;
//                        var id = $("#learnersGrid").jqxGrid('getrowid', selectedrowindex);
//                        $("#learnersGrid").jqxGrid('deleterow', id);
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
        
        function setProfile(e,btn){
            e.preventDefault();
            var l = Ladda.create(btn);
            l.start();
            var ids = [];
            //alert($("#profileSelect option:selected").text()); 
           var selctedValues =  $.map($("#profileSelect_chosen").find(".search-choice span"), function (option) {
                                    return $(option).text()
                                    });
            var selectedIndexes  = $("#learnersGrid").jqxGrid('selectedrowindexes');
            $.each(selectedIndexes,function(key,value) {
                ids.push($("#learnersGrid").jqxGrid('getrowid',value)); 
            })
            $("#ids").val(ids);          
            $('#setProfileForm').ajaxSubmit(function( data ){
                   l.stop();
                   var obj = $.parseJSON(data);
                   //var dataRow = $.parseJSON(obj.row);
                    showResponseToastr(data,"setProfileModelForm","setProfileForm","profileMainDiv");
                    if(obj.success == 1){
                        $.each(selectedIndexes,function(key,value) {
                            val = selctedValues;
                            if(selectedIndexes.length > 1){
                                profile = $("#learnersGrid").jqxGrid('getcellvalue', value, "profiles");
                                if(profile != ""){
                                    profile += "," + selctedValues;
                                    val = profile;
                                }    
                            } 
                            $("#learnersGrid").jqxGrid('setcellvalue', value, "profiles", val); 
                        });        
                    }             
             })             
        }
        function saveLearners(e,btn){
            e.preventDefault();
            var l = Ladda.create(btn);
            l.start();            
             $('#customFieldForm').ajaxSubmit(function( data ){
                  l.stop();
                  var obj = $.parseJSON(data);
                   var dataRow = $.parseJSON(obj.row);
                   $("#createdDate").val(dataRow.createDate);
                   var id = $("#id").val();
                   if(id != "0"){
                       var selectedrowindex = $("#learnersGrid").jqxGrid('getselectedrowindex');
                       $("#learnersGrid").jqxGrid('updaterow', id, dataRow);
                   }else{
                     $("#learnersGrid").jqxGrid('addrow', null, dataRow);
                   }
                  if(btn.id == "saveBtn"){
                     showResponseToastr(data,"createNewModalForm","customFieldForm","mainDiv"); 
                  }else{
                     showResponseNotification(data,"mainDiv","customFieldForm");
                  }
                 $("#learnersGrid").jqxGrid('clearselection');              
             })             
        }
        
        function fillFormData(input){
            if(mathingRule != ""){
               var name = input.name;
               var value = input.value;
               prefix = "cus_";
               var userNameField = prefix + mathingRule.usernamefield;
               var emailField = prefix + mathingRule.emailfield;
               var passwordField = prefix + mathingRule.passwordfield;    
               if(userNameField.trim() ==  name){
                    $("#username").val(value);         
               }             
               if(emailField.trim() ==  name){
                    $("#emailid").val(value);         
               }
               if(passwordField.trim() ==  name){
                    $("#password").val(value);         
               }         
            }
        }
        
        function getMatchingRule(){
            $.getJSON("Actions/CustomFieldAction.php?call=getMatchingRule", function(data){
                if(data != ""){
                    mathingRule = $.parseJSON(data);                    
                }
            }) 
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

    <?include "SetProfile.php"?>
    <div id="createNewModalForm" class="modal fade" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Create/Edit Learner</h4>
                </div>
                <div class="modal-body mainDiv">
                    <div class="row" >
                        <div class="col-sm-12">
                            <form role="form" method="post" action="Actions/LearnerAction.php" id="customFieldForm" class="form-horizontal">
                                <input type="hidden" value="saveLearners" name="call">
                                <input type="hidden" value="createdDate" name="createdDate">  
                                <input type="hidden" id="id" name="id" value="0">
                                <div id="msgDiv" class="alert alert-success alert-dismissable" style="display:none;"></div>
                                <div id="errorDiv" class="alert alert-danger alert-dismissable" style="display:none;"></div>
                               
                                <h4 class="modal-title">Learner Details</h4>
                                <div id="formFieldsDiv"></div>
                                
                                 <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label> <input name="isMakeChange" id="isMakeChange" type="checkbox"> Make Change </label>
                                </div>                                    
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">User Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="username" name="username" placeholder="User Name" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="password" name="password" Placeholder="Password"  class="form-control">
                                    </div>
                                </div>
                               
                                
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="emailid" name="emailid" Placeholder="example@mail.com"  class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">                                   
                                     <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveBtn" type="button">
                                        <span class="ladda-label">Save</span>
                                    </button>
                                    <span id="saveNewBtnDiv"><button class="btn btn-primary ladda-button" data-style="expand-right" id="saveNewBtn" type="button">
                                        <span class="ladda-label">Save & New</span>
                                    </button></span>
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
</body>
</html>
 <script src="scripts/FormValidators/ManageLearnersValidations.js"></script> 