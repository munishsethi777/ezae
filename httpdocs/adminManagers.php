<?include("sessioncheck.php");?>
<html>
<head>
<link href="styles/plugins/iCheck/custom.css" rel="stylesheet">
<?include "ScriptsInclude.php";?>
</head>
<body class='default'>
    <div id="wrapper wrapper-content animated fadeInRight">
        <?include("adminMenu.php");?>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Create New Manager<small> for reporting based on criteria.</small></h5>
                    </div>
                    <div class="ibox-content mainDiv">
                            <form method="post" action="Actions/ManagerAction.php" id="createManagerForm" class="form-horizontal">
                                <input type="hidden" id="id" name="id" >
                                <input type="hidden" id="call" name="call" value="saveAdminMgr">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">UserName</label>
                                    <div class="col-sm-4"><input type="text" name="username" id="username" class="form-control"></div>

                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-4"><input type="text" name="password" id="password" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Full Name</label>
                                    <div class="col-sm-4"><input type="text" name="name" id="fullname" class="form-control"></div>

                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-4"><input type="text" name="email" id="email" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Mobile</label>
                                    <div class="col-sm-4"><input type="text" name="mobile" id="mobile" class="form-control"></div>
                                </div>
                               <div class="form-group">
                                    <label class="col-sm-2 control-label">Managing Criteria</label>
									<div class="col-sm-9">
										<div class="row">
											<div class="col-sm-3">
												<input type="radio" value="learningPlan" checked="checked"  name="actOption" id="actOption"> Learning Plans
											</div>
                                            <div class="col-sm-3">
                                                <input type="radio" value="learningProfile" name="actOption" id="actOption"> Learning Profiles
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="radio" value="customField" name="actOption" id="actOption"> Custom Fields
                                            </div>
										</div>
									</div>
								</div>

                                <div class="form-group" id="learningPlanDiv">
                                    <label class="col-sm-2 control-label">Learning Plans</label>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <select class="form-control chosen-select1" name="learningPlans[]" id="learningPlanDD" multiple></select>
                                            <label class="jqx-validator-error-label" id="lPlanError"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="learningProfileDiv">
                                    <label class="col-sm-2 control-label">Learning Profiles</label>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <select class="form-control chosen-select" name="learningProfiles[]" id="profilesDD" multiple></select>
                                            <label class="jqx-validator-error-label" id="lprofileError"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="customFieldDiv">
                                    <label class="col-sm-2 control-label">CustomField Name</label>
                                    <div class="col-sm-4">
                                    <select class="form-control" onchange="loadCustomfieldValues(this.value,'cusFieldValue-chosen')" name="customFieldNames[]" id="cusFieldNameDD"></select></div>
                                    <label class="col-sm-2 control-label">CustomField Value</label>
                                    <div class="col-sm-4">
                                        <select class="form-control cusFieldValue-chosen" id="cusFieldValueDD" name="customFieldValues[]" multiple></select>
                                        <label class="jqx-validator-error-label" id="lPlanError"></label></div>
                                </div>
                                <div class="form-group" id="addButtonDiv">
                                    <button type="button" class="btn btn-white" id="addCusFieldRow" data-dismiss="modal">Add</button>    
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-9">
                                       <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveBtn" type="button">
                                            <span class="ladda-label">Save</span>
                                       </button>
                                        <span id="saveNewBtnDiv"><button class="btn btn-primary ladda-button" data-style="expand-right" id="saveNewBtn" type="button">
                                            <span class="ladda-label">Save & New</span>
                                        </button></span>
                                        <button type="button" class="btn btn-white" id="cancelBtn" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<!--<script src="scripts/FormValidators/CreateMessageValidations.js"></script> -->
