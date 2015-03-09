<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="jqwidgets/styles/jqx.arctic.css" type="text/css" />
        <link type="text/css" href="styles/bootstrap.css" rel="stylesheet" />

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

        <script type="text/javascript">
            $(document).ready(function () {
                //$('.form-control').jqxInput({  });
                $('#loginForm').jqxValidator({
                    rules: [
                           { input: '#usernameInput', message: 'UserName is required!', action: 'keyup, blur', rule: 'required' },
                           { input: '#usernameInput', message: 'UserName must be less than 250 characters!', action: 'keyup, blur', rule: 'length=0,250' },

                           { input: '#passwordInput', message: 'Password is required!', action: 'keyup, blur', rule: 'required' },
                           { input: '#passwordInput', message: 'Password must be less than 250 characters!', action: 'keyup, blur', rule: 'length=0,250' },
                           ]
                });
                //$("#loginForm").submit(function(e){
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
                $(".errorMessage").removeClass('bg-danger');
                $(".errorMessage").addClass("bg-success");
                $(".errorMessage").html("<img src = 'images/loading.gif'> Trying to login...");
                $(".loadingDiv").show();
                $formData = $("#loginForm").serializeArray();
                $.get( "ajaxUsersMgr.php?call=loginUser", $formData,function( data ){
                    if(data == 0){
                        $(".errorMessage").addClass("bg-danger");
                        $(".errorMessage").html("Invaid username or Password");
                        $(".loadingDiv").hide();
                    }else{
                        window.location = "userModules.php";
                    }
                });
            }
            </script>
    </head>
<body>

<div style="width:600px;margin:50px auto;padding:20px;border:1px silver solid">
    <center>
    <p style="margin:10px 0px 20px 0px;">
        <h4 style="padding:0px;">Welcome to JCB E learning program</h4>
    </p>
    <p class="errorMessage" style="line-height:34px;"></p>
    </center><br>
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
        <div class="col-sm-offset-6 col-sm-6">
          <input type="button" id = "loginButton" class="btn btn-default" value = "Login" style="width:100px"/>
        </div>
      </div>
      <a href="contact.php" target="new">Contact Support</a>
    </form>
 </div>
</body>
</html>


