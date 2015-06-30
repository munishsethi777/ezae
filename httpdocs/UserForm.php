
 <div class="ibox-content mainDiv">
    <div class="row" >
        <div class="col-sm-6"><h3 class="m-t-none m-b">Profile</h3>
            <form role="form" method="post" action="Actions/LearnerAction.php" id="customFieldForm" class="form-horizontal">
                <input type="hidden" value="saveLearners" name="call">
                <input type="hidden" value="createdDate" name="createdDate">  
                <input type="hidden" id="id" name="id" value="0">
                <div id="msgDiv" class="alert alert-success alert-dismissable" style="display:none;"></div>
                <div id="errorDiv" class="alert alert-danger alert-dismissable" style="display:none;"></div>               
                <div id="formFieldsDiv"></div>                
                 <div class="hr-line-dashed"></div>
                <div class="form-group">                                   
                     <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveBtn" type="button">
                        <span class="ladda-label">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function loadFormFields(){
        var url = 'Actions/UserAction.php?call=getUserFieldForm';
        $.get(url, function(data){
            $("#formFieldsDiv").html(data);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green'
            });
        });
    } 
</script>