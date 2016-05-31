<?php
include("sessioncheck.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ActivityMgr.php");
$seq =  $_GET["seq"];
$moduleSeq = $_GET["moduleseq"];
$activityMgr = ActivityMgr::getInstance();
$activity = $activityMgr->getActivityByUser($seq,$moduleSeq);
$userImageBytes = $activity->getUserImage();
$userImageBytes = "data:image/jpg;base64,".$userImageBytes;?>
<html>
<head>
<title>Administrator | User Image</title>
<?include "ScriptsInclude.php"?>
<body class='default'>
    <div id="wrapper">
        <?include("adminMenu.php");?>
        <div class="adminSingup animated fadeInRight" >
            <div class="bb-alert alert alert-info" style="display:none;">
                <span>The examples populate this alert with dummy content</span>
            </div>
            <div class="ibox-content mainDiv"> 
                   <div class="row">                 
                     <div class="col-sm-12">                                                           
                        <img src="<?echo $userImageBytes?>" alt="">
                     </div>
                </div>
            </div>
        </div> 
    </div>               
</body>
</html>

