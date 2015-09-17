$('#createQuestionForm').jqxValidator({
    hintType: 'label',
    animationDuration: 0,
    rules: [
       { input: '#questionname', message: 'Question is required!', action: 'keyup, blur', rule: 'required' }
       ]
});
$("#createQuestionForm").on('validationSuccess', function () {
    $("#createQuestionForm-iframe").fadeIn('fast');
});