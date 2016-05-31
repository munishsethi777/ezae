<?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php"?>

<!-- iCheck -->
<link href="styles/plugins/iCheck/custom.css" rel="stylesheet">


</head>
<body class='default'>
    <div id="wrapper wrapper-content animated fadeInRight">
        <?include("adminMenu.php");?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Manage Learner's registration form settings</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a>Learners</a>
                    </li>
                    <li class="active">
                        <strong>Manage Registration Form</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row wrapper-content">
            <h3>Please copy the following url for learner's signup</h3>
            <span style="font-size:14px" class="label label-primary signupURL">www.ezae.in/v2/usersignup.php?cid=1 </span>
            <span style="color: red;" id="bindingMsgDiv"></span>
        </div>
        <h4>Sign Up Form Header : - </h4>
        <div class="ibox-content no-padding">
             
            <div class="summernote">
                
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeIn mainDiv">
            <p>You may drag and drop various field sections to maintain the sequance of registration form fields.</p>
            <form role="form"  method="post" action="Actions/SignupFormAction.php" id="SignupFieldForm" class="form-horizontal">
                <input type="hidden" name="headerText" id="headerText"/>
                <input type="hidden" value="saveSignupFormFields" name="call">
                <div class="col-lg-12" id="customFieldsBlock">

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveBtn" type="button">
                        <span class="ladda-label">Save</span></button>
                        <button class="btn btn-primary ladda-button" data-style="expand-right" id="showSampleFormBtn" type="button">
                        <span class="ladda-label">Show Sample Form</span></button>
                    </div>
                </div>
            </form>
              <div id="showSampleModalForm" class="modal fade" aria-hidden="true">
                  <div class="modal-dialog" >
                      <div class="modal-content">
                          <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">Sign in</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row" >

                                  <div class="col-sm-12">
                                    <div id="formHeader"></div>
                                    <form role="form" method="post" id="showSampleForm" class="form-horizontal">
                                        <div id="showSampleBlock">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary ladda-button" data-style="expand-right" id="showSampleSaveBtn" type="button">
                                                <span class="ladda-label">Save</span>
                                            </button>
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
        </div> 
</body>
</html>


<script type="text/javascript">
    $(document).ready(function(){

        
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
            $('#showSampleForm').jqxValidator('validate', validationResult);
        });
        //enable draggable components
        WinMove();
        loadFieldBlocks();
        loadSignupURL();
        checkBindingCompleted();

    })
    var edit = function() {
            $('.click2edit').summernote({focus: true});
        };
    var save = function() {
        var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
        $('.click2edit').destroy();
    };
    function checkBindingCompleted(){
         var url = 'Actions/CustomFieldAction.php?call=isBindingCompleted';
            $.getJSON(url, function(data){
                //$("#bindingMsgDiv").html(data.message);    
           });
    }
    function loadSignupURL(){
        var url = 'Actions/CompanyAction.php?call=getSignupFormURL';
        $.get(url, function(data){
            $(".signupURL").html(data);
        });
    }
    function loadFieldBlocks(){
        var url = 'ajaxAdminMgr.php?call=getLearnersFieldsForFormManagement';
        $.get(url, function(data){
            var obj = $.parseJSON(data);
            $("#customFieldsBlock").append(obj.html);
            $(".summernote").code(obj.headerText);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green'
            })
        });
    }

    function saveSignupfields(e,btn){
        e.preventDefault();
        $("#headerText").val($('.summernote').code());
        var l = Ladda.create(btn);
        l.start();
        $('#SignupFieldForm').ajaxSubmit(function( data ){
            l.stop();
            showResponseNotification(data,"mainDiv","#SignupFieldForm");
        })
    }

    function showSampleForm(e,btn){
        var divs = $("#customFieldsBlock").find("div.ibox:not(div.ibox div.ibox)")
        var formHtml = "";
        var validationRules = [];
        var datefieldIds = [];
        $.each(divs, function(key,value){
            var div = value;
            var inputs = $("#" + div.id).find("input");
            var show = inputs[6].checked;
            if(show){
                var name = inputs[1].value;
                var type = inputs[2].value;
                var acutalName = inputs[3].value;
                var pValues = inputs[4].value;
                fieldType = type;
                var id = acutalName;
                var required = inputs[5].checked;
                var input =  '<div class="form-group">';
                    input += '<label class="col-sm-3 control-label">' + name + '</label>';
                    input += '<div class="col-sm-9">';
                    fieldType = 'text';
                    className = 'form-control';
                    if(type == 'Yes/No' || type =="boolean"){
                         fieldType = 'checkbox';
                         className = "";
                    }
                    if(type == "Dropdown"){
                        dropdown = '<select id="'+  id + '" name="'+  acutalName + '" class="' + className + '">';
                        pValues = pValues.split(/\n/);
                        $.each(pValues, function(optVal,optText){
                            dropdown += '<option value="'+ optText + '">' + optText + '</option>';     
                        });
                        dropdown += '</select>';                                
                        input += dropdown;
                    }else{
                        input += '<input type="' + fieldType + '" id="'+  id + '" name="'+  name + '" placeholder="' + name + '" class="' + className + '">';    
                    }
                    
                    
                    input += '</div></div>'
               formHtml += input;
               if(type == "Date"){
                    datefieldIds.push(name);
               }
               var isValidate = false;
               if(required && type != "Dropdown"){
                    var rule = { input: '#' + id, message: name + ' is required!', action: 'keyup, blur', rule: 'required'};
                    validationRules.push(rule);
                    isValidate = true;
               }
               if(type == "Numeric"){
                    var rule = { input: '#' + id, message:'Numeric only !', action: 'keyup, blur', rule: 'number'};
                    validationRules.push(rule);
                    isValidate = true; 
               }
               if(!isValidate){
                   var rule = { input: '#' + id, message: name + ' is required!', action: 'keyup, blur', 
                   rule: function (input, commit) {
                        return true;     
                   }  
                   };
                   validationRules.push(rule);
               }
            }
        });
        $("#formHeader").html($('.summernote').code());
        $("#showSampleBlock").html(formHtml);
        generateDateType(datefieldIds)
        $('#showSampleModalForm').modal('show');
        $('#showSampleForm').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            rules:validationRules
        });    
    
        

        $("#showSampleForm").on('validationSuccess', function () {
            $("#showSampleForm-iframe").fadeIn('fast');
        });
    }
    function generateDateType(fieldIds){
         $.each(fieldIds, function(id,value){
            $('#' + value).datetimepicker({step:5,format:"m/d/Y h:i A"});
         });
    }
</script>
