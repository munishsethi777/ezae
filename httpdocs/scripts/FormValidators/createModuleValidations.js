$('#createModuleForm').jqxValidator({
    hintType: 'label',
    animationDuration: 0,
    rules: [
       { input: '#name', message: 'Module Name is required!', action: 'keyup, blur', rule: 'required' },
       { input: '#vembedCode', message: 'Video embed code!', action: 'keyup, blur', rule: function (input, commit) {
                return reuiredIf(input);}
       },
       { input: '#aembedCode', message: 'Audio embed code!', action: 'keyup, blur', rule: function (input, commit) {
                return reuiredIf(input);}
       },
       { input: '#questionsSelect', message: 'Select atleast one question!', action: 'keyup, blur', rule: function (input, commit) {
                return requiredQuestion(input);}
       },
       {input: '#fileToUpload', message: 'Select Document!', action: 'keyup, blur',rule: function (input, commit) {
                    return validateFile(input);
                }
       }
       ]
       
});
$("#createModuleForm").on('validationSuccess', function () {
    $("#createQuestionForm-iframe").fadeIn('fast');
});
function validateFile(input){
     var val = $("#moduleType").val(); 
      if(val == "document"){
        val = input[0].value;
        if(val != ""){
            return true;
        }
        return false;
       }return true;
}
function reuiredVideoIf(input){
    var val = $("#moduleType").val(); 
    if(val == "video"){
        if(input.val().length > 0){
            return true;    
        }return false   
    }
    return true;
}
function reuiredIf(input){
    var val = $("#moduleType").val(); 
    if(val == "audio"){
        if($("#aembedCode").val() != ""){
            return true;    
        }return false   
    }
    if(val == "video"){
        if($("#vembedCode").val() != ""){
            return true;    
        }return false   
    }
    return true;
}

function requiredQuestion(input){
    var val = $("#moduleType").val();
    if(val == "quiz"){
        var selectInput = input[0];
        if(selectInput.selectedOptions == undefined){
          selectInput = input;  
        }
        if(selectInput.selectedOptions.length > 0){
            $("#questionError").text("");
            $(".hilight").removeClass("hilight");
            return true;           
        }    
        $("#questionsSelect_chosen").addClass("hilight");
        $("#questionError").text("Select atleast one question!");
        return false;
    }
    return true;
}
function requiredEssay(){
    var val = $("#moduleType").val();
    if(val == "essay"){
         var editorData = CKEDITOR.instances.editor.getData();
         if(editorData == ""){
             toastr.error("Please create essay",'Failed');
             return true
         }
         return false;
    }
}