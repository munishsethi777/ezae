<?require("sessionCheckForUser.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Easy Assessment Engine</title>
<?include "ScriptsInclude.php"?>
<link href="http://mycodingtricks.com/demo/style.css" rel="stylesheet"/>
<script src="http://mycodingtricks.com/demo/script.js"></script>
<script type="text/javascript" src="scripts/webcam/webcam.js"></script>
<script type="text/javascript" src="scripts/webcam/script.js"></script>
<script language="JavaScript">
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90,
        force_flash: true
    });
    Webcam.attach( '#my_camera' );
    //function take_snapshot() {
        // take snapshot and get image data
//        Webcam.snap( function(data_uri) {
            // display results in page
//            document.getElementById('results').innerHTML =
//                '<h2>Here is your image:</h2>' +
//                '<img src="'+data_uri+'"/>';
//                            Webcam.upload( data_uri, 'upload.php', function(code, text) {
                                        // Upload complete!
                                        // 'code' will be the HTTP response code from the server, e.g. 200
                                        // 'text' will be the raw response content
//                            });
//        } );
//    }
</script>
</head>
<body class='default no-js'>
<div id="wrapper">
    <?include("userMenu.php");?>
    <div class="row">
        <div class="col-md-12">
            <div class="wrapper wrapper-content">
                <div class="ibox">
                    <div class="ibox-title">
                        Make sure you click your photo properly
                    </div>
                    <div class="ibox-content">
                        <h3>Demonstrates simple 320x240 capture &amp; display</h3>
                        <div id="my_camera"></div>
                        <form>
                            <input type=button class="btn btn-success" value="Take Snapshot" onClick="take_snapshot()">
                        </form>
                        <div id="results" class="well">Your captured image will appear here...</div>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
