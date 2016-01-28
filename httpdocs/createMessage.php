<?include("sessioncheck.php");?>
<html>
<head>
<link href="styles/plugins/iCheck/custom.css" rel="stylesheet">
<?include "ScriptsInclude.php";
$name = "";
$subject ="";
$messageText ="Enter Message Text";
$lpSeqs="";
$condition = "";
$sendOnDate="";
$percent="";
$moduleSeqs = "";
//Conditions Radios
$onParticulerDate = "checked";
$onEnrollment = "";
$onCompletion = "";
$onMarks = "";
$selectCondition = "onParticulerDate";
$operatorCondition = "onMarksEqualTo";
if(isset($_POST["id"])){
    $id = $_POST["id"];
}
if(isset($_POST["name"])){
    $name = $_POST["name"];
}

if(isset($_POST["subject"])){
    $subject = $_POST["subject"];
}
if(isset($_POST["messageText"])){
    $messageText = $_POST["messageText"];
   // $messageText = nl2br($messageText);
}
if(isset($_POST["lpSeqs"])){
    $lpSeqs = $_POST["lpSeqs"];
}

if(isset($_POST["messageCondition"])){
    $condition = $_POST["messageCondition"];
    if(strpos($condition, 'Enrollment') !== false){
        $onEnrollment = "checked" ;
        $selectCondition = "onEnrollment";
    }else if(strpos($condition, 'Scoring') !== false){
        $onMarks = "checked";
        $selectCondition = "onMarks";
    }else if(strpos($condition, 'Completion') !== false){
        $onCompletion = "checked";
        $selectCondition = "onCompletion";
    }else{
        $onParticulerDate = "checked";
        $selectCondition = "onParticulerDate";
    }

    if(strpos($condition, 'Scoring less') !== false){
        $operatorCondition = "onMarksLessThan";
    }else if(strpos($condition, 'Scoring more') !== false){
        $operatorCondition = "onMarksGreaterThan";
    }
}

if(isset($_POST["percent"])){
    $percent = $_POST["percent"];
}

if(isset($_POST["moduleSeqs"])){
    $moduleSeqs = $_POST["moduleSeqs"];
}
if(isset($_POST["sendOnDate"]) && $_POST["sendOnDate"] != ""){
    $sendOnDate = $_POST["sendOnDate"];
    $future = "checked";
}

