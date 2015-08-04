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
                            <form method="post" action="Actions/MailMessageAction.php" id="createMessageForm" class="form-horizontal">
                                <input type="hidden" id="id" name="id" value="<?echo $id?>">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">UserName</label>
                                    <div class="col-sm-4"><input type="text" name="name" id="name" class="form-control"></div>

                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-4"><input type="text" name="password" id="password" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Full Name</label>
                                    <div class="col-sm-4"><input type="text" name="name" id="name" class="form-control"></div>

                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-4"><input type="text" name="password" id="password" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Mobile</label>
                                    <div class="col-sm-4"><input type="text" name="name" id="name" class="form-control"></div>

                                    <label class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-4"><input type="text" name="password" id="password" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Details</label>
                                    <div class="col-sm-10"><input type="text" name="name" id="name" class="form-control"></div>
                                </div>

                               <div class="form-group">
                                    <label class="col-sm-2 control-label">Managing Criteria</label>
									<div class="col-sm-10">
										<div class="row">
											<div class="col-sm-2">
												<input type="radio" value="onParticulerDate" name="actOption" id="actOption"> Learning Plans
											</div>
                                            <div class="col-sm-2">
                                                <input type="radio" value="onParticulerDate" name="actOption" id="actOption"> Learning Profiles
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="radio" value="onParticulerDate" name="actOption" id="actOption"> Custom Fields
                                            </div>
										</div>
									</div>
								</div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Learning Plans</label>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <select class="form-control chosen-select" id="learningPlanDD" multiple></select>
                                            <label class="jqx-validator-error-label" id="lpError"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Learning Profiles</label>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <select class="form-control chosen-select" id="learningPlanDD" multiple></select>
                                            <label class="jqx-validator-error-label" id="lpError"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">CustomField Name</label>
                                    <div class="col-sm-4"><input type="text" name="name" id="name" class="form-control"></div>

                                    <label class="col-sm-2 control-label">Custom Field Value</label>
                                    <div class="col-sm-4"><input type="text" name="password" id="password" class="form-control"></div>
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
<script src="scripts/FormValidators/CreateMessageValidations.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".chosen-select1").chosen({width:"100%"});
        $("#conditionOperator").val('<?echo $condition?>');
        var url = 'Actions/LearningPlanAction.php?call=getLearnerPlansForGrid';
        $.getJSON(url, function(data){
            populateDropdown(data);
        })
         CKEDITOR.replace( 'editor', {
            extraPlugins: 'placeholder'
        });
         CKEDITOR.instances.editor.setData('test');

         $('#sendDate').datetimepicker({step:5,format:"m/d/Y h:i A"});
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
            values = values.split(",")
            $('.chosen-select').val(values).trigger("chosen:updated");
            loadModule();
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
        if(value == "onMarks"){
            $("#moduleMarksDiv").show();
        }else{
            $("#moduleMarksDiv").hide();
        }
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


    function loadModule(){
       var vals = [];

        $( '#learningPlanDD :selected' ).each( function( i, selected ) {
            vals[i] = $( selected ).val();
         });
        var url = 'Actions/ModuleAction.php?call=getModulesBySelectedLearningPlan&ids=' + vals;
        $.getJSON(url, function(data){
            var options = "";
            $("#moduleDD").html(options);
            $.each(data, function(index , value){
                  $('.chosen-select1').append("<option value='"+value.lpseq + "_" + value.id+"'>"+value.title+" ("+ value.lptitle +")</option>");
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
        alert(editorData);
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