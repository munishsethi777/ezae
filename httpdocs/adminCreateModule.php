<?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php";?>
<?
    require_once('IConstants.inc');
    require_once($ConstantsArray['dbServerUrl'] ."Managers/ModuleMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/ModuleType.php");    
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Module.php");
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ModuleQuestion.php");
    $module = new Module();
    $selectedQuesSeqs = "";
    $moduleMgr = ModuleMgr::getInstance();
     $id = 0; 
    if(isset($_POST["moduleId"])){
        $id = $_POST["moduleId"];
        $module = $moduleMgr->getModule($id);                  
    }
    $essay = "";
    $videoUrl = "";
    $audioUrl = "";
    $isDocumentLoaded = 0;
    $document = "<a>Select Document</a>";
    $imagePath =  $module->getImagePath();
    $moduleType = $module->getModuleType();
     if(empty($moduleType)){
        $moduleType = "quiz";
    }
    if(empty($imagePath)){
        $imagePath = "dummy.jpg";
    }
    if($module->getModuleType() == ModuleType::EASSY){
        $essay = $module->getTypeDetails();    
    }else if($module->getModuleType() == ModuleType::VIDEO){
        $videoUrl = $module->getTypeDetails(); 
    }else if($module->getModuleType() == ModuleType::AUDIO){
        $audioUrl = $module->getTypeDetails(); 
    }else if($module->getModuleType() == ModuleType::QUIZ){
        $selectedQuesSeqs = $moduleMgr->getSelectedQuestionSeqs($module->getSeq());
    }else if($module->getModuleType() == ModuleType::DOCUMENT){
        $document = "Selected Document : - <a>". $module->getTypeDetails() ."</a>";
        $isDocumentLoaded = 1;
    } 
