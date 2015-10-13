<?include("sessioncheck.php");?>
<html>
<head>
<title>Administrator | Settings</title>
<?include "ScriptsInclude.php"?>
<body class='default'>
    <div id="wrapper">
        <?include("adminMenu.php");?>
        <?include("CompnayFormInclude.php");?>
    </div>               
</body>
</html>
 
<script type="text/javascript">
$(document).ready(function(){ 
    $('#createCompanyForm').jqxValidator({
                hintType: 'label',
                animationDuration: 0,
                rules: [
                       { input: '#name', message: 'Company Name is required!', action: 'keyup, blur', rule: 'required' },
                       { input: '#email', message: 'Email is required!', action: 'keyup, blur', rule: 'required' },
                       { input: '#email', message: 'Invalid e-mail!', action: 'keyup', rule: 'email' },
                       { input: '#mobileno', message: 'Mobile no is required!', action: 'keyup', rule: 'required' },
                       { input: '#adminUserName', message: 'User Name is required!', action: 'keyup, blur', rule: 'required' },
                       { input: '#adminEmail', message: 'Email is required!', action: 'keyup, blur', rule: 'required' }, 
                       { input: '#adminPassword', message: 'Password is required!', action: 'keyup, blur', rule: 'required' },
                       { input: '#adminEmail', message: 'Invalid e-mail!', action: 'keyup, blur', rule: 'email' },
                       { input: '#adminMobile', message: 'Mobile is required!', action: 'keyup, blur', rule: 'required' }
                      
                       ]
            });
    $.getJSON("Actions/CompanyAction.php?call=getSettings" ,function(data){
        if(data.success == 1){
            var company = $.parseJSON(data.company);
            $("#name").val(company.name);
            $("#description").val(company.description); 
            $("#email").val(company.emailid); 
            $("#mobileno").val(company.mobileno); 
            $("#contactperson").val(company.contactperson); 
            $("#address").val(company.address); 
            $("#phone").val(company.phone);            
            
            var admin = $.parseJSON(data.admin);
            $("#adminName").val(admin.name);
            $("#adminUserName").val(admin.username); 
            $("#adminPassword").val(admin.password);
            $("#adminEmail").val(admin.emailid); 
            $("#adminMobile").val(admin.mobileno);   
        }else{
            toastr.error(data.messsage);
        }
    });
    
    $("#createButton").click(function(e){
        var btn = this;
        var validationResult = function (isValid) {
            if (isValid) {
                submitCreate(e,btn);
            }
        }
        $('#createCompanyForm').jqxValidator('validate', validationResult);
    })
});
function submitCreate(e,btn){
    var l = Ladda.create(btn);
    l.start();
    $formData = $("#createCompanyForm").serializeArray();
    $.get( "Actions/CompanyAction.php?call=saveCompany&isUpdate=true", $formData,function( data ){
        l.stop();
        showResponseToastr(data,null,null,"mainDiv");  
    }).always(function() { l.stop(); }); 
}    
</script>
