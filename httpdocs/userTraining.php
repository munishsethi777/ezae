<?require("sessionCheckForUser.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration - Easy Assessment Engine</title>
<?include "ScriptsInclude.php"?>

</head>


<body class='default'>

<div id="wrapper">
        <?include("userMenu.php");?>

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Training Module Demo Test</h5>

                        </div>
                        <div class="ibox-content">
                           <?
                                $moduleSeq = $_POST['id'];
                                $learningPlanSeq = $_POST['lpid'];
                                $userSeq = $session->getUserLoggedInSeq();
                            ?>
                            <script language="javascript">
                                $(function() {
                                    var userSeq = "<?echo $userSeq;?>";
                                    var learningPlanSeq = "<?echo $learningPlanSeq;?>";
                                    var loc = window.location.toString(),
                                    params = loc.split('?')[1],
                                    params2 = loc.split('&')[2],
                                    iframe = $('#myiframe');
                                    iframe.src = "Modules/demo_new/story.html" + '?' + params + '&' + params2;
                                    alert(iframe.src);
                                });
                            </script>
                            <iframe id="myiframe" frameborder="0" src="Modules/demo_new/story.html" width="1000" height="670"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</div>
</body>
</html>
