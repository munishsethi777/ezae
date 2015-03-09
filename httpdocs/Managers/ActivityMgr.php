<?php
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/Activity.php5");
require_once($ConstantsArray['dbServerUrl']. "DataStores/ActivityDataStore.php5");

class ActivityMgr{

    private static $activityMgr;

    public static function getInstance()
    {
        if (!self::$activityMgr)
        {
            self::$activityMgr = new ActivityMgr();
            return self::$activityMgr;
        }
        return self::$activityMgr;
    }

    public function saveActivityData($moduleId, $progres, $score,$userSeq){
        //$sessionUtil = SessionUtil::getInstance();
        //$userSeq = $sessionUtil->getUserLoggedInSeq();
        $ads = ActivityDataStore::getInstance();
        $activity = new Activity();
        $activity->setDateOfPlay(new DateTime());
        $activity->setModuleSeq($moduleId);
        $activity->setProgress($progres);
        $activity->setScore($score);
        $activity->setUserSeq($userSeq);
        $activity->setIsCompleted(0);

        if($progres == 100 || $progres == "100"){
            $activity->setIsCompleted(1);
        }
        $ads->saveActivityData($activity);
    }

    public function getCompletionCounts($moduleId){
       $ads = ActivityDataStore::getInstance();
       return $ads->getCompletionCounts($moduleId);
    }
    public function getUserPerformance($userSeq){
        $ads = ActivityDataStore::getInstance();
       return $ads->findByUser($userSeq);
    }
    //called for main chart on performance UI
    public function getPerformanceData($moduleId,$maxScore){
        $ads = ActivityDataStore::getInstance();
        $arr = $ads->getScorePercentage($moduleId);
        return $arr;
    }

    //returns customFieldsValues Array from csv data
    public static function getCustomValuesArray($lines){
        $mainLineArray = explode(';', $lines);
        $mainArray = array();
        foreach($mainLineArray as $line){
            $nameValueArray = explode(':', $line);
            $val = $nameValueArray[1];
            $mainArray[trim($nameValueArray[0])] = $val;
        }
        return $mainArray;

    }

    //called from AdminMgr for performance page table MMM
    public static function getMeanMedianModePassPercentForPerformance($moduleSeq){
        $ads = ActivityDataStore::getInstance();
        $data = $ads->getScorePercentage($moduleSeq);
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