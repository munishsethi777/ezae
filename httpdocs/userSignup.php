<?
    $cid = $_GET["cid"];
    $aid = $_GET["aid"];
    $lpfId = $_GET["lpfId"];
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
                <div class="ibox-title">
                    <div class="col-lg-offset-2" id="formHeader"></div>
                    
                </div>
                <div class="ibox-content mainDiv">
                    <form role="form" method="post" action="Actions/UserAction.php" id="SignupFieldForm" class="form-horizontal">
                        <input type="hidden" value="signup" name="call">
                        <input type="hidden" value="<?echo $cid?>" name="cid">
                        <input type="hidden" value="<?echo $aid?>" name="aid">
                        <input type="hidden" value="<?echo $lpfId?>" name="lpfId">
                        <div id="showSampleBlock">
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-lg-offset-3">
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
    var isValidate = false;
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
        if(isValidate){
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
                            window.setTimeout(function(){window.location.href = "userTrainings.php"},500);
                        }
                   })
                }
             }
             $('#SignupFieldForm').jqxValidator('validate', validationResult);    
        }
        
    }
     function getFieldHtml(label,name){
         var input =  '<div class="form-group">'; 
                      input += '<label class="col-sm-3 control-label">' + label + '</label>';
                      input += '<div class="col-sm-5">';
                      input += '<input type="text" id="'+  name + '" name="'+  name + '" placeholder="' + label + '"  class="form-control">';
                      input += '</div></div>';
                      return input;
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
                var emailfield = matchingRules.emailfield; 
                var datefieldIds = [];
                 if(usernamefield == null){
                     formHtml = getFieldHtml("UserName","default_username");
                    var rule = { input: '#default_username', message:'Username is required!', action: 'keyup, blur', rule: 'required'};
                           validationRules.push(rule);
                           hasValidation = true; 
                 }
                 
                 if(emailfield == null){
                     formHtml += getFieldHtml("Email","default_email");  
                      var rule = { input: '#default_email', message:'Email is required!', action: 'keyup, blur', rule: 'required'};
                           validationRules.push(rule);
                           hasValidation = true; 
                 }
                 $.each(fields, function(id,fieldobj){
                    var inputs = fieldobj;
                    var show = inputs[7];
                    if(show == 1){
                        var fieldName = inputs[3];
                        var name = inputs[4];
                        var type = inputs[5];
                        fieldType = type;
                        var label = name;
                        var id = fieldName;
                        var isUsernameField = false;
                        var userNameErrLbl = "";
                        icon = "";
                        if(fieldName == usernamefield){
                            label += " (UserName)";
                            isUsernameField = true;
                        }
                        if(fieldName == passwordfield){
                            label += " (Password)";
                        }
                        if(fieldName == usernamefield && fieldName == passwordfield){
                            label = name;
                            label += " (UserName,Password)";
                        }
                        var required = inputs[6];
                        var input =  '<div class="form-group">';
                            input += '<label class="col-sm-3 control-label">' + label + '</label>';
                            input += '<div class="col-sm-5">';
                            fieldType = 'text';
                            className = 'form-control';
                            if(type == 'Yes/No' || type =="boolean"){
                                 fieldType = 'checkbox';
                                 className = "";
                            }
                            
                            if(type == "Dropdown"){
                                dropdown = '<select id="'+  id + '" name="'+  fieldName + '" class="' + className + '">';
                                pValues = fieldobj.possiblevalues;
                                pValues = pValues.split(/\n/);
                                $.each(pValues, function(optVal,optText){
                                    dropdown += '<option value="'+ optText + '">' + optText + '</option>';     
                                });
                                dropdown += '</select>';                                
                                input += dropdown;
                            }else{
                                var focusOut = "";
                                if(isUsernameField){
                                   focusOut = "onfocusout='checkDuplicateUserName(this.id)'";
                                   userNameErrLbl = '<label id="'+  id + 'lbl" class="jqx-validator-error-label" style="position: relative; left: 0px; width: 466px; top: 2px;"></label>';
                                   icon = '<span id="iconspan" style="color:green;display:none">Available <i class="fa fa-check-circle style="color:green"></i></span>';
                                }
                                input += '<input type="' + fieldType + '" id="'+  id + '" name="'+  fieldName + '" ' + focusOut +  '  placeholder="' + name + '"  class="' + className + '">';
                                input += icon;
                                input += userNameErrLbl;
                            }
                            
                            input += '</div></div>';
                       formHtml += input;
                       if(type == "Date"){
                           datefieldIds.push(name);
                       }
                       if(required == 1 || fieldName == usernamefield || fieldName == passwordfield){
                           var rule = { input: '#' + id, message: name + ' is required!', action: 'keyup, blur', rule: 'required'};
                           validationRules.push(rule);
                           hasValidation = true;
                       }
                       if(type == "Numeric"){
                           var rule = { input: '#' + id, message:'Numeric only !', action: 'keyup, blur', rule: 'number'};
                           validationRules.push(rule);
                           hasValidation = true;
                       }
                       if(type == "email"){
                           var rule = { input: '#' + id, message:'Invalid Email !', action: 'keyup, blur', rule: 'email'};
                           validationRules.push(rule);
                           hasValidation = true;
                       }
                    }    
                 });
                $("#formHeader").html(header);
                if(passwordfield == null){
                     formHtml += getFieldHtml("Password","default_password"); 
                      var rule = { input: '#default_password', message:'Password is required!', action: 'keyup, blur', rule: 'required'};
                           validationRules.push(rule);
                           hasValidation = true; 
                 }
                $("#showSampleBlock").html(formHtml);
                generateDateType(datefieldIds);
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
    
    function checkDuplicateUserName(id){
        var name = $("#"+id).val();
        $("#"+id+"lbl").text("");
        $("#iconspan").hide();
        if(name) {
            var url = 'Actions/UserAction.php?call=isUserNameExist&username='+name;
            $.getJSON(url, function(data){
                if(data.isExist == 1){
                    $("#"+id+"lbl").html('UserName Already Exists!');
                    isValidate = false;
                } else{
                    $("#iconspan").show();
                    isValidate = true;
                }
            });
        }
    }
    function generateDateType(fieldIds){
         $.each(fieldIds, function(id,value){
            $('#' + value).datetimepicker({step:5,format:"m/d/Y h:i A"});
         });
    }
</script>
