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
if(isset($_POST["id"])){
    $id = $_POST["id"];
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
                                    <div class="col-sm-10"><input type="text" name="name" value="<?echo $name?>" id="name" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" value="<?echo $des?>" name="description"></div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label">Profile</label>
                                        <div class="row"> 
                                            <div class="col-sm-3">
                                                 <select class="form-control" id="profiles" name="profile" style="font-family: 'FontAwesome', Helvetica;">
                                                    <option value="fa-medium">&#xf23a; Medium</option> 
                                                    <option value="fa-sellsy">&#xf213; Sellsy</option>
                                                    <option value="fa-diamond">&#xf219; Diamond</option> 
                                                    <option value="fa-user-secret">&#xf21b; Secret</option>
                                                    <option value="fa-venus">&#xf221; Venus</option></label>    
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
                                    <h5>Selected Courses for learning plan(0 Selected)</h5>
                                 </div>
                                 <?include "SelectedModuleGridInclude.php"?>
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
                                  <div class="form-group">
                                  <div class="col-sm-4"> 
                                    <button class="btn btn-primary ladda-button"  data-style="expand-right" id="addCourseBtn" type="button">
                                            <span class="ladda-label">Add Courses</span>
                                       </button>
                                    </div><br><br>
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
<script src="scripts/FormValidators/CreateLearningPlanValidations.js"></script> 
<script type="text/javascript">
    $(document).ready(function(){
        $('#activationDate').datetimepicker({step:5,format:"m/d/Y h:i A"});
        $('#deactiveDate').datetimepicker({step:5,format:"m/d/Y h:i A"});
        loadGrid();
        loadSelectedGrid();
        populateProfiles();
        $("#saveBtn").click(function(e){
            ValidateAndSave(e,this);
        });
        
        $("#saveNewBtn").click(function(e){
            ValidateAndSave(e,this);
        });
        $("#cancelBtn").click(function(e){
            location.href = "ManageLearningPlan.php";
        });
        $("#addCourseBtn").click(function(e){
            $("#addCourseModalForm").modal('show')
        });
        var selectedOption  = $("input[type='radio'][name='actOption']:checked");
        showHideActivateDate(selectedOption.val());
        
        $( 'input[name="actOption"]:radio' ).change(function(){
            showHideActivateDate(this.value);
        })
         var isDeactivateChecked  = $("#deactivateChk").is(':checked')  ;
         showHideDeactivateDate(isDeactivateChecked);      
        
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
    function getSelectedModules(){
        var rows = $("#selectedModuleGrid").jqxGrid('getrows');
        var selectedMIds = [];
        $.each(rows, function(index , value){
            selectedMIds.push(value.id);
        });
        return selectedMIds;
    }
    function addCourses(){
        var selectedRowIndexes = $("#moduleGrid").jqxGrid('selectedrowindexes');
        if(selectedRowIndexes.length == 0){
            bootbox.alert("Please Select atleast one course for save learning plan.", function() {});
            return;    
        }
        var selectedMIds = getSelectedModules();
        $.each(selectedRowIndexes, function(index , value){
            var dataRow = $("#moduleGrid").jqxGrid('getrowdata', value);
            if(!isInArray(dataRow.id,selectedMIds)) {
                $("#selectedModuleGrid").jqxGrid('addrow', null, dataRow);    
            }
             
        });
        $("#addCourseModalForm").modal('hide')
        
    }
    function populateProfiles(){
        var url = 'Actions/LearningProfileAction.php?call=getLearnerProfiles';
        $.getJSON(url, function(data){
            var options = "";
            $.each(data, function(index , value){
                  options += "<option value='" + value.id + "'>" + value.awesomefontid  + " " + value.tag + "</option>";
            });
              $("#profiles").html(options);   
        });    
    }
    function saveLearningPlan(e,btn){        
        e.preventDefault();
        var l = Ladda.create(btn);
        l.start();
        var rows = $("#selectedModuleGrid").jqxGrid('getrows');
        var ids = [];
        var isModuleLeaderboard = []
        $.each(rows, function(index , value){
            ids.push(value.id);
            var val = value.id + "=" + true;
            if(value.enableleaderboard == undefined || !value.enableleaderboard){
                val =  value.id + "=" + false;    
            }
            isModuleLeaderboard.push(val);
        });
        $("#moduleIds").val(ids);
        $("#isModuleLeaderboard").val(isModuleLeaderboard);
                    
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
</script>