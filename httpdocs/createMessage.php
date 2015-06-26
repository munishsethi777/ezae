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
                        <h5>Create New Notification Message<small> for communication purposes.</small></h5>
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
                                <div class="form-group"><label class="col-sm-2 control-label">Subject</label>
                                    <div class="col-sm-10"><input type="text" name="name" value="<?echo $name?>" id="name" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Message</label>
                                    <div class="col-sm-10"><textarea cols="150" rows="4"></textarea></div>
                                </div>
                                <div class="form-group">
									<label class="col-sm-2 control-label">Learning Plans</label>
									<div class="row">
										<div class="col-sm-3">
											<select class="form-control" id="profiles1" name="profile1" style="font-family: 'FontAwesome', Helvetica;">
												<option value="fa-medium">&#xf23a; Medium</option>
												<option value="fa-sellsy">&#xf213; Sellsy</option>
												<option value="fa-diamond">&#xf219; Diamond</option>
												<option value="fa-user-secret">&#xf21b; Secret</option>
												<option value="fa-venus">&#xf221; Venus</option></label>
											</select>
										</div>
									</div>
                                </div>
								
								<p></p><p></p>
								<div class="form-group">
                                    <label class="col-sm-2 control-label">Send On</label>
									
									<div class="col-sm-10">
										<div class="row">
											<div class="col-sm-2">
												<input type="radio" checked="checked" value="active" name="actOption" id="actOption"> Particular Date
											</div>
											<div class="col-sm-4">
												<input class="form-control col-sm-4" type="text" id="sendDate" name="sendDate">
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-2">
												<input type="radio" checked="checked" value="active" name="actOption" id="actOption"> Module Enrollment
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-2">
												<input type="radio" checked="checked" value="active" name="actOption" id="actOption"> Module Completion
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-2">
												<input type="radio" checked="checked" value="active" name="actOption" id="actOption"> Module Marks
											</div>
											<div class="col-sm-1">
												<select class="form-control">
													<option>></option>
													<option><</option>
													<option>=</option>
												</select>
												
											</div>
											<div class="col-sm-1">
												<input class="form-control" type="text" id="sendDate" name="sendDate">
											</div>
											<div class="col-sm-1">
												Percent
											</div>
										</div>
									</div>
									
								</div>
								
								<div class="form-group">
                                    <label class="col-sm-2 control-label">Exam Module</label>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                 <select class="form-control" id="profiles2" name="profile2" style="font-family: 'FontAwesome', Helvetica;">
                                                    <option value="fa-medium">&#xf23a; Medium</option>
                                                    <option value="fa-sellsy">&#xf213; Sellsy</option>
                                                    <option value="fa-diamond">&#xf219; Diamond</option>
                                                    <option value="fa-user-secret">&#xf21b; Secret</option>
                                                    <option value="fa-venus">&#xf221; Venus</option></label>
                                                 </select>
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