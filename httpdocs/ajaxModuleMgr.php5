<?php
  require_once('IConstants.inc');
  require_once($ConstantsArray['dbServerUrl'] ."Managers\\ModuleMgr.php5");
  
  $call = $_GET["call"];
  
  if($call == "getModulesForGrid"){
    $companySeq = 1;
    $moduleMgr = ModuleMgr::getInstance();
    $moduleGridJSON = $moduleMgr->getModuleGridJSON($companySeq);
    echo $moduleGridJSON;
      
  }

?>
