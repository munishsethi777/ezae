<?include("sessionCheckForUser.php");?>
<html>
<head>
<title>Administrator | Settings</title>
<?include "ScriptsInclude.php"?>
<body class='default'>
    <div id="wrapper">
        <?include("userMenu.php");?>
        <?include("UserForm.php");?>
    </div>               
</body>
</html>
 
<script type="text/javascript">
$(document).ready(function(){ 
    loadFormFields();
    //$.getJSON("Actions/CompanyAction.php?call=getSettings" ,function(data){
//        if(data.success == 1){
//            var company = $.parseJSON(data.company);
//            $("#name").val(company.name);
//            $("#description").val(company.description); 
//            $("#email").val(company.emailid); 
//            $("#mobileno").val(company.mobileno); 
//            $("#contactperson").val(company.contactperson); 
//            $("#address").val(company.address); 
//            $("#phone").val(company.phone);            
//            
//            var admin = $.parseJSON(data.admin);
//            $("#adminName").val(admin.name);
//            $("#adminUserName").val(admin.username); 
//            $("#adminPassword").val(admin.password);
//            $("#adminEmail").val(admin.emailid); 
//            $("#adminMobile").val(admin.mobileno);   
//        }else{
//            toastr.error(data.messsage);
//        }
//    });
    
    $("#createButton").click(function(e){
        submitCreate(e,this);
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

