
$('#createLearningPlanForm').jqxValidator({
    hintType: 'label',
    animationDuration: 0,
    rules: [
       { input: '#name', message: 'Name is required!', action: 'keyup, blur', rule: 'required' },       
       { input: '#activationDate', message: 'Activation date is required!', action: 'keyup, blur', rule: function (input, commit) {
                return reuiredActiveDateIf(input);               
       }
       },
       { input: '#deactiveDate', message: 'Deactivation date is required!', action: 'keyup, blur', rule: function (input, commit) {
                return reuiredDeactiveDateIf(input);               
       }
       }
       ]
});
$("#createLearningPlanForm").on('validationSuccess', function () {
    $("#createLearningPlanForm-iframe").fadeIn('fast');
});
function reuiredActiveDateIf(input){
    var val = $("input:radio[name='actOption']:checked").val()
    if (val == "futureActive"){  
        if(input.val().length > 0){
            return true;    
        }else{
            return false;
        }
    }
    return true;
}
function reuiredDeactiveDateIf(input){
    if ($("#deactivateChk").is(":checked")){  
        if(input.val().length > 0){
            return true;    
        }else{
            return false;
        }
    }
    return true;
} 
