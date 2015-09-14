<?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php";?>
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
                            <form method="post" action="Actions/LearningPlanAction.php" id="createLearningPlanForm" class="form-horizontal">
                                <input type="hidden" id="id" name="id" value="<?echo $id?>">
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Name</label>
                                    <div class="col-sm-5"><input type="text" name="name" value="<?echo $name?>" id="name" class="form-control"></div>
                                    <label class="col-sm-1 control-label">Description</label>
                                    <div class="col-sm-5"><input type="text" name="name" value="<?echo $desc?>" id="name" class="form-control"></div>
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
                                    <div class="col-sm-2"><input type="text" name="name" value="<?echo $name?>" id="name" class="form-control"></div>
                                    <label class="col-sm-1 control-label">Prerequisities</label>
                                    <div class="col-sm-2"><input type="text" name="name" value="<?echo $desc?>" id="name" class="form-control"></div>
                                    <label class="col-xs-1 control-label">Tags</label>
                                    <div class="col-sm-2"><input type="text" name="name" value="<?echo $desc?>" id="name" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Max Marks</label>
                                    <div class="col-sm-2"><input type="text" name="name" value="<?echo $name?>" id="name" class="form-control"></div>
                                    <label class="col-sm-1 control-label">Pass %</label>
                                    <div class="col-sm-2"><input type="text" name="name" value="<?echo $name?>" id="name" class="form-control"></div>

                                    <label class="col-sm-1 control-label">Time Allwd.</label>
                                    <div class="col-sm-2"><input type="text" name="name" value="<?echo $desc?>" id="name" class="form-control"></div>
                                    <label class="col-sm-1 control-label">Image</label>
                                    <div class="col-sm-2"><input type="text" name="name" value="<?echo $desc?>" id="name" class="form-control"></div>
                                </div>



                                <div class="quizEditor editorPanel animated fadeInRight" style="display: none;">
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label">Questions</label>
                                        <div class="col-sm-9">
                                            <select class="form-control chosen-questionsSelect" name="questionsSelect[]" id="questionsSelect" multiple></select>
                                        </div>
                                        <button class="col-sm-1 btn-xs btn-success" id="addNewQuestionButton" type="button">Add New Question</button>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="quizQuestionEditor animated fadeInDown" style="display:none">
                                        <h4>Create New Question</h4>
                                        <div class="form-group">
                                            <label class="col-sm-1 control-label">Question</label>
                                            <div class="col-sm-9"><input type="text" name="name" value="<?echo $desc?>" id="name" class="form-control"></div>

                                            <label class="col-sm-1 control-label">Marks</label>
                                            <div class="col-sm-1"><input type="text" name="name" value="<?echo $desc?>" id="name" class="form-control" disabled="true"></div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-1 control-label">Option 1</label>
                                            <div class="col-sm-4"><input type="text" name="name" value="<?echo $desc?>" id="name" class="form-control"></div>

                                            <label class="col-sm-1 control-label">Feedback</label>
                                            <div class="col-sm-4"><input type="text" name="name" id="name" class="form-control"></div>

                                            <label class="col-sm-1 control-label">Marks</label>
                                            <div class="col-sm-1"><input type="text" name="name" id="name" class="form-control questionOptionMarksDiv"></div>
                                        </div>
                                        <div class="quizQuestionOptionsDiv animation_box"></div>

                                        <div class="form-group">
                                            <button class="col-sm-offset-1 col-sm-1 btn-xs btn-success" id="addQuizQuestionOptionButton" type="button"><i class="fa fa-plus"></i> Add Option</button>
                                            <div class="col-sm-offset-9">
                                                <button class="btn-xs btn-success" id="saveBtn" type="button"><i class="fa fa-save"></i> Save Question</button>
                                                <button class="btn-xs btn-success" id="saveBtn" type="button"><i class="fa fa-save"></i> Save & New Question</button>
                                                <button class="btn-xs btn-white" id="saveBtn" type="button"><i class="fa fa-sign-out"></i> Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="essayEditor editorPanel animated fadeInRight" style="display: none;">
                                    <h4>Create New Essay</h4>
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
                                           <input type="file">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                </div>
                                <div class="videoEditor editorPanel animated fadeInRight"  style="display: none;">
                                    <h4>Create New Video</h4>
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label">Embed Code</label>
                                        <div class="col-sm-11">
                                           <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                </div>
                                <div class="audioEditor editorPanel"  style="display: none;">
                                    <h4>Create New Audio</h4>
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label">Embed Code</label>
                                        <div class="col-sm-11">
                                           <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                </div>

                                  <div style="clear:both;margin-top:10px"></div>
                                  <div class="col-sm-4" style="padding-left:0px;">
                                  </div>
                                  <div class="col-sm-offset-8" style="text-align:right">
                                       <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveBtn" type="button">
                                            <span class="ladda-label">Save Module</span>
                                       </button>
                                        <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveNewBtn" type="button">
                                                <span class="ladda-label">Save & New Module</span>
                                        </button>
                                        <button type="button" class="btn btn-white" id="cancelBtn" data-dismiss="modal">Cancel Module</button>
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
        //display quiz module by default
        $(".quizEditor").show();
        $(".chosen-questionsSelect").chosen({width:"100%"});
        CKEDITOR.replace( 'editor');
        $("#saveBtn").click(function(e){
            ValidateAndSave(e,this);
        });

        $("#saveNewBtn").click(function(e){
            ValidateAndSave(e,this);
        });

        $('#moduleType').change(function(){
            $(".editorPanel").hide();
            $(".quizQuestionEditor").hide();
            $("."+this.value+"Editor").show();
        });
        $("#addNewQuestionButton").click(function(e){
            $(".quizQuestionEditor").show();
        });
        optionsCount = 1;
        $("#addQuizQuestionOptionButton").click(function(e){

            option = '<div class="form-group animated fadeInDown" id="quizQuestionOption'+ ++optionsCount +'">';
            option += '<label class="col-sm-1 control-label">Option '+ optionsCount +'</label>' ;
            option += '<div class="col-sm-4"><input type="text" name="name" value="<?echo $desc?>" id="name" class="form-control"></div>';
            option += '<label class="col-sm-1 control-label">Feedback</label>';
            option += '<div class="col-sm-4"><input type="text" name="name" id="name" class="form-control"></div>';
            option += '<label class="col-sm-1 control-label">Marks</label>';
            option += '<div class="col-sm-1"><input type="text" name="name" id="name" class="form-control questionOptionMarksDiv">&nbsp;';
            option += '<button class="btn-xs btn-danger btn-circle" data-animation="fadeOut" class="removeQuizQuestionOptionButton" type="button" onclick="javascript:removeOption('+optionsCount+')"><i class="fa fa-times"></i></button>';
            option += '</div></div> ';
            $(".quizQuestionOptionsDiv").append(option);
        });

    });
    function removeOption(id){
       $("#quizQuestionOption"+id).hide();
    }

</script>