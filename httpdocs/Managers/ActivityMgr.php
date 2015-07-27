<?php
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/Activity.php");
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

    public function saveActivityData($moduleId, $learningPlanSeq, $userSeq, $progres, $score){
        $ads = ActivityDataStore::getInstance();
        $activity = new Activity();
        $activity->setDateOfPlay(new DateTime());
        $activity->setModuleSeq($moduleId);
        $activity->setProgress($progres);
        $activity->setScore($score);
        $activity->setUserSeq($userSeq);
        $activity->setIsCompleted(0);
        $activity->setLearningPlanSeq($learningPlanSeq);

        if($progres == 100 || $progres == "100"){
            $activity->setIsCompleted(1);
        }
        $ads->saveActivityData($activity);
    }

}
?>