<?require("sessionCheckForUser.php");?>  
<html>
<head>
<title>Administrator | Change Password</title>
<?include "ScriptsInclude.php"?>
<body class='default'>
    <div id="wrapper">
        <?include("userMenu.php");?>
        <div class="adminSingup animated fadeInRight" >
            <div class="bb-alert alert alert-info" style="display:none;">
                <span>The examples populate this alert with dummy content</span>
            </div>
            <div class="ibox-content mainDiv"> 
                <div class="row">                 
                     <div class="col-sm-12">                                                           
                        <div class="col-sm-6"><h3 class="m-t-none m-b">Change Password</h3> 
                            <form role="form" method="post" id="changePasswordForm" action = "Actions/UserAction.php">
                                <input type="hidden" id ="call" name="call" value="changePassword"/>
                                <div class="form-group"><label>Current Password</label> 
                                    <input type="password" id="earlierPassword" name="earlierPassword" class="form-control">
                                </div>
                                <div class="form-group"><label>New Password</label> 
                                    <input type="password" id="newPassword" name="newPassword" class="form-control">
                                </div>
                                <div class="form-group"><label>Confirm Password</label>
                                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control">
                                </div>
                                <div>
                                     <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveBtn" type="button">
                                        <span class="ladda-label">Save</span>
                                    </button>
                               </div>                               
                            </form>
                        </div>                        
                     </div>
                </div>
            </div>
        </div> 
    </div>               
</body>
</html>
 <script src="scripts/FormValidators/ChangePasswordValidations.js"></script> 
<script type="text/javascript">
$(document).ready(function(){ 
    $("#saveBtn").click(function(e){
        var btn = this;
        var validationResult = function (isValid) {
            if (isValid) {
                changePassword(e,btn);
            }
        }
        $('#changePasswordForm').jqxValidator('validate', validationResult);   
    })
});
function changePassword(e,btn){
    e.preventDefault();
    var l = Ladda.create(btn);
    l.start();
    $('#changePasswordForm').ajaxSubmit(function( data ){
        l.stop();
        showResponseToastr(data,null,"changePasswordForm","mainDiv");
    })
} 
</script>

