<?require("sessionCheckForUser.php");
$lpSeq = $_GET["lpSeq"];
$moduleSeq = $_GET["moduleSeq"];?>  
<html>
<head>
<title>Administrator | Change Password</title>
<?include "ScriptsInclude.php"?>
<body class='default'>
    <div id="wrapper">
        <?include("userMenu.php");?>
        <div class="adminSingup animated fadeInRight" >
            <div class="bb-alert alert alert-info" style="display:none;">
                <span>The examples populate this alert with dummy content</span>
            </div>
            <div class="ibox-content mainDiv"> 
                <div class="ibox-title">
                    Make sure you click your photo properly
                </div>
                <div class="row">                 
                     <div class="col-sm-12">                                                           
                        <div class="col-sm-6"><h3 class="m-t-none m-b">Demonstrates simple 320x240 capture &amp; display</h3> 
                            <div id="my_camera"></div>
                            <form role="form" method="post" id="changePasswordForm" action = "Actions/UserAction.php">
                                <input type=button class="btn btn-success" value="Take Snapshot" onClick="take_snapshot()">                        
                               <div id="results" class="well">Your captured image will appear here...</div>
                               <div id="nextBtnDiv" style="display: none;">
                                     <button onclick="upload()" class="btn btn-primary ladda-button" data-style="expand-right" id="saveBtn" type="button">
                                        <span class="ladda-label">Next</span>
                                    </button>
                               </div>                               
                            </form>
                            
                        </div>                        
                     </div>
                </div>
            </div>
        </div> 
    </div>               
</body>
</html>
    <script type="text/javascript" src="scripts/webcam/webcam.min.js"></script>
    <script type="text/javascript" src="scripts/webcam/script.js"></script>
    
    <!-- Configure a few settings and attach camera -->
    <script language="JavaScript">
        var data = "";
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90,
            force_flash: true
        });
        Webcam.attach( '#my_camera' );
        function take_snapshot() {
            // take snapshot and get image data
             $("#nextBtnDiv").show();
            Webcam.snap( function(data_uri) {
                // display results in page
                document.getElementById('results').innerHTML = 
                    '<h2>Here is your image:</h2>' + 
                    '<img src="'+data_uri+'"/>';
                 data = data_uri;               
                 
            } );
           
        }
        function upload(){
            Webcam.upload( data, 'Actions/UserAction.php?call=takeSnapeShot&moduleSeq=<?echo $moduleSeq?>&lpSeq=<?echo $lpSeq?>', function(code, text) {
                                            // Upload complete!
                                            // 'code' will be the HTTP response code from the server, e.g. 200
                                            // 'text' will be the raw response content
                                        var obj = $.parseJSON(text);
                                        if(obj.success == 1){
                                            location.href = "userTraining.php?id=<?echo $moduleSeq?>&lpid=<?echo $lpSeq?>" 
                                        }else{
                                            alert(obj.message)
                                        }
                                            
                                });
        }
    </script>

