<?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php"?>
<script type="text/javascript">
    $(document).ready(function(){
        //$(".moduleDetailsButton").click(function(e){
//            $("#moduleDetailsModal").modal('show')
//        });


    })
   function showDetail(id){
       $("#moduleDetailsModal" + id).modal('show')
   }
   function editModule(id){
       $("#moduleId").val(id);
       $("#moduleEditForm").submit();
   }
 <?
    require_once('IConstants.inc');
    require_once($ConstantsArray['dbServerUrl'] ."Managers/ModuleMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/LearningPlanMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/ModuleType.php");
    $sessionUtil = SessionUtil::getInstance();
    $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
    $moduleMgr = ModuleMgr::getInstance();
    $modules = $moduleMgr->getModulesByCompany($companySeq);
    $learningPlanMgr = LearningPlanMgr::getInstance();
    $learningPlanList = $learningPlanMgr->getLearningPlansByModule($modules);
 ?>



</script>
</head>
<body class='default'>
    <div id="wrapper">
        <?include("adminMenu.php");?>
       <div class="adminSingup animated fadeInRight">
            <div class="row">
                <div class="col-lg-12" >
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Manage Learning Modules</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                            <?
                            foreach ($modules as $module){
                                $createOn = $module["createdon"];
                                $date = new DateTime($createOn);
                                $createOn =  $date->format('j F Y');
                                $learningPlans = $learningPlanList[$module["seq"]];
                                $moduleType = $module["moduletype"];
                            ?>

                                <div class="col-md-3">
                                    <div class="ibox">
                                        <div class="ibox-content product-box">
                                            <div class="product-imitation">
                                                <img height="200px" src="images/modules/<?echo $module['seq']?>.jpg" alt="" style="">
                                            </div>
                                            <div class="product-desc">
                                                <span class="product-price"><?echo $moduleType;?></span>
                                                <a href="#" class="product-name"> <?echo $module['title']?></a>
                                                <small class="text-muted">
                                                    Added on <b><?echo $createOn?></b> used in <b><?echo count($learningPlans)?></b> Learning Plans
                                                </small>
                                                <div class="small m-t-xs">
                                                    <?echo $module['description']?> scxc
                                                </div>
                                                <div class="m-t text-righ">
                                                    <a href="#" class="btn btn-xs btn-outline btn-primary moduleDetailsButton" onclick=showDetail(<?echo $module['seq']?>)>
                                                        Info <i class="fa fa-info"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-xs btn-outline btn-primary moduleDetailsButton" onclick=showDetail(<?echo $module['seq']?>)>
                                                        View <i class="fa fa-eye"></i>
                                                    </a>
                                                    <?if ($moduleType != ModuleType::FLASH){?>
                                                        <a href="#" class="btn btn-xs btn-outline btn-primary moduleDetailsButton" onclick=editModule(<?echo $module['seq']?>)>
                                                            Edit <i class="fa fa-edit"></i>
                                                        </a>
                                                    <?}?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="moduleDetailsModal<?echo $module["seq"]?>" style="width: auto;" class="modal fade" aria-hidden="true">
                                    <div class="modal-dialog" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title">Modules Details</h4>
                                            </div>
                                            <div class="modal-body mainDiv">


                                                <h4><?echo $module["title"]?></h4>
                                                <p><?echo $module["description"]?></p>
                                                <p>Added on <b><?echo $createOn?></b></p>
                                                <p>Included in <?echo count($learningPlans)?> Learning Plans</p>
                                                <table class="table" style="font-size:12px">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Learning Plan</th>
                                                        <th>Started On</th>
                                                        <th>Ending On</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?$i = 1;
                                                    foreach($learningPlans as $learningPlan){?>
                                                        <tr>
                                                            <td><?echo $i?></td>
                                                            <td><?echo $learningPlan->getTitle()?></td>
                                                            <td><?echo $learningPlan->getActivateOn()?></td>
                                                            <td><?if($learningPlan->getDeactivateOn() == null){ echo("--");}else{echo $learningPlan->getDeactivateOn();}?></td>
                                                        </tr>
                                                    <?$i++;}?>

                                                    </tbody>
                                                </table>



                                            </div>
                                            <div class="modal-footer">
                                                 <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                               </div>


                                  <?}?>



                        </div>
                    </div>
                    </div>
                </div>
            </div>
       </div>
        <form name="moduleEditForm" action="adminCreateModule.php" id="moduleEditForm" method="post">
            <input type="hidden" id="moduleId" name="moduleId">
        </form>
    </div>
</body>
</html>

