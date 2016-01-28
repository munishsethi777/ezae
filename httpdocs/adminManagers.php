<?include("sessioncheck.php");?>
<?
$id = "";
$userName = "";
$password = "";
$fullName = "";
$email = "";
$mobile = "";
if(isset($_POST["id"])){
    $id = $_POST["id"];
}
if(isset($_POST["username"])){
    $mgrName = $_POST["username"];
}
if(isset($_POST["password"])){
    $password = $_POST["password"];
}
if(isset($_POST["fullname"])){
    $fullName = $_POST["fullname"];
}
if(isset($_POST["email"])){
    $email = $_POST["email"];
}
if(isset($_POST["mobile"])){
    $mobile = $_POST["mobile"];
}

?>
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
                                <input type="hidden" id="id" name="id" value="<?echo $id?>" >
                                <input type="hidden" id="call" name="call" value="saveAdminMgr">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">UserName</label>
                                    <div class="col-sm-4"><input type="text" name="username" value="<?echo $mgrName?>" id="username" class="form-control"></div>

                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-4"><input type="text" name="password" value="<?echo $password?>" id="password" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Full Name</label>
                                    <div class="col-sm-4"><input type="text" name="name" value="<?echo $fullName?>" id="fullname" class="form-control"></div>

                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-4"><input type="text" name="email" value="<?echo $email?>" id="email" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Mobile</label>
                                    <div class="col-sm-4"><input type="text" name="mobile" value="<?echo $mobile?>" id="mobile" class="form-control"></div>
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
                                    <div class="col-sm-3">
                                    <select class="form-control" onchange="loadCustomfieldValues(this.value,'cusFieldValue-chosen')" name="customFieldNames[]" id="cusFieldNameDD"></select>
                                    </div>
                                    <label class="col-sm-2 control-label">Value(s)</label>
                                    <div class="col-sm-4">
                                        <select class="form-control cusFieldValue-chosen" id="cusFieldValueDD" name="customFieldValues[]" multiple></select>
                                        <label class="jqx-validator-error-label" id="cusFieldValueError"></label>
                                    </div>
                                    <div class="col-sm-1">

                                    </div>
                                </div>
                                <div class="form-group" id="addButtonDiv">
                                    <div class="col-sm-offset-2 col-sm-2">
                                        <button type="button" class="btn-xs btn-success" id="addCusFieldRow" data-dismiss="modal"><i class="fa fa-plus"></i> Add More</button>
                                    </div>

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
<script src="scripts/FormValidators/CreateManagerValidations.js"></script>
<script type="text/javascript">
    var $customFieldSelectHtml = "";
    var counter = 1;
    var selectedValues = [];
    $(document).ready(function(){

        $(".cusFieldValue-chosen").chosen({width:"100%"});

        var url = 'Actions/LearningPlanAction.php?call=getLearnerPlansForGrid';
        $.getJSON(url, function(data){
            populateLearningPlans(data);
        });
        populateCustomFieldNames();
        populateProfiles();
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
            addCustomFieldRow();
        });
    });

    function addCustomFieldRow(){
        rules = $("#createManagerForm").jqxValidator('rules');
           var cusValueClass = 'cusFieldValue-chosen' + counter;
           var cusDiv =   "cusDiv" + counter;
           var html = '<div id="'+ cusDiv + '">';
               html +=  '<label class="col-sm-2 control-label">CustomField Name</label>';
               html += '<div class="col-sm-3">';
               html += "<select class='form-control' onchange='loadCustomfieldValues(this.value, \"" +  cusValueClass + "\")' name='customFieldNames[]' id='cusFieldNameDD" + counter + "'>"
               html += '</select></div>';
               html += '<label class="col-sm-2 control-label">CustomField Value</label>';
               html += '<div class="col-sm-4">';
               html += '<select class="form-control '+ cusValueClass + '" id="cusFieldValueDD'+ counter + '" name="customFieldValues[]" multiple>';
               html += '</select>';
               html += '<label class="jqx-validator-error-label" id="cusFieldValueError'+ counter + '"></label></div>';
               html += '<div class="col-sm-1">';
               html += "<button class='btn-xs btn-danger btn-circle' type='button' onclick='removeCusFieldRow(\"" + cusDiv + "\"," + counter + ")' ><i class='fa fa-times'></i></button>";
                html += '</div>';

               index = counter;
               $("#customFieldDiv").append(html);
               rules.push(
                { input: '#cusFieldNameDD' + counter , message: 'Select CustomField Name !', action: 'keyup, blur', rule: function (input, commit) {
                    return requiredCustomField(input);}
                }
                );
               rules.push(
                { input: '#cusFieldValueDD' + counter , message: 'Select CustomField Value !', action: 'keyup, blur', rule: function (input, commit) {
                    return requiredCustomFieldValue(input,index);}
                }
                );
               //Update jqxValidator's rules
                $('#createManagerForm').jqxValidator('rules', rules);
               $("." + cusValueClass).chosen({width:"100%"});
               $('#cusFieldNameDD'+ counter).html($customFieldSelectHtml);
               $('.' + cusValueClass).trigger("chosen:updated");
               counter = counter + 1;
    }

    function removeCusFieldRow(divId,counter){
        $('#' + divId).remove();
        rules = $("#createManagerForm").jqxValidator('rules');
        var rulesToDelete = ["#cusFieldNameDD" + counter, "#cusFieldValueDD" + counter];
        rules = rules.filter(function(obj) {
            return rulesToDelete.indexOf(obj.input) === -1;
        });
        $('#createManagerForm').jqxValidator('rules', rules);
    }
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
        $.ajax({
          url: url,
          dataType: 'json',
          async: false,
          success: function(data) {
                var options = "";
                data = data.values;
                $.each(data, function(index , value){
                      options += "<option value='" + index + "'>" + value + "</option>";
                });
                $("." + divClassName).html(options);
                $("." + divClassName).trigger("chosen:updated");
                if(selectedValues.length > 0){
                    $("." + divClassName).val(selectedValues).trigger("chosen:updated");
                }
          }
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
            var options = "<option value='0'>Select Option</option>";
            $.each(values, function(index , value){
                  options += "<option value='" + value.name + "'>" + value.title + "</option>";
            });
            $("#cusFieldNameDD").html(options);
            $customFieldSelectHtml = options;
            <?if(!empty($id)){?>
                populateCriteriaDetail();
            <?}?>

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
        var validationResult = function (isValid){
           if (isValid) {
               saveManager(e,btn);
           }
        }
        $('#createManagerForm').jqxValidator('validate', validationResult);
    }

   function populateCriteriaDetail(){
        var fieldDiv = "#cusFieldNameDD";
        var valueClass = ".cusFieldValue-chosen";
        var divId = "learningPlanDD";
        var url = "Actions/ManagerAction.php?call=getCriteriaDetail&id=<?echo $id?>";
        $.getJSON(url, function(data){
            var criteriaType = data.criteriatype;
            $("input[name=actOption][value=" + criteriaType + "]").attr('checked', 'checked').change();
            var criteriaValues = data.criteriavalue;
            i = 0;
            if(criteriaType == "customField"){
                $.each(criteriaValues, function(key , value){
                    var values = [];
                    $.each(value, function(k , v){
                        values.push(key + "_" + decodeURIComponent(v));
                    });
                    if(i > 0){
                        addCustomFieldRow();
                        fieldDiv += i;
                        valueClass += i;
                    }
                    selectedValues = values;
                    $(fieldDiv).val(key).change();
                    i++;
                });
            }else{
                if(criteriaType == "learningProfile"){
                    divId = "profilesDD"
                }
                 var vals = criteriaValues.split(",")
                    $("#" + divId).val(vals).trigger("chosen:updated");
                 }
        })
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
                     window.setTimeout(function(){window.location.href = "manageAdminManagers.php"},500);
                }
            }else{
                showResponseNotification(data,"mainDiv","createManagerForm");
            }

        })
     }
</script>