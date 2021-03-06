<?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php";
$name = "";
$active ="";
$inActive ="";
$future="";
$activateDate = "";
$id=0;
$isDeactivate="";
$isEnableLeaderBoard="";
$moduleIds = "";
$lockSequence = "";
$profileDisabled = "";
$profileId = "";
if(isset($_POST["id"])){
    $id = $_POST["id"];
   //$profileDisabled = "disabled";
}
if(isset($_POST["profileId"])){
    $profileId = $_POST["profileId"];
}
if(isset($_POST["lpName"])){
    $name = $_POST["lpName"];
}
$des = "";
if(isset($_POST["lpDes"])){
    $des = $_POST["lpDes"];
}
$isActive= "";
if(isset($_POST["isActive"])){
    $isActive = $_POST["isActive"];
    if($isActive == "true"){
        $active = "checked";
    }else{
        $inActive = "checked";
    }
} else{
    $inActive = "checked";
}

if(isset($_POST["activateDate"]) && $_POST["activateDate"] != ""){
    $activateDate = $_POST["activateDate"];
    $future = "checked";
}
$deactivateDate = "";
if(isset($_POST["deactivateDate"]) && $_POST["deactivateDate"] != ""){
    $deactivateDate = $_POST["deactivateDate"];
}
if(isset($_POST["isDeactivate"])){
    $isDeactivate = $_POST["isDeactivate"]== "true" ? "checked" : "";
}
if(isset($_POST["isEnabledLeaderboard"])){
    $isEnableLeaderBoard = $_POST["isEnabledLeaderboard"]== "true" ? "checked" : "";
}
if(isset($_POST["lockSequence"])){
    $lockSequence = $_POST["lockSequence"]== "true" ? "checked" : "";
}
if(isset($_POST["moduleIds"])){
    $moduleIds = $_POST["moduleIds"];

}
?>
<style>
.chosen-container-multi .chosen-choices li.search-choice{
    line-height:25px;
}
.chosen-container-multi .chosen-choices li{
    float:none;
}
</style>
</head>
<body>
    <div id="wrapper">
        <?include("adminMenu.php");?>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins ">
                    <div class="ibox-title">
                        <h5>Create New Learning Plan<small> with modules.</small></h5>
                    </div>
                    <div class="ibox-content mainDiv">
                            <form method="post" action="Actions/LearningPlanAction.php" id="createLearningPlanForm" class="form-horizontal">
                                <input type="hidden" id="call" name="call" value="saveLearningPlan">
                                 <input type="hidden" id="moduleIds" name="moduleIds">
                                 <input type="hidden" id="isModuleLeaderboard" name="isModuleLeaderboard">
                                 <input type="hidden" id="id" name="id" value="<?echo $id?>">
                                <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10"><input type="text" name="name" value="<? echo $name?>" id="name" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" value="<?echo $des?>" name="description"></div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label">Profile</label>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                 <select class="form-control" <?echo$profileDisabled?> id="profiles" name="profile">
                                                 </select>
                                            </div>

                                 </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Activation</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <label class="checkbox-inline"><input type="radio" checked="checked" value="active" name="actOption" id="actOption"> Active </label></div>
                                            <div class="col-sm-2">
                                                <label class="checkbox-inline"><input type="radio" <?echo($inActive)?> value="inactive" name="actOption" id="actOption"> InActive </label></div>
                                            <div class="col-sm-3">
                                                <label class="checkbox-inline"><input type="radio" <?echo($future)?> value="futureActive" name="actOption" id="actOption"> Future Activation </label></div>
                                            <div id="activateDateDiv" style="display:none;" class="col-sm-3">
                                                <input type="text" id="activationDate" value="<?echo $activateDate?>" name="activationDate" class="form-control"></div>

                                         </div>
                                    </div>
                                </div>
                                <div class="form-group" class="form-inline">
                                    <label class="col-sm-2 control-label">Deactivation</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <label class="checkbox-inline"><input type="checkbox" onchange="showHideDeactivateDate(this.checked)" <?echo $isDeactivate?> name="deactivate" id="deactivateChk"> Deactivate on </label></div>
                                            <div id="deactivateDateDiv" style="display:none;" class="col-sm-3">
                                                <input type="text" id="deactiveDate" value="<?echo $deactivateDate?>"  name="deactiveDate" class="form-control"></div>
                                            <div class="col-sm-3">
                                                <label class="checkbox-inline"><input type="checkbox" <?echo $isEnableLeaderBoard?> name="enableLeaderboard" id="deactivateChk"> Enable Leaderborad </label></div>
                                            <div class="col-sm-3">
                                                <label class="checkbox-inline"><input type="checkbox" <?echo $lockSequence?> name="locksequence" id="locksequenceChk"> Lock Sequence </label></div>
                                         </div>
                                    </div>
                                </div>
                                <div class="ibox-title">
                                    <h5>Selected Module(s) for learning Plan</h5>
                                    <?include "SelectedModuleGridInclude.php"?>

                                    <select class="form-control chosen-modulesSelect" name="modulesSelect[]" id="modulesSelect" multiple></select>

                                    <div id="addCourseModalForm" style="width: auto;" class="modal fade" aria-hidden="true">
                                        <div class="modal-dialog" >
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                    <h4 class="modal-title">Select Courses</h4>
                                                </div>
                                                <div class="modal-body mainDiv">
                                                <?include "ModuleGrid.php"?>
                                                </div>
                                                <div class="modal-footer">
                                                     <button class="btn btn-primary ladda-button" onclick="addCourses()" data-style="expand-right" id="addBtn" type="button">
                                                        <span class="ladda-label">Add</span>
                                                    </button>
                                                     <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                   </div>

                                  <div style="clear:both;margin-top:10px"></div>
                                  <div class="col-sm-4" style="padding-left:0px;">
                                  </div>
                                  <div class="col-sm-offset-9" style="text-align:right">
                                       <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveBtn" type="button">
                                            <span class="ladda-label">Save</span>
                                       </button>
                                       <?if($id == 0){?>
                                            <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveNewBtn" type="button">
                                                <span class="ladda-label">Save & New</span>
                                           </button>
    
                                       <?}?>
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
<script src="scripts/FormValidators/CreateLearningPlanValidations.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        populateProfiles();
        $('#activationDate').datetimepicker({step:5,format:"m/d/Y h:i A"});
        $('#deactiveDate').datetimepicker({step:5,format:"m/d/Y h:i A"});
        
        $("#saveBtn").click(function(e){
            ValidateAndSave(e,this);
        });

        $("#saveNewBtn").click(function(e){
            ValidateAndSave(e,this);
        });
        $("#cancelBtn").click(function(e){
            location.href = "ManageLearningPlan.php";
        });

        var selectedOption  = $("input[type='radio'][name='actOption']:checked");
        showHideActivateDate(selectedOption.val());

        $( 'input[name="actOption"]:radio' ).change(function(){
            showHideActivateDate(this.value);
        })
         var isDeactivateChecked  = $("#deactivateChk").is(':checked')  ;
         showHideDeactivateDate(isDeactivateChecked);
         loadModules();


    });
    function showHideActivateDate(value){
        if(value == "futureActive"){
            $("#activateDateDiv").show();
        }else{
             $("#activateDateDiv").hide();
        }
    }
    function showHideDeactivateDate(isChecked){
        if(isChecked){
            $("#deactivateDateDiv").show();
        }else{
            $("#deactivateDateDiv").hide();
        }
    }
    function ValidateAndSave(e,btn){
        var validationResult = function (isValid){
            if (isValid) {
               saveLearningPlan(e,btn);
            }
        }
        $('#createLearningPlanForm').jqxValidator('validate', validationResult);
    }


    function populateProfiles(){
        var url = 'Actions/LearningProfileAction.php?call=getLearnerProfiles';
        $.getJSON(url, function(data){
            var options = "";
            $.each(data, function(index , value){
                  options += "<option value='" + value.id + "'>" + value.awesomefontid  + " " + value.tag + "</option>";
            });
              $("#profiles").html(options);
              $("#profiles").val(<?echo$profileId?>);
        });
    }
    function saveLearningPlan(e,btn){
        e.preventDefault();
        var l = Ladda.create(btn);
        l.start();

        var moduleIds = [];
        $('.search-choice').each(function(){
          var selectedText = $(this).find('span').text();
          var selectedValue = $('#modulesSelect').find('option[text="'+ selectedText +'"]').val();
          var selectedValue = $('#modulesSelect option').filter(function () {
                return $(this).html() ==  selectedText ; }).val();
          moduleIds.push(selectedValue);
        })

        //var rows = $("#selectedModuleGrid").jqxGrid('getrows');
//        var ids = [];
//        var isModuleLeaderboard = []
//        $.each(rows, function(index , value){
//            ids.push(value.id);
//            var val = value.id + "=" + true;
//            if(value.enableleaderboard == undefined || !value.enableleaderboard){
//                val =  value.id + "=" + false;
//            }
//            isModuleLeaderboard.push(val);
//        });
        $("#moduleIds").val(moduleIds);
//        $("#isModuleLeaderboard").val(isModuleLeaderboard);

        $('#createLearningPlanForm').ajaxSubmit(function( data ){
            l.stop();
            var obj = $.parseJSON(data);
            var dataRow = "";
            if(btn.id == "saveBtn"){
                showResponseToastr(data,null,"createLearningPlanForm","mainDiv");
                if(obj.success == 1){
                     window.setTimeout(function(){window.location.href = "ManageLearningPlan.php"},500);
                }
            }else{
                showResponseNotification(data,"mainDiv","createLearningPlanForm");
            }

        })
     }
    function loadModules(){
        var selectedSeqs = "<?echo $moduleIds?>";
        if(selectedSeqs.length > 0){
            selectedSeqs = selectedSeqs.split(",");
        }
        selectedValues = [];
        var url = 'Actions/ModuleAction.php?call=getModulesForGrid';
        $.getJSON(url, function(data){
            var options = "";
            $.each(data, function(index , value){
                if(selectedSeqs.length > 0 && selectedSeqs.indexOf(value.id) > -1){
                    selectedValues[value.id] = value.title +" - "+ value.moduleType; 
                }else{
                    options += "<option value='" + value.id + "'>" + value.title +" - "+ value.moduleType +"</option>";
                }  
            });
            if(selectedSeqs.length > 0){
                addSelectedModules(selectedSeqs,selectedValues);
            }
            $(".chosen-modulesSelect").append(options);
            $(".chosen-modulesSelect").chosen({width:"100%"});
            dragChosen();
        });
    }
    function addSelectedModules(selectedSeqs,selectedValues){
        $.each(selectedSeqs, function(index , value){
             val = selectedValues[value];
             $('.chosen-modulesSelect').append("<option value='" + value+"'>"+val + "</option>");                
        });
        $("#modulesSelect").val(selectedSeqs);            
    }
</script>