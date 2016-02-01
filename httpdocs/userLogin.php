 <?include "ScriptsInclude.php"?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administration - Easy Assessment Engine</title>

        <script type="text/javascript">
            $(document).ready(function () {
                //$('.form-control').jqxInput({  });
                $('#userLoginForm').jqxValidator({
                    rules: [
                           { input: '#usernameInput', message: 'UserName is required!', action: 'keyup, blur', rule: 'required' },
                           { input: '#usernameInput', message: 'UserName must be less than 250 characters!', action: 'keyup, blur', rule: 'length=0,250' },

                           { input: '#passwordInput', message: 'Password is required!', action: 'keyup, blur', rule: 'required' },
                           { input: '#passwordInput', message: 'Password must be less than 250 characters!', action: 'keyup, blur', rule: 'length=0,250' },
                           ]
                });
                //$('#loginButton').jqxButton({ width: 100, height: 25 });

                $("#loginButton").click(function (e) {
                    var btn = this;
                    validateAndSave(e,btn);
                });
                $("#userLoginForm").on('validationSuccess', function () {
                    $("#userLoginForm-iframe").fadeIn('fast');
                });
                $('#usernameInput').keypress(function (e) {
                    btn = $("#loginButton")[0];
                    if (e.which == 13) {
                        validateAndSave(e,btn);
                        return false;
                    }
                })
                $('#passwordInput').keypress(function (e) {
                    btn = $("#loginButton")[0];
                    if (e.which == 13) {
                        validateAndSave(e,btn);
                        return false;
                    }
                })
            });
            function validateAndSave(e,btn){


                    var validationResult = function (isValid) {
                        if (isValid) {
                            submitLogin(e,btn);
                        }
                    }
                    $('#userLoginForm').jqxValidator('validate', validationResult);
            }
            function submitLogin(e,btn){
                e.preventDefault();
                var l = Ladda.create(btn);
                l.start();
                $('#userLoginForm').ajaxSubmit(function( data ){
                      l.stop();
                      var obj = $.parseJSON(data);
                      if(obj.success == 1){
                            window.location = "userTrainings.php";
                      } else{
                          showResponseNotification(data,"mainDiv","userLoginForm");
                      }
                });
            }
         </script>
    </head>
<body class="gray-bg">
<div class="loginColumns animated fadeInDown">
    <div class="row">
        <div class="col-md-6">
                <h1 class="font-bold">Welcome to EZAE</h1>
            </div>
        <div class="col-md-6">
            <div class="ibox-content mainDiv">
                <form class="form-horizontal" action="Actions\UserAction.php" id="userLoginForm" method="POST" name="loginForm">
                  <input type="hidden" name="call" id="call" value="loginUser">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-9">
                      <input type="text" name="username" class="form-control input-lg" id="usernameInput">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                      <input type="password" name="password" class="form-control input-lg" id="passwordInput">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button class="btn btn-primary ladda-button" data-style="expand-right" id="loginButton" type="button">
                            <span class="ladda-label">Login</span>
                        </button>
                    </div>
                  </div>
                </form>
                <a href="forgotUserPassword.php">Forgot Password</a><br/>
                <a href="userContactUs.php">Contact Us</a><br/>
            </div>
        </div>

    </div>
</div>

</body>
</html>


