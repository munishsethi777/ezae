<?php
$sessionUtil = SessionUtil::getInstance();
$adminSeq =  $sessionUtil->getAdminLoggedInSeq();
?>   
     <?include "ScriptsInclude.php"?> 
    <div id="updateProfilePicModelForm" class="modal fade" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Update Profile Picture</h4>
                </div>
                <div class="modal-body mainDiv"> 
                    <div class="row">                       
                         <form  role="form" method="post" enctype= "multipart/form-data" action="Actions/CompanyAction.php" id="UpdateProfilePic" class="form-horizontal">
                            <input type="hidden" id="call" name="call" value="updateProfilePicture">
                            <input type="hidden" id="imgSrc" name="imgSrc">
                             <input type="hidden" id="imgSrcOrg" name="imgSrcOrg"> 
                            <div class="ibox float-e-margins">                               
                                <div class="ibox-content">                
                                    <div class="row"> 
                                    <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                        <input type="file" accept="image/*" name="file" id="inputImage" class="hide">                                                      
                                        Upload new image
                                    </label>            
                                    <div class="col-md-9">                                         
                                        <div class="image-crop">
                                            <img id="profilePic" src="Images\UserImages\<?echo($adminSeq)?>_org.jpg">
                                        </div>
                                    </div>                                        
                                    <div class="col-md-3">                                           
                                        <div class="img-preview img-preview-md"></div>                                         
                                    </div>
                                   <br/>
                                   <br/>
                                   <div class="col-md-9">                                        
                                        <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveUpdateProfileBtn" type="button">
                                            <span class="ladda-label">Save</span>
                                        </button>
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    </div> 
                                                                                          
                                    </div>
                                </div>
                            </div>
                         </form>                                
                    </div>
                 </div>
            </div>
        </div> 
    </div>

<script type="text/javascript">
$(document).ready(function(){
    
    var $image = $(".image-crop > img")
    $($image).cropper({
        aspectRatio: 1,
        preview: ".img-preview",
        done: function(data) {
               
        }
    });
    var $inputImage = $("#inputImage");
    if (window.FileReader) {
        $inputImage.change(function(){
            var fileReader = new FileReader(),
                    files = this.files,
                    file;

            if (!files.length) {
                return;
            }
            file = files[0];
            if (/^image\/\w+$/.test(file.type)) {
                fileReader.readAsDataURL(file);
                fileReader.onload = function () {
                    $inputImage.val("");
                    $image.cropper("reset", true).cropper("replace", this.result);
                };
            } else {
                showMessage("Please choose an image file.");
            }
        });
    } else {
        $inputImage.addClass("hide");
    }
   
    $("#saveUpdateProfileBtn").click(function(e){
        var btn = this;
        var url = $image.cropper("getDataURL");
        var base64image = $('#profilePic').attr('src');
        $("#imgSrcOrg").val(base64image);      
        $("#imgSrc").val(url);
        e.preventDefault();
            var l = Ladda.create(btn);
            l.start();            
             $('#UpdateProfilePic').ajaxSubmit(function( data ){
                   l.stop();
                   showResponseToastr(data,"updateProfilePicModelForm","UpdateProfilePic","mainDiv");
                   var url = $('#profilePicImg').attr('src');
                   $("#profilePicImg").attr("src", url + "?" + new Date().getTime());
                
         })              
    })   
});
    
function openUploader(){
    $('#updateProfilePicModelForm').modal('show');
      
} 
</script>
