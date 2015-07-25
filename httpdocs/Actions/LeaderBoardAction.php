<?
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/LeaderBoardMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/LeaderBoard.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php5");   
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php5"); 
require_once($ConstantsArray['dbServerUrl'] ."Utils/FilterUtil.php");  
$call = "";
if(isset($_GET["call"])){
    $call = $_GET["call"];     
}else{
   $call = $_POST["call"];
}
if($call== "getLeaderBoardsForGrid"){
    try{       
        $lbMgr = LeaderBoardMgr::getInstance();
        $data = $lbMgr->getLeaderBoardForGrid(true);
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
    echo $data;  
}

 
?>