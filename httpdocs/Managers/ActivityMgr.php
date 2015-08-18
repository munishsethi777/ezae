<?php
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/Activity.php");
require_once($ConstantsArray['dbServerUrl']. "DataStores/ActivityDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "Utils/MailMessageUtil.php");
require_once($ConstantsArray['dbServerUrl']. "Utils/SessionUtil.php5");
require_once($ConstantsArray['dbServerUrl']. "Utils/CustomFieldsFormGenerator.php");
require_once($ConstantsArray['dbServerUrl']. "Enums/RoleType.php");
require_once($ConstantsArray['dbServerUrl']. "Enums/ManagerCriteriaType.php");


class ActivityMgr{

    private static $activityMgr;
    private static $mailMessageMgr;
    private static $sessionUtil;
    public static function getInstance()
    {
        if (!self::$activityMgr)
        {
            self::$activityMgr = new ActivityMgr();
            self::$mailMessageMgr = new MailMessageMgr();
            self::$sessionUtil = new SessionUtil();
            return self::$activityMgr;
        }
        return self::$activityMgr;
    }

    public function saveActivityData($moduleId, $learningPlanSeq, $userSeq, $progres, $score){
        $ads = ActivityDataStore::getInstance();
        $activity = new Activity();
        $activity->setDateOfPlay(new DateTime());
        $activity->setModuleSeq($learningPlanSeq);
        $activity->setProgress($progres);
        $activity->setScore($score);
        $activity->setUserSeq($userSeq);
        $activity->setIsCompleted(0);
        $activity->setLearningPlanSeq($learningPlanSeq);
        if($progres == 100 || $progres == "100"){
            $activity->setIsCompleted(1);
            $mailMessageMailUtils = MailMessageUtil::getInstance();
            $mailMessageMailUtils->checkForModuleOnMarksNotification($learningPlanSeq,$moduleId,$score,$userSeq);
            $mailMessageMailUtils->checkForModuleCompletedNotification($learningPlanSeq,$moduleId,$score,$userSeq);
        }
        $ads->saveActivityData($activity);

    }


    public function getCompletionCounts($learningPlanSeq,$moduleSeq){
        $userSeqs = array();
        $role = self::$sessionUtil->getLoggedInRole();
            if($role == RoleType::MANAGER){ 
                $adminMgr = AdminMgr::getInstance();
                $adminSeq = self::$sessionUtil->getAdminLoggedInSeq();
                $managerCriteria = $adminMgr->findLoggedinManagerCriteria($adminSeq);
                $criteriaVals = $managerCriteria->getCriteriaValue();
                if($managerCriteria->getCriteriaType() == ManagerCriteriaType::CUSTOM_FIELD){
                    $customFieldGenerator = CustomFieldsFormGenerator::getInstance();
                    $customfieldArr = $customFieldGenerator->getCustomFieldsArray($criteriaVals,false);
                    $userMgr = UserMgr::getInstance();
                    $userSeqs = $userMgr->getUserSeqsByCustomfield($customfieldArr);                        
                }
            }else{
                
            }                    
       $ads = ActivityDataStore::getInstance();
       return $ads->getCompletionCounts($learningPlanSeq,$moduleSeq,$userSeqs);
    }
   
    public function getUserPerformance($userSeq){
        $ads = ActivityDataStore::getInstance();
       return $ads->findByUser($userSeq);
    }
    //called for main chart on performance UI
    public function getPerformanceData($learningPlanSeq,$moduleId,$maxScore){
        $ads = ActivityDataStore::getInstance();
        $arr = $ads->getScorePercentage($learningPlanSeq,$moduleId);
        return $arr;
    }

    //returns customFieldsValues Array from csv data
    public static function getCustomValuesArray($lines){
        $mainLineArray = explode(';', $lines);
        $mainArray = array();
        $prefix = "cus_";
        foreach($mainLineArray as $line){
            if($line != "") {
                $nameValueArray = explode(':', $line);
                $val = $nameValueArray[1];
                $mainArray[trim("cus_".$nameValueArray[0])] =  $val;
            }

        }
        return $mainArray;

    }

    //called from AdminMgr for performance page table MMM
    public static function getMeanMedianModePassPercentForPerformance($learningPlanSeq,$moduleSeq){
        $ads = ActivityDataStore::getInstance();
        $data = $ads->getScorePercentage($learningPlanSeq,$moduleSeq);
        $arr = array();
        foreach($data as $item){
            array_push($arr, $item[0]);
        }
        $mainArray = array();
        $count = count($arr);
        $sum = array_sum($arr);
        $avg = $sum / $count;
        $avg = round($avg);

        rsort($arr);
        $middle = round($count/2);
        $median = $arr[$middle-1];

        $v = array_count_values($arr);
        arsort($v);
        foreach($v as $k => $v){$mode = $k; break;}

        $mainArray['mean'] = round($avg,2);
        $mainArray['median'] = round($median,2);
        $mainArray['mode'] = round($mode,2);
        return json_encode($mainArray);
    }

}
?>