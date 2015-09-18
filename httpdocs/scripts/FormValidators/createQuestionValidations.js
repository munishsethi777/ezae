$('#createQuestionForm').jqxValidator({
    hintType: 'label',
    animationDuration: 0,
    rules: [
       { input: '#questionname', message: 'Question is required!', action: 'keyup, blur', rule: 'required' },
       { input: '#option1', message: 'Option1 Name is required!', action: 'keyup, blur', rule: 'required' },
       { input: '#marks1', message: 'Marks should be numeric!', action: 'keyup', rule: 'number' }, 
       { input: '#totalMarks', message: 'Marks should be greater than 0!', action: 'keyup, blur', rule: 'required' },
       { input: '#totalMarks', message: 'Marks should be greater than 0!', action: 'keyup', rule: function (input, commit) {
                return totalMarksValidate(input);}
       },
          
       ]
});
function totalMarksValidate(input){
    if(input.val().length > 0){
        if(input.val() > 0){
           return true;   
        } 
        return false   
    }   
    return false;
}
$("#createQuestionForm").on('validationSuccess', function () {
    $("#createQuestionForm-iframe").fadeIn('fast');
});

