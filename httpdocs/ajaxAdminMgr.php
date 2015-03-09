<?php
  require_once('IConstants.inc');
  require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
  require_once($ConstantsArray['dbServerUrl'] ."Managers/AdminMgr.php");
  require_once($ConstantsArray['dbServerUrl'] ."Managers/ActivityMgr.php");
  require_once($ConstantsArray['dbServerUrl'] ."Managers/ModuleMgr.php5");
  require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php5");

  $call = $_GET["call"];

  if($call == "getUsersForGrid"){
    $sessionUtil = SessionUtil::getInstance();
    $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
    //$companySeq = 1;
    $adminMgr = AdminMgr::getInstance();
    $userGridJSON = $adminMgr->getUsersGridJSON($companySeq);
    echo $userGridJSON;
    return;
  }

  if($call == "getModulesJson"){
    $sessionUtil = SessionUtil::getInstance();
    $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
    //$companySeq = 1;
    $adminMgr = AdminMgr::getInstance();
    $modulesJson = $adminMgr->getModulesDataJson($companySeq);
    echo $modulesJson;
    return;
  }

  if($call == "getCustomFieldsJson"){
    $sessionUtil = SessionUtil::getInstance();
    $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
    //$companySeq = 1;
    $adminMgr = AdminMgr::getInstance();
    $customFieldsJSON =  $adminMgr->getCustomFieldsJSON($companySeq);
    echo $customFieldsJSON;
    return;
  }

  if($call == "getActivityDataForGrid"){
    $sessionUtil = SessionUtil::getInstance();
    $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
    //$companySeq = 1;
    $moduleSeq = $_GET['moduleSeq'];
    $adminMgr = AdminMgr::getInstance();
    $activityGridJSON = $adminMgr->getActivitiesGridJSON($companySeq,$moduleSeq);
    echo $activityGridJSON;
    return;
  }

  if($call == "getModuleCompletionData"){
      $moduleId = $_GET["moduleSeq"];
      $mode = $_GET['mode'];
      $adminMgr = AdminMgr::getInstance();
      echo $adminMgr->getModuleCompletionForChart($moduleId, $mode);
      return;
  }

  if($call == "getModulePassPercentageChartData"){
      $moduleId = $_GET["moduleSeq"];
      $percentage = $_GET["percentage"];
      $adminMgr = AdminMgr::getInstance();
      echo $adminMgr->getModulePercentagePerformanceForChart($moduleId,$percentage);
      return;
  }

  //called for performance Metrics Mean Mediam Mode table
  if($call == "getModuleMeanMediamModePercent"){
      $moduleId = $_GET["moduleSeq"];
      $adminMgr = AdminMgr::getInstance();
      echo $adminMgr->getMeanMedianModeOfPassPercent($moduleId);
      return;
  }

  if($call == "getModulePerformanceData"){
      $moduleId = $_GET["moduleSeq"];
      $moduleMgr = ModuleMgr::getInstance();
      $module = $moduleMgr->getModule($moduleId);
      $activityMgr = ActivityMgr::getInstance();
      $dataArr = $activityMgr->getPerformanceData($moduleId,$module->getMaxScore());
      $scoresArr = array();
      $scoresArr['86PLUS'] = 0;
      $scoresArr['66TO85'] = 0;
      $scoresArr['46TO65'] = 0;
      $scoresArr['0TO45'] = 0;
      foreach($dataArr as $data){
        $val = intval($data[0]);
        if($val>=86){
            $scoresArr['86PLUS']++;
        }elseif($val>=65 && $val<=85){
            $scoresArr['66TO85']++;
        }elseif($val>=46 && $val<=65){
             $scoresArr['46TO65']++;
        }elseif($val<=45){
            $scoresArr['0TO45']++;
        }

      }
      $mainArr = array();
      $arr = array();
      $arr['Score'] = '>85%';
      $arr['Participants'] = $scoresArr['86PLUS'];
      array_push($mainArr,$arr);

      $arr['Score'] = '65%-85%';
      $arr['Participants'] = $scoresArr['66TO85'];
      array_push($mainArr,$arr);

      $arr['Score'] = '45%-65%';
      $arr['Participants'] = $scoresArr['46TO65'];
      array_push($mainArr,$arr);

      $arr['Score'] = '0%-45%';
      $arr['Participants'] = $scoresArr['0TO45'];
      array_push($mainArr,$arr);

      echo json_encode($mainArr);
  }


  if($call == "getModuleComparativeData"){
      $moduleSeq = $_GET["moduleSeq"];
      $fieldName = $_GET["fieldName"];
      $criteria = $_GET["criteria"];
      $adminMgr = AdminMgr::getInstance();
      $json = $adminMgr->getModuleComparativeForChart($moduleSeq, $fieldName, $criteria);
      echo $json;
      return;
  }

  if($call == "loginAdmin"){
      $username = $_GET["username"];
      $password = $_GET["password"];
      $adminMgr = new AdminMgr();
      $admin = $adminMgr->logInAdmin($username,$password);
      if($admin){
          $sessionUtil = SessionUtil::getInstance();
          $sessionUtil->createAdminSession($admin);
          echo 1;
      }else{
          echo 0;
      }
      return;
  }

?>