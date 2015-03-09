<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administration - Easy Assessment Engine</title>

        <link href="styles/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="styles/animate.css" rel="stylesheet">
        <link href="styles/style.css" rel="stylesheet">


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
                $.get( "ajaxAdminMgr.php?call=loginAdmin", $formData,function( data ){
                    if(data == 0){
                        alert("Invaid username or Password");
                    }else{
                        window.location = "dashboard.php";
                    }
                });
            }
            </script>
    </head>
<body class="gray-bg">
<div class="loginColumns animated fadeInDown">
    <div class="row">
        <div class="col-md-6">
                <h1 class="font-bold">Welcome to EZAE Administration area</h1>

                <p>
                    Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                </p>

                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                </p>

                <p>
                    <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
                </p>

            </div>
        <div class="col-md-6">
            <div class="ibox-content">
                <?php echo($div) ?>
                <form class="form-horizontal" id="loginForm" method="POST" name="loginForm">
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
                        <input type="button" id = "loginButton" class="btn btn-primary block full-width m-b" value="Login"/>
                    </div>
                  </div>
                </form>
                <a href="forgotPassword.php">Forgot Password</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>