?>
<style>
.chosen-container-multi .chosen-choices li.search-choice{
    line-height:25px;
}
.chosen-container-multi .chosen-choices li{
    float:none;
}
.questionOptionMarksDiv{
    width:58% !important;
    display:inline-table !important;
}
.btn-circle{
    width:20px;
    height:20px;
    padding:0px;
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
                        <h5>Create new Custom Learning Module<small></small></h5>
                    </div>
                    <div class="ibox-content mainDiv">
                            <form method="post" action="Actions/ModuleAction.php"  enctype="multipart/form-data" id="createModuleForm" class="form-horizontal">
                                <input type="hidden" id="id" name="id" value="<?echo $module->getSeq()?>">
                                <input type="hidden" id="call" name="call" value="saveModule">
                                <input type="hidden" id="eassy" name="eassy" >
                                <input type="hidden" id="selectedQuestions" name="selectedQuestions">
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Name</label>
                                    <div class="col-sm-5"><input type="text" name="name" value="<?echo $module->getTitle()?>" id="name" class="form-control"></div>
                                    <label class="col-sm-1 control-label">Description</label>
                                    <div class="col-sm-5"><input type="text" name="description" value="<?echo $module->getDescription()?>" id="description" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Type</label>
                                    <div class="col-sm-2">
                                        <select class="form-control" id="moduleType" name="moduleType" style="font-family: 'FontAwesome', Helvetica;">
                                            <option value="quiz">Quiz</option>
                                            <option value="essay">Essay</option>
                                            <option value="document">Document</option>
                                            <option value="video">Video</option>
                                            <option value="audio">Audio</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-1 control-label">TagLine</label>
                                    <div class="col-sm-2"><input type="text" name="tagline" value="<?echo $module->getTagLine()?>" id="tagline" class="form-control"></div>
                                    <label class="col-sm-1 control-label">Prerequisities</label>
                                    <div class="col-sm-2"><input type="text" name="prereq" value="<?echo $module->getPrerequisties()?>" id="prereq" class="form-control"></div>
                                    <label class="col-xs-1 control-label">Tags</label>
                                    <div class="col-sm-2"><input type="text" name="tags" value="<?echo $module->getTags()?>" id="tags" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Max Marks</label>
                                    <div class="col-sm-2"><input type="text" name="maxmarks" value="<?echo $module->getMaxScore()?>" id="maxmarks" class="form-control"></div>
                                    <label class="col-sm-1 control-label">Pass %</label>
                                    <div class="col-sm-2"><input type="text" name="passpercent" value="<?echo $module->getPassPercent()?>" id="passpercent" class="form-control"></div>

                                    <label class="col-sm-1 control-label">Time Allwd.</label>
                                    <div class="col-sm-2"><input type="text" name="time" value="<?echo $module->getTimeAllowed()?>" id="time" class="form-control"></div>
                                    <label class="col-sm-1 control-label">Image</label>
                                    <div class="col-sm-2">
                                        <input type="file" id="imgfileToUpload" name="imgfileToUpload" class="hidden"/>
                                        <label for="imgfileToUpload"><a><img alt="image" id="moduleImg" class="img" width="80px;" src="<?echo "images/modules/".$imagePath?>"></a></label>
                                    </div>
                                </div>
                                <div class="essayEditor editorPanel animated fadeInRight" style="display: none;">
                                    <h4>Create New Essay</h4> <label class="jqx-validator-error-label" id="essayError"></label> 
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div id="editor">

                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                </div>
                                <div class="documentEditor editorPanel animated fadeInRight"  style="display: none;">
                                    <h4>Create New Document</h4>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                           <input type="file" name="fileToUpload" id="fileToUpload" class="hidden">
                                           <label id="lblFileUpload" for="fileToUpload" class="control-label"><?echo $document?></label> 
                                           <label class="jqx-validator-error-label" id="documentError"></label>                                            
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                </div>                                                                               
                                <div class="videoEditor editorPanel animated fadeInRight"  style="display: none;">
                                    <h4>Create New Video</h4>
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label">Embed Code</label>
                                        <div class="col-sm-11">
                                           <input type="text" name="vembedCode"  id="vembedCode" value="<?echo htmlentities($videoUrl)?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                </div>
                                <div class="audioEditor editorPanel"  style="display: none;">
                                    <h4>Create New Audio</h4>
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label">Embed Code</label>
                                        <div class="col-sm-11">
                                           <input type="text" name="aembedCode" id="aembedCode" value="<?echo htmlentities($audioUrl)?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                </div>
                            </form>
                            <form method="post" action="Actions/ModuleAction.php" id="createQuestionForm" class="form-horizontal">
                                <input type="hidden" id="call" name="call" value="saveQuestion">  
                                <div class="quizEditor editorPanel animated fadeInRight" style="display: none;">
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label">Questions</label>
                                        <div class="col-sm-9">
                                            <select class="form-control chosen-questionsSelect" onchange="requiredQuestion(this)" name="questionsSelect" id="questionsSelect" multiple></select>
                                            <label class="jqx-validator-error-label" id="questionError"></label> 
                                        </div>
                                        <button class="col-sm-1 btn-xs btn-success" id="addNewQuestionButton" type="button">Add New Question</button>
                                    </div>
                                    <div class="hr-line-dashed"></div>                                    
                                    <div class="quizQuestionEditor animated fadeInDown" style="display:none">
                                        <h4>Create New Question</h4>
                                        <div class="form-group">
                                            <label class="col-sm-1 control-label">Question</label>
                                            <div class="col-sm-5"><input type="text" name="questionname" value="" id="questionname" class="form-control"></div>
                                             <label class="col-sm-1 control-label">Type</label>
                                             <div class="col-sm-3">
                                                <select class="form-control" id="questionType" name="questiontype" style="font-family: 'FontAwesome', Helvetica;">
                                                    <option value="single">Single Selection</option>
                                                    <option value="multi">Multi Selection</option>
                                                </select>
                                              </div>
                                            <label class="col-sm-1 control-label">Marks</label>
                                            <div class="col-sm-1"><input type="text" name="questotalMarks" id="totalMarks" class="form-control" disabled="true"></div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-1 control-label">Option 1</label>
                                            <div class="col-sm-4"><input type="text" name="option[]" value="" id="option1" class="form-control"></div>

                                            <label class="col-sm-1 control-label">Feedback</label>
                                            <div class="col-sm-4"><input type="text" name="feedback[]" id="feedback1" class="form-control"></div>

                                            <label class="col-sm-1 control-label">Marks</label>
                                            <div class="col-sm-1"><input type="text" name="marks[]" id="marks1" onchange="calTotalMarks(this.value)" class="form-control questionOptionMarksDiv"></div>
                                        </div>
                                        <div class="quizQuestionOptionsDiv animation_box"></div>

                                        <div class="form-group">
                                            <button class="col-sm-offset-1 col-sm-1 btn-xs btn-success" id="addQuizQuestionOptionButton" type="button"><i class="fa fa-plus"></i> Add Option</button>
                                            <div class="col-sm-offset-9">
                                                <button class="btn-xs btn-success" id="saveQuesBtn" type="button"><i class="fa fa-save"></i> Save Question</button>
                                                <button class="btn-xs btn-success" id="saveNewQuesBtn" type="button"><i class="fa fa-save"></i> Save & New Question</button>
                                                <button class="btn-xs btn-white" id="cancelQues" type="button"><i class="fa fa-sign-out"></i> Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div style="clear:both;margin-top:10px"></div>
                            <div class="col-sm-4" style="padding-left:0px;">
                            </div>
                            <div class="col-sm-offset-8" style="text-align:right">
                               <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveBtn" type="button">
                                    <span class="ladda-label">Save Module</span>
                               </button>
                               <?if($id == 0){?>
                                     <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveNewBtn" type="button">
                                        <span class="ladda-label">Save & New Module</span>
                                     </button>
                               <?}?>
                            </div>
                            </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="scripts/FormValidators/CreateQuestionValidations.js"></script>
<script src="scripts/FormValidators/CreateModuleValidations.js"></script> 
<script type="text/javascript">
    isDocumentLoaded = <?echo $isDocumentLoaded?> 
    optionsCount = 1;
    totalMarks = 0;
   
    $(document).ready(function(){        
        //display quiz module by default
        $(".quizEditor").show();
        $(".chosen-questionsSelect").chosen({width:"100%"});
       
        loadQuestion(); 
        CKEDITOR.replace( 'editor');
        
        <?$essay = str_replace("\r\n", "\\r\\n",$essay)?>
        CKEDITOR.instances.editor.setData("<?echo $essay?>");
        
        $("#saveBtn").click(function(e){
            ValidateAndSave(e,this);
        });
        $("#saveNewBtn").click(function(e){
            ValidateAndSave(e,this);
        });
        $("#saveNewQuesBtn").click(function(e){
            validateAndSaveQuestion(e,this);
        });
         $("#saveQuesBtn").click(function(e){
            validateAndSaveQuestion(e,this);
        });
        $('#moduleType').change(function(){
            $(".editorPanel").hide();
            $(".quizQuestionEditor").hide();
            $("."+this.value+"Editor").show();
        });
        $("#addNewQuestionButton").click(function(e){
            $(".quizQuestionEditor").show();
        });
        $("#cancelQues").click(function(e){
            $(".quizQuestionEditor").hide();
        });
        $("#moduleType").val("<?echo $moduleType?>").change(); 
        
        $("#addQuizQuestionOptionButton").click(function(e){
            ++optionsCount;
            rules = $("#createQuestionForm").jqxValidator('rules')
            optionName = "option" + optionsCount;  
            feedbackName = "feedback" + optionsCount; 
            marksName = "marks" + optionsCount; 
            option = '<div class="form-group animated fadeInDown" id="quizQuestionOption'+ optionsCount +'">';
            option += '<label class="col-sm-1 control-label">Option '+ optionsCount +'</label>' ;
            option += '<div class="col-sm-4"><input type="text" name="option[]" value="" id="'+ optionName + '" class="form-control"></div>';
            option += '<label class="col-sm-1 control-label">Feedback</label>';
            option += '<div class="col-sm-4"><input type="text" name="feedback[]" id="' + feedbackName + '" class="form-control"></div>';
            option += '<label class="col-sm-1 control-label">Marks</label>';
            option += '<div class="col-sm-1"><input type="text" name="marks[]" onchange="calTotalMarks(this.value)"  id="'+ marksName + '" class="form-control questionOptionMarksDiv">&nbsp;';
            option += '<button class="btn-xs btn-danger btn-circle" data-animation="fadeOut" class="removeQuizQuestionOptionButton" type="button" onclick="javascript:removeOption('+optionsCount+')"><i class="fa fa-times"></i></button>';
            option += '</div></div> ';
            $(".quizQuestionOptionsDiv").append(option);
            rules.push(
                { input: '#' + optionName , message: optionName + ' is required!', action: 'keyup', rule: 'required' },
                { input: '#' + marksName, message: 'Marks should be numeric!', action: 'keyup', rule: 'number' }
            );
            $('#createQuestionForm').jqxValidator('rules', rules);
        });
         $("#imgfileToUpload").change(function(){
            readIMG(this);
         });
         $("#fileToUpload").change(function(){
            setDocName(this);
         });

    });
    function resetQuestionForm(){
        $("#questionname").val("");
        $("#questionType")[0].selectedIndex = 0;
        $("#totalMarks").val("");
        $("#option1").val("");
        $("#feedback1").val("");
        $("#marks1").val("");
        for(var i =1;i<=optionsCount;i++){
            removeOption(i);      
        }
    }
    function calTotalMarks(value){
       
        var marks = 0;
        for(var i =1;i<=optionsCount;i++){
            val = $("#marks" + i).val();
            if(val  != "" && !isNaN(val)){
                 marks = marks + parseInt(val);    
            }           
        }
        $("#totalMarks").val(marks).change();
        
    }
    
    function checkValidation(input){
        requiredQuestion(input);
    }
    function readIMG(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#moduleImg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    } 
    function setDocName(input) {
        validateFile(input);
        if (input.files && input.files[0]) {
            name = input.files[0]["name"];  
            $('#lblFileUpload').html("Selected Document : - <a>" + name + "</a>");
        }
    }
    
    function removeOption(id){
       $("#quizQuestionOption"+id).remove();
       rules = $("#createQuestionForm").jqxValidator('rules')
       $updatedRules = [];
       $.each(rules, function(index , value){
            var inputName = value.input;
            var optionName = "#option" + id;
            var marksName = "#marks" + id;
            if(inputName != optionName && inputName != marksName){
                $updatedRules.push(value);    
            }
       });
       $('#createQuestionForm').jqxValidator('rules', $updatedRules);       
       optionsCount--;
    }
    
    function validateAndSaveQuestion(e,btn){
        var validationResult = function (isValid){
           if (isValid) {
               saveQuestion(e,btn);
            }
        }
       $('#createQuestionForm').jqxValidator('validate', validationResult);  
    }
    function saveQuestion(e,btn){
         var l = Ladda.create(btn);
        l.start();
        $('#createQuestionForm').ajaxSubmit(function( data ){
            l.stop();
            var obj = $.parseJSON(data);
            var dataRow = "";             
            if(obj.success == 1){
               selectAddedQuetion(obj.question);                  
            }else{
                showResponseNotification(data,"mainDiv","createQuestionForm"); 
            }
            if(btn.id == "saveQuesBtn"){
                if(obj.success == 1){;
                    resetQuestionForm();
                    $(".quizQuestionEditor").hide();                   
                }
            }else{
                showResponseNotification(data,"mainDiv","createQuestionForm");
            }

        })    
    }
    function loadQuestion(){
         url = "Actions/ModuleAction.php?call=getQuestions";
         $.getJSON(url, function(data){
            $.each(data, function(index , value){
                $('.chosen-questionsSelect').append("<option value='" + value.id+"'>"+value.title + "</option>");
            });
            $('.chosen-questionsSelect').trigger("chosen:updated"); 
            var values = "<?echo $selectedQuesSeqs?>";
            if(values.length > 0){
               // values = values.split(",");
                $('.chosen-questionsSelect').val(values).trigger("chosen:updated");
                
            }
        dragChosen();
        });
    }
    
    function selectAddedQuetion(question){
        var vals = [];
        $( '#questionsSelect :selected' ).each( function( i, selected ) {
            vals[i] = $( selected ).val();
        });
        $(".chosen-questionsSelect").chosen({width:"100%"});   
        vals.push(question.id);
        $('.chosen-questionsSelect').append("<option value='" + question.id+"'>" + question.title + "</option>");
        $('.chosen-questionsSelect').trigger("chosen:updated"); 
        $('.chosen-questionsSelect').val(vals).trigger("chosen:updated");
        dragChosen();  
    }
    
    function ValidateAndSave(e,btn){
       var validationResult = function (isValid){
           if (isValid) {
               saveModule(e,btn);
            }
        }
       $('#createModuleForm').jqxValidator('validate', validationResult);
    }
    function saveModule(e,btn){
        if(requiredEssay()){
            return;
        }
        var vals = [];
        //$( '#questionsSelect :selected' ).each( function( i, selected ) {
           // vals[i] = $( selected ).val();
        //});
        $('.search-choice').each(function(){
          var selectedText = $(this).find('span').text();
          var selectedValue = $('#questionsSelect').find('option[text="'+ selectedText +'"]').val();
          var selectedValue = $('#questionsSelect option').filter(function () {
                return $(this).html() ==  selectedText ; }).val();
          vals.push(selectedValue);
        })
        $("#selectedQuestions").val(vals);
        var editorData = CKEDITOR.instances.editor.getData();
        $("#eassy").val(editorData);
        var l = Ladda.create(btn);
        l.start();
        $('#createModuleForm').ajaxSubmit(function( data ){
            l.stop();
            var obj = $.parseJSON(data);
            var dataRow = "";
            if(btn.id == "saveBtn"){
                showResponseToastr(data,null,"createModuleForm","mainDiv");
                if(obj.success == 1){
                     window.setTimeout(function(){window.location.href = "adminModulesManagement.php"},500);
                }
            }else{
                showResponseNotification(data,"mainDiv","createModuleForm");
            }

        })    
    }

</script>