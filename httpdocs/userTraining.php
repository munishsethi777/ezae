<?require("sessionCheckForUser.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ModuleMgr.php");?>
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
    $module = $moduleMgr->getModule($moduleId);
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
                                $learningPlanSeq = 0;
                                if(isset($_POST['lpid'])){
                                    $learningPlanSeq = $_POST['lpid'];
                                }

                            ?>
                            <script language="javascript">
                                $(function() {
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