<script type="text/javascript">
    var $customFieldSelectHtml = "";
    var counter = 1;
    $(document).ready(function(){
        $(".cusFieldValue-chosen").chosen({width:"100%"});
        var url = 'Actions/LearningPlanAction.php?call=getLearnerPlansForGrid';
        $.getJSON(url, function(data){
            populateLearningPlans(data);
        })
        populateProfiles();
        populateCustomFieldNames();
     
        $( 'input[name="actOption"]:radio' ).change(function(){
             showHideDiv(this.value + "Div");
        })
        showHideDiv("learningPlanDiv");
        $("#saveBtn").click(function(e){
            ValidateAndSave(e,this);
        });

        $("#saveNewBtn").click(function(e){
            ValidateAndSave(e,this);
        });
        $("#addCusFieldRow").click(function(e){
           var cusValueClass = 'cusFieldValue-chosen' + counter;
           var html =  '<label class="col-sm-2 control-label">CustomField Name</label>';   
               html += '<div class="col-sm-4">';
               html += "<select class='form-control' onchange='loadCustomfieldValues(this.value, \"" +  cusValueClass + "\")' name='customFieldNames[]' id='cusFieldNameDD" + counter + "'>"
               html += '</select></div>';
               html += '<label class="col-sm-2 control-label">CustomField Value</label>';
               html += '<div class="col-sm-4">';
               html += '<select class="form-control '+ cusValueClass + '" id="cusFieldValueDD'+ counter + '" name="customFieldValues[]" multiple>';
               html += '</select>';
               html += '<label class="jqx-validator-error-label" id="lPlanError"></label></div>';
               $("#customFieldDiv").append(html);
               $("." + cusValueClass).chosen({width:"100%"}); 
               $('#cusFieldNameDD'+ counter).html($customFieldSelectHtml); 
               $('.' + cusValueClass).trigger("chosen:updated");                 
               counter = counter + 1;
        });
    });

    function populateLearningPlans(learningPlans){
        var options = "";
        $.each(learningPlans.Rows, function(key, value){
            options += "<option value='" + value.id + "'>" + value.title + "</option>";

        })
        $("#learningPlanDD").html(options);
        $(".chosen-select1").chosen({width:"100%"});
    }
    function loadCustomfieldValues(cusFieldName,divClassName){
        var url = 'Actions/CustomFieldAction.php?call=getCustomFieldValuesByName&cusFieldName=' + cusFieldName;
        $.getJSON(url, function(data){
            var options = "";
            data = data.values;
            $.each(data, function(index , value){
                  options += "<option value='" + value + "'>" + value + "</option>";
            });
            $("." + divClassName).html(options);           
            $("." + divClassName).trigger("chosen:updated");
        });    
    }
    function populateProfiles(){
        var url = 'Actions/LearningProfileAction.php?call=getLearnerProfiles';
        $.getJSON(url, function(data){
            var options = "";
            $.each(data, function(index , value){
                  options += "<option value='" + value.id + "'>" + value.awesomefontid  + " " + value.tag + "</option>";
            });
            $("#profilesDD").html(options);
            $(".chosen-select").chosen({width:"100%"});
        });
    }
    function populateCustomFieldNames(){
        var url = 'Actions/CustomFieldAction.php?call=getCustomFieldNames';
        $.getJSON(url, function(data){
            var values = data.names
            var options = "";
            $.each(values, function(index , value){
                  options += "<option value='" + value + "'>" + value + "</option>";
            });
            $("#cusFieldNameDD").html(options);
            $customFieldSelectHtml = options;
        });
    }
    function showHideDiv(divId){
        $("#learningPlanDiv").hide();
        $("#learningProfileDiv").hide();
        $("#customFieldDiv").hide();
        $("#addButtonDiv").hide();
        if(divId == "customFieldDiv"){
            $("#addButtonDiv").show();    
        }        
        $("#" + divId).show();
    }
    
    function showHideModule(isChecked){
        if(isChecked){
            $("#deactivateDateDiv").show();
        }else{
            $("#deactivateDateDiv").hide();
        }
    }

    function ValidateAndSave(e,btn){
        //var validationResult = function (isValid){
           //if (isValid) {
               saveManager(e,btn);
            //}
        //}
      // $('#createMessageForm').jqxValidator('validate', validationResult);
    }


    
    function saveManager(e,btn){
        var l = Ladda.create(btn);
        l.start();
        $('#createManagerForm').ajaxSubmit(function( data ){
            l.stop();
            var obj = $.parseJSON(data);
            var dataRow = "";
            if(btn.id == "saveBtn"){
                showResponseToastr(data,null,"createManagerForm","mainDiv");
                if(obj.success == 1){
                     window.setTimeout(function(){window.location.href = "manageManagers.php"},500);
                }
            }else{
                showResponseNotification(data,"mainDiv","createManagerForm");
            }

        })
     }
</script>