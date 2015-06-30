 <?php
    require_once('IConstants.inc');
    require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php5");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/LoginType.php");
    $session = SessionUtil::getInstance();
    $session->sessionCheck(LoginType::USER);
?>
