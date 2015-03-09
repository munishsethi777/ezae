<?php
    require_once('IConstants.inc');
    require_once($ConstantsArray['dbServerUrl'] ."Managers/AdminMgr.php");
?>
<?include("userMenu.php");?>
<head>
    <link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
    <link rel="stylesheet" href="jqwidgets/styles/jqx.arctic.css" type="text/css" />
    <script type="text/javascript" src="scripts/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxexpander.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxvalidator.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="jqwidgets/globalization/globalize.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxcalendar.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxdatetimeinput.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxmaskedinput.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxinput.js"></script>
    <link type="text/css" href="styles/bootstrap.css" rel="stylesheet" />

<script type="text/javascript">
$(document).ready(function () {
    $('.input-lg').jqxInput({  });
    $('#changePasswordForm').jqxValidator({
    rules: [
           { input: '#currentPasswordInput', message: 'Current Password is required!', action: 'keyup, blur', rule: 'required' },
           { input: '#currentPasswordInput', message: 'Value must be less than 56 characters!', action: 'keyup, blur', rule: 'length=0,56' },

           { input: '#newPasswordInput', message: 'New Password is required!', action: 'keyup, blur', rule: 'required' },
           { input: '#newPasswordInput', message: 'Value must be less than 56 characters!', action: 'keyup, blur', rule: 'length=0,56' },

           { input: '#confirmPasswordInput', message: 'Confirm Password is required!', action: 'keyup, blur', rule: 'required' },
           { input: '#confirmPasswordInput', message: 'Value must be less than 56 characters!', action: 'keyup, blur', rule: 'length=0,56' },
           ]
    });
    $('#changePasswordButton').jqxButton({ width: 100, height: 25 });
    $("#changePasswordButton").click(function () {
        var validationResult = function (isValid) {
            if (isValid) {
                submitRegisteration();
            }
        }
        $('#changePasswordForm').jqxValidator('validate', validationResult);
    });
    $("#changePasswordForm").on('validationSuccess', function () {
        $("#changePasswordForm-iframe").fadeIn('fast');
    });
});

function submitChangePassword(){
    $formData = $(".changePasswordForm").serializeArray();
    $.get( "ajaxUsersMgr.php?action=changeUserPassword", $formData,function( data ){
        $('#changePasswordForm')[0].reset();
    });
}
</script>
</head>
<body class='default'>
    <div style="width:500px;margin:50px auto;padding:20px;border:1px silver solid">
    <form class="form-horizontal" id="changePasswordForm" method="POST" name="changePasswordForm">
      <div class="form-group">
        <label class="col-sm-4 control-label">Current Password</label>
        <div class="col-sm-8">
          <input type="text" name="currentPassword" class="form-control input-lg" id="currentPasswordInput">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-4 control-label">New Password</label>
        <div class="col-sm-8">
          <input type="password" name="newPassword" class="form-control input-lg" id="newPasswordInput">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-4 control-label">Confirm New Password</label>
        <div class="col-sm-8">
          <input type="password" name="confirmPassword" class="form-control input-lg" id="confirmPasswordInput">
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <input type="button" id = "changePasswordButton" class="btn btn-default" value = "Change Password"/>
        </div>
      </div>
    </form>
    <a href="forgotPassword.php">Forgot Password</a>
 </div>
</body>