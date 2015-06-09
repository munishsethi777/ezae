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
        <div class="ibox-content no-padding"> 
            <div class="summernote">
                <h3>Enter text for Singnup form header</h3>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeIn mainDiv">
            <p>You may drag and drop various field sections to maintain the sequance of registration form fields.</p>
            <form role="form"  method="post" action="Actions/SignupFormAction.php" id="SignupFieldForm" class="form-horizontal">
                <input type="hidden" name="headerText" id="headerText"/>
                <input type="hidden" value="saveSignupFormFields" name="call"> 
                <div class="col-lg-12" id="customFieldsBlock">
                    
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
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
      
        loadFieldBlocks();
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
        
        
          
    })
    var edit = function() {
            $('.click2edit').summernote({focus: true});
        };
    var save = function() {
        var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
        $('.click2edit').destroy();
    };
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
        $.each(divs, function(key,value){
            var div = value;
            var inputs = $("#" + div.id).find("input");
            var show = inputs[4].checked;
            if(show){
                var name = inputs[1].value;
                var type = inputs[2].value; 
                var required = inputs[3].checked;
                var input =  '<div class="form-group">';
                    input += '<label class="col-sm-3 control-label">' + name + '</label>';
                    input += '<div class="col-sm-9">';
                    if(type == 'string' || type == 'numeric'){
                         type = 'text';
                    }
                    input += '<input type="' + type + '" id="'+  name + '" placeholder="' + name + '" class="form-control">';
                    input += '</div></div>'
               formHtml += input;
               if(required){
                var rule = { input: '#' + name, message: name + ' is required!', action: 'keyup, blur', rule: 'required'};
                validationRules.push(rule);    
               }
                     
            } 
           
        });
        $("#formHeader").html($('.summernote').code());
        $("#showSampleBlock").html(formHtml);
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

</script>
