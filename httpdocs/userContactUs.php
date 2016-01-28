<html>
<head>
<title>User | Contact Us</title>
<?include "ScriptsInclude.php"?>
<body class='default'>
    <div id="wrapper">
        <div class="adminSingup animated fadeInRight" >
        <div class="ibox float-e-margins"> 
            <div class="bb-alert alert alert-info" style="display:none;">
            </div>
            <div class="ibox-title">
                <h5>Contact Us<small> If you are facing any problem with the system please provide the information below and we will get back to you.</small></h5>
            </div>
            <div class="ibox-content mainDiv"> 
                <div class="row">                 
                     <div class="col-sm-12">                                                           
                        <div class="col-sm-6"> 
                            <form role="form" method="post" id="contactUsForm" action = "Actions/UserAction.php">
                                <input type="hidden" id ="call" name="call" value="submitContactForm"/>
                                <div class="form-group"><label>Name</label> 
                                    <input type="text" required id="name" name="name" class="form-control">
                                </div>
                                <div class="form-group"><label>Employee Id</label> 
                                    <input type="text" required id="employeeId" name="employeeId" class="form-control">
                                </div>
                                <div class="form-group"><label>Work Location</label>
                                    <input type="text" required id="workLocation" name="workLocation" class="form-control">
                                </div>
                                <div class="form-group"><label>Internet Speed</label>
                                    <input type="text" required id="internetSpeed" name="internetSpeed" class="form-control">
                                </div>
                                <div class="form-group"><label>Your Location</label>
                                    <input type="text" required id="yourLocation" name="yourLocation" class="form-control">
                                </div>
                                <div class="form-group"><label>Phone No</label>
                                    <input type="text" required id="phoneNo" name="phoneNo" class="form-control">
                                </div>
                                <div class="form-group"><label>Email Id</label>
                                    <input type="text" required id="emailId" name="emailId" class="form-control">
                                </div>
                                <div class="form-group"><label>Problem Detail</label>
                                    <input type="text" required id="problemDetails" name="problemDetails" class="form-control">
                                </div>
                                <div>
                                     <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveBtn" type="button">
                                        <span class="ladda-label">Submit</span>
                                    </button>
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
 <script src="scripts/FormValidators/UserContactUsValidations.js"></script> 
<script type="text/javascript">
$(document).ready(function(){ 
    $("#saveBtn").click(function(e){
        var btn = this;
        var validationResult = function (isValid) {
            if (isValid) {
                contactUs(e,btn);
            }
        }
        $('#contactUsForm').jqxValidator('validate', validationResult);   
    })
});
function contactUs(e,btn){
    e.preventDefault();
    var l = Ladda.create(btn);
    l.start();
    $('#contactUsForm').ajaxSubmit(function( data ){
        l.stop();
        showResponseToastr(data,null,"contactUsForm","mainDiv");
    })
} 
</script>