?>
</head>
<body class='default'>
    <div id="wrapper wrapper-content animated fadeInRight">
        <?include("adminMenu.php");?>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Create New Notification Message<small> for communication purposes.</small></h5>
                    </div>
                    <div class="ibox-content mainDiv">
                            <form method="post" action="Actions/MailMessageAction.php" id="createMessageForm" class="form-horizontal">
                                 <input type="hidden" id="call" name="call" value="saveMailMessage">
                                 <input type="hidden" id="messageText" name="messageText">
                                 <input type="hidden" id="moduleSeqs" name="moduleSeqs[]">
                                 <input type="hidden" id="lpSeqs" name="lpSeqs[]">
                                 <input type="hidden" id="id" name="id" value="<?echo $id?>">
                                <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10"><input type="text" name="name" value="<?echo $name?>" id="name" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Subject</label>
                                    <div class="col-sm-10"><input type="text" name="subject" value="<?echo $subject?>" id="subject" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Message</label>
                                    <div class="col-sm-10">
                                        <div id="editor">
                                            <h1>Hello world!</h1>
                                            <p>I'm an instance of <a href="http://ckeditor.com">CKEditor</a>.</p>
                                        </div>
                                    </div>
                                </div>


								<p></p><p></p>
								<div class="form-group">
                                    <label class="col-sm-2 control-label">Send On</label>

									<div class="col-sm-10">
										<div class="row">
											<div class="col-sm-2">
												<input type="radio" <?echo $onParticulerDate?> value="onParticulerDate" name="actOption" id="actOption"> Particular Date
											</div>
											<div class="col-sm-4" id="sendDateDiv">
												<input class="form-control" placeholder="Select Date" value="<?echo $sendOnDate?>" type="text" id="sendDate" name="sendDate">

											</div>
										</div>

										<div class="row">
											<div class="col-sm-2">
												<input type="radio" <?echo $onEnrollment?> value="onEnrollment" name="actOption" id="actOption"> Module Enrollment
											</div>
										</div>

										<div class="row">
											<div class="col-sm-2">
												<input type="radio" <?echo $onCompletion?>  value="onCompletion" name="actOption" id="actOption"> Module Completion
											</div>
										</div>

										<div class="row">
											<div class="col-sm-2">
												<input type="radio" <?echo $onMarks?> value="onMarks" name="actOption" id="actOption"> Module Marks
											</div>
                                            <div id="moduleMarksDiv">
											    <div class="col-sm-2">
												    <select  class="form-control" id="conditionOperator" name="conditionOperator">
													    <option value="onMarksGreaterThan">></option>
													    <option value="onMarksLessThan"><</option>
													    <option value="onMarksEqualTo">=</option>
												    </select>
											    </div>
											    <div class="col-sm-1">
												    <input class="form-control" value="<?echo $percent?>" type="text" id="percent" name="percent">
											    </div>
											    <div class="col-sm-1">
												    Percent
											    </div>
                                            </div>
										</div>
									</div>
								</div>
								 <div class="form-group" id="learningPlanDiv">
                                    <label class="col-sm-2 control-label">Learning Plans</label>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <select class="form-control chosen-select" onchange="loadModule(false)" id="learningPlanDD" name="learningPlanDD[]" multiple>
                                            </select>
                                            <label class="jqx-validator-error-label" id="lpError"></label>
                                        </div>
                                    </div>
                                </div>
								<div class="form-group" id="moduleDiv">
                                    <label class="col-sm-2 control-label">Exam Module</label>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                 <select class="form-control chosen-select1" id="moduleDD" name="moduleDD[]" multiple>
                                                 </select>
                                                  <label class="jqx-validator-error-label" id="moduleError"></label>
                                            </div>
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
<!--ckeditor-->
<script src="scripts/plugins/ckeditor/ckeditor.js"></script>
<script src="scripts/FormValidators/CreateMessageValidations.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".chosen-select1").chosen({width:"100%"});
        $("#conditionOperator").val('<?echo $operatorCondition?>');
        var url = 'Actions/LearningPlanAction.php?call=getLearnerPlansForGrid';
        $.getJSON(url, function(data){
            populateDropdown(data.Rows);
        })
         CKEDITOR.replace( 'editor', {
            extraPlugins: 'placeholder'
        });
         <?$messageText = str_replace("\r\n", "\\r\\n",$messageText)?>
         CKEDITOR.instances.editor.setData("<?echo $messageText?>")
          var dateToday = new Date();
         $('#sendDate').datetimepicker({step:5,format:"m/d/Y h:i A",minDate: 0});
         $( 'input[name="actOption"]:radio' ).change(function(){
             showHideSendDate(this.value);
        })
        showHideSendDate('<?echo $selectCondition?>');
         $("#saveBtn").click(function(e){
            ValidateAndSave(e,this);
        });

        $("#saveNewBtn").click(function(e){
            ValidateAndSave(e,this);
        });
        $("#cancelBtn").click(function(e){
            location.href = "ManageLearningPlan.php";
        });
    });

    function populateDropdown(profiles){
        var options = "";
        $.each(profiles, function(key, value){
            options += "<option value='" + value.id + "'>" + value.title + "</option>";

        })
        $("#learningPlanDD").html(options);
        $(".chosen-select").chosen({width:"100%"});
        var values = "<?echo $lpSeqs?>";
        if(values.length > 0){
            values = values.split(",");
            $('.chosen-select').val(values).trigger("chosen:updated");
            loadModule(false);
        }


    }

    function showHideSendDate(value){
        if(value == "onParticulerDate"){
            $("#sendDateDiv").show();
            $("#moduleDiv").hide();

        }else{
             $("#sendDateDiv").hide();
             $("#moduleDiv").show();
        }
        if(value == "onEnrollment"){
            $("#learningPlanDiv").hide();
        }else{
             $("#learningPlanDiv").show();
        }
        if(value == "onMarks"){
            $("#moduleMarksDiv").show();
        }else{
            $("#moduleMarksDiv").hide();
        }
        loadModule(true);
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
               saveMailMessage(e,btn);
            }
        }
       $('#createMessageForm').jqxValidator('validate', validationResult);
    }


    function loadModule(flag){
        var vals = [];
        var url = "";
        if(flag){
            url = 'Actions/ModuleAction.php?call=getModulesBySelectedLearningPlan';
        }else{
            $( '#learningPlanDD :selected' ).each( function( i, selected ) {
                vals[i] = $( selected ).val();
            });
            url = 'Actions/ModuleAction.php?call=getModulesBySelectedLearningPlan&ids=' + vals;
        }
        $.getJSON(url, function(data){
            var options = "";
            $("#moduleDD").html(options);
            $.each(data, function(index , value){
                 if(value.lptitle != undefined){
                    $('.chosen-select1').append("<option value='"+value.lpseq + "_" + value.id+"'>"+value.title+" ("+ value.lptitle +")</option>");
                 }else{
                    $('.chosen-select1').append("<option value='" + value.id+"'>"+value.title + "</option>");
                 }

            });
            $('.chosen-select1').trigger("chosen:updated");
            var values = "<?echo $moduleSeqs?>";
            if(values.length > 0){
                values = values.split(",")
                $('.chosen-select1').val(values).trigger("chosen:updated");
            }
        });
    }

    function saveMailMessage(e,btn){
        var editorData = CKEDITOR.instances.editor.getData();
        $("#messageText").val(editorData);
        e.preventDefault();
        var moduleseqs = [];
        $( '#moduleDD :selected' ).each( function( i, selected ) {
            moduleseqs[i] = $( selected ).val();
        });
        $("#moduleSeqs").val(moduleseqs);

        var vals = [];
        $( '#learningPlanDD :selected' ).each( function( i, selected ) {
            vals[i] = $( selected ).val();
         });
        $("#lpSeqs").val(vals);

        var l = Ladda.create(btn);
        l.start();
        $('#createMessageForm').ajaxSubmit(function( data ){
            l.stop();
            var obj = $.parseJSON(data);
            var dataRow = "";
            if(btn.id == "saveBtn"){
                showResponseToastr(data,null,"createMessageForm","mainDiv");
                if(obj.success == 1){
                     window.setTimeout(function(){window.location.href = "manageMessages.php"},500);
                }
            }else{
                showResponseNotification(data,"mainDiv","createMessageForm");
            }

        })
     }
</script>