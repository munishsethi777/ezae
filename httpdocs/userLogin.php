<!DOCTYPE html>
<html>
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
                $('.form-control').jqxInput({  });
                $('#loginForm').jqxValidator({
                    rules: [
                           { input: '#usernameInput', message: 'UserName is required!', action: 'keyup, blur', rule: 'required' },
                           { input: '#usernameInput', message: 'UserName must be less than 250 characters!', action: 'keyup, blur', rule: 'length=0,250' },

                           { input: '#passwordInput', message: 'Password is required!', action: 'keyup, blur', rule: 'required' },
                           { input: '#passwordInput', message: 'Password must be less than 250 characters!', action: 'keyup, blur', rule: 'length=0,250' },
                           ]
                });
                //$('#loginButton').jqxButton({ width: 100, height: 25 });
                $("#loginButton").click(function () {
                    var validationResult = function (isValid) {
                        if (isValid) {
                            submitLogin();
                        }
                    }
                    $('#loginForm').jqxValidator('validate', validationResult);
                });
                $("#loginForm").on('validationSuccess', function () {
                    $("#loginForm-iframe").fadeIn('fast');
                });
            });

            function submitLogin(){
                $formData = $("#loginForm").serializeArray();
                $.get( "ajaxUsersMgr.php?call=loginUser", $formData,function( data ){
                    if(data == 0){
                        alert("Invaid username or Password");
                    }else{
                        window.location = "userHome.php";
                    }
                });
            }
            </script>
    </head>
<body>

<div style="width:600px;margin:50px auto;padding:20px;border:1px silver solid">
    <p style="margin:20px 0px 20px 0px">
        Welcome to USHA international E learning program on APO If you are not an USHA employee, please close this page
    </p>
    <form class="form-horizontal" id="loginForm" method="POST" name="loginForm">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-6 control-label">Employee Id</label>
        <div class="col-sm-6">
          <input type="text" name="username" class="form-control input-lg" id="usernameInput">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-6  control-label">Date of Birth DDMMYYYY
        <br><font style="font-weight:normal">Eg. If your DOB is 23rd August 1978 Please input 23081978</font></label>
        <div class="col-sm-6">
          <input type="password" name="password" class="form-control input-lg" id="passwordInput">
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <input type="button" id = "loginButton" class="btn btn-default" value = "Login"/>
        </div>
      </div>
    </form>
    <a href="forgotPassword.php">Forgot Password</a>
 </div>
</body>
</html>


