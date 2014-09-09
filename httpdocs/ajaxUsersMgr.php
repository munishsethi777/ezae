<?php
  require_once('IConstants.inc');
  require_once($ConstantsArray['dbServerUrl'] ."Managers\\UserMgr.php");
  
  $call = $_GET["call"];
  
  if($call == "getUsersForGrid"){
    $companySeq = 1;
    $userMgr = UserMgr::getInstance();
    $userGridJSON = $userMgr->getUsersGridJSON($companySeq);
    echo $userGridJSON;
      
  }

?>
