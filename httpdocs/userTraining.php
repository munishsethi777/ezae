<?require("sessionCheckForUser.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ModuleMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ActivityMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php5");?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration - Easy Assessment Engine</title>
<?include "ScriptsInclude.php"?>
<?
    $learningPlanSeq = $_GET['lpid'];
    $moduleId = $_GET['id'];
    $moduleMgr = ModuleMgr::getInstance();
    $activityMgr = ActivityMgr::getInstance();
    $module = $moduleMgr->getModule($moduleId);
    $isFaceAuthentication = $module->getIsFaceAuthentication();
    $faceAuthentication = "0";
    
    if(!empty($isFaceAuthentication)){
          $sessionUtil = SessionUtil::getInstance();
          $userSeq = $sessionUtil->getUserLoggedInSeq();
          $activity = $activityMgr->getActivityByUser($userSeq,$moduleId);
          $userImageBytes = $activity != null ? $activity->getUserImage() : null;
          if(!empty($activity) && !empty($userImageBytes) ){
              $faceAuthentication = "0";    
          }else{
              $faceAuthentication = "1";
          }
    } 
?>
<script language="javascript">
    var learningPlanSeq = "<?echo $learningPlanSeq;?>";;
</script>
</head>


<body class='default'>

<div id="wrapper">
        <?include("userMenu.php");?>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5><?echo $module->getTitle()?></h5>
                        </div>
                        <div class="ibox-content">
                           <?
                                if(isset($_POST['lpid'])){
                                    $learningPlanSeq = $_POST['lpid'];
                                }
                            ?>
                            <script language="javascript">
                               var flag = "<?echo $faceAuthentication?>";
                                $(function() {
                                    if(flag == "1"){
            location.href = "faceAuthentication.php?moduleSeq=<?echo $moduleId?>&lpSeq=<?echo $learningPlanSeq?>";
                                    }
                                    var learningPlanSeq = "<?echo $learningPlanSeq;?>";
                                    var loc = window.location.toString(),
                                    params = loc.split('?')[1],
                                    params2 = loc.split('&')[2],
                                    iframe = $('#myiframe');
                                    iframe.src = "Modules/"+ <?echo $moduleId?> +"/story.php" + '?' + params + '&' + params2;
                                    //alert(iframe.src);
                                });
                            </script>
                            <iframe id="myiframe" frameborder="0" src="Modules/<?echo $moduleId?>/story.php" width="1000" height="670"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</div>
</body>
</html>
