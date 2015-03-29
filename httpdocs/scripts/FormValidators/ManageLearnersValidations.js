
$('#customFieldForm').jqxValidator({
    hintType: 'label',
    animationDuration: 0,
    rules: [
       { input: '#username', message: 'User Name is required!', action: 'keyup, blur', rule: 'required' },
       { input: '#password', message: 'password Name is required!', action: 'keyup, blur', rule: function (input, commit) {
                return reuiredIf(input);               
           } 
       },
       { input: '#confirmPassword', message: 'Confirm Password is required!', action: 'keyup, blur', rule: function (input, commit) {
                return reuiredIf(input);               
           }
       },
       { input: '#confirmPassword', message: 'Confirm Password doesn\'t match!', action: 'keyup, focus', rule: function (input, commit) {
               if(isCheckValidtion()){
                   if (input.val() === $('#password').val()) {
                        return true;
                   }
                   return false;       
               }
               return true;
               
           }
       },
       { input: '#emailid', message: 'Email Name is required!', action: 'keyup, blur', rule: 'required' },
       { input: '#emailid', message: 'Invalid e-mail!', action: 'keyup', rule: 'email' },
       ]
});
$("#customFieldForm").on('validationSuccess', function () {
    $("#customFieldForm-iframe").fadeIn('fast');
});
function isCheckValidtion(){
    if ($("#isChangePassword").is(":checked") || $("#id").val() == "0"){
        return true;
    }return false;
}
function reuiredIf(input){
    if(isCheckValidtion()){
        if(input.val().length > 0){
            return true;    
        }return false   
    }
    return true;
}