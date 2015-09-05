<?
    $cid = $_GET["cid"];
    $aid = $_GET["aid"];
?>
<html>
<head>
<?include "ScriptsInclude.php"?>
<?

?>
<!-- iCheck -->
<link href="styles/plugins/iCheck/custom.css" rel="stylesheet">


</head>
<body class='default'>
<div id="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" id="formHeader">
                    
                </div>
                <div class="ibox-content mainDiv">
                    <form role="form" method="post" action="Actions/UserAction.php" id="SignupFieldForm" class="form-horizontal">
                        <input type="hidden" value="signup" name="call">
                        <input type="hidden" value="<?echo $cid?>" name="cid">
                        <input type="hidden" value="<?echo $aid?>" name="aid">
                        <div id="showSampleBlock">
                        </div>
                        <div class="row">
                            <div class="col-sm-10">
                                <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveBtn" type="button">
                                <span class="ladda-label">Sign up</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script src="scripts/plugins/pace/pace.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        loadForm();
        $("#saveBtn").click(function(e){
            saveSignupfields(e,this);
        })
        $("#showSampleFormBtn").click(function(e){
            showSampleForm(e,this);
        })
        $('.summernote').summernote();

        $("#showSampleSaveBtn").click(function(e){
            var validationResult = function (isValid){
                if (isValid) {
                    alert("Success");
                }
            }
            $('#SignupFieldForm').jqxValidator('validate', validationResult);
        });
    })
    var edit = function() {
            $('.click2edit').summernote({focus: true});
        };
    var save = function() {
        var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
        $('.click2edit').destroy();
    };



    function saveSignupfields(e,btn){
        e.preventDefault();
        var l = Ladda.create(btn);                
         var validationResult = function (isValid){
            if (isValid) {
               l.start();
               $('#SignupFieldForm').ajaxSubmit(function( data ){
                    var obj = $.parseJSON(data);
                    showResponseNotification(data,"mainDiv","SignupFieldForm");
                    l.stop();
                    if(obj.success == 1){
                        window.setTimeout(function(){window.location.href = "UserDashboard.php"},500);
                    }
               })
            }
         }
         $('#SignupFieldForm').jqxValidator('validate', validationResult);
    }

    function loadForm(){
        var url = 'Actions/SignupFormAction.php?call=getSignupFormFields&aid=<?echo $aid;?>&cid=<?echo $cid;?>';
        $.get(url, function(data){
            var obj = $.parseJSON(data);
            var validationRules = [];
                formHtml = "";
                var fields = obj.fields;  
                var header = obj.headerText;
                var matchingRules = obj.matchingrule;
                var usernamefield = matchingRules.usernamefield;
                var passwordfield = matchingRules.passwordfield;
                 $.each(fields, function(id,fieldobj){
                    var inputs = fieldobj;
                    var show = inputs[6];
                    if(show == 1){
                        var name = inputs[3];
                        var type = inputs[4];
                        var label = name;
                        var id = name;
                        if(name == usernamefield){
                            label += " (UserName)";
                           
                        }
                        if(name == passwordfield){
                            label += " (Password)";
                                                   }
                        if(name == usernamefield && name == passwordfield){
                            label = name;
                            label += " (UserName,Password)";
                        }
                        var required = inputs[5];
                        var input =  '<div class="form-group">';
                            input += '<label class="col-sm-3 control-label">' + label + '</label>';
                            input += '<div class="col-sm-5">';
                            if(type == 'string' || type == 'numeric' || type == 'Text'){
                                 type = 'text';
                            }
                            input += '<input type="' + type + '" id="'+  id + '" name="'+  name + '" placeholder="' + name + '" class="form-control">';
                            input += '</div></div>';
                       formHtml += input;
                       
                       if(required == 1 || name == usernamefield || name == passwordfield){
                           var rule = { input: '#' + id, message: name + ' is required!', action: 'keyup, blur', rule: 'required'};
                           validationRules.push(rule);
                           hasValidation = true;
                       }
                    }    
                 });
                $("#formHeader").html(header);
                $("#showSampleBlock").html(formHtml);
                $('#SignupFieldForm').jqxValidator({
                    hintType: 'label',
                    animationDuration: 0,
                    rules:validationRules
                    });
                    $("#SignupFieldForm").on('validationSuccess', function () {
                        $("#SignupFieldForm-iframe").fadeIn('fast');
                });        
            });
    }

</script>
