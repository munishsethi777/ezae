<?php
 require_once("BeanDataStore.php5");
 require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/Activity.php");
 require_once($ConstantsArray['dbServerUrl']. "Managers/AdminMgr.php");
class ActivityDataStore extends BeanDataStore{
   private static $activityDataStore;

    public static function getInstance()
    {
        if (!self::$activityDataStore)
        {
            self::$activityDataStore = new ActivityDataStore("Activity",Activity::$tableName);
            return self::$activityDataStore;
        }
        return self::$activityDataStore;
    }
    public function findByUser($userSeq){
        $colValuePair = array();
        $colValuePair["userseq"] = $userSeq;
        $activityObjList = $this->executeConditionQuery($colValuePair);
        return $activityObjList;
    }

    public function findByUserAndModule($userseq, $moduleSeq){
        $colValuePair = array();
        $colValuePair["userseq"] = $userseq;
        $colValuePair["moduleseq"] = $moduleSeq;
        $activityObjList = $this->executeConditionQuery($colValuePair);
        if(sizeof($activityObjList) > 0){
            return $activityObjList[0];
        }
        return null;
    }

    public function saveActivityData(Activity $activity){
        $sql = "INSERT INTO activities (moduleseq,userseq,iscompleted,progress,score,dateofplay) VALUES (";
        $sql .= $activity->getModuleSeq() .",";
        $sql .= $activity->getUserSeq() .",";
        $sql .= $activity->getIsCompleted() .",";
        $sql .= $activity->getProgress() .",";
        $sql .= $activity->getScore() .",'";
        $sql .= $activity->getDateOfPlay()->format('Y-m-d H:i:s') ."')";
        $sql .= " ON DUPLICATE KEY UPDATE progress=".$activity->getProgress();
        $sql .= ", score=".$activity->getScore();
        $sql .= ", iscompleted=".$activity->getIsCompleted();
        try{
            $this->executeQuery($sql);
        }catch(Exception $e){
            throw $e;
        }
    }

    public function getUsersAndActivity($moduleSeq,$companySeq){
        //$sql= "select * from users left join activities on users.seq = activities.userseq and activities.moduleseq = ".$moduleSeq;
		$sql= "select users.*,activities.*, users.seq from users left join activities on activities.userseq = users.seq and activities.moduleseq = ".$moduleSeq ." where users.companyseq=".$companySeq;
		//select users.*,activities.progress,activities.score from users left join activities on users.seq = activities.userseq and activities.moduleseq = 2 where users.companyseq = 2
        //$sql .= " WHERE users.seq =3200";

        $list = $this->executeQuery($sql);
        return $list;
    }

    public function getCompletionCounts($moduleId){
        $sql = "select count(u.seq) as totalUsers , count(attemptedTable.seq) as attemtedCount, ";
        $sql .= "count(completedTable.seq) as completedCount from users u ";
        $sql .= "left join activities attemptedTable on u.seq = attemptedTable.userseq and attemptedTable.moduleseq = ".$moduleId;
        $sql .= " left join activities completedTable on u.seq = completedTable.userseq ";
        $sql .= "and completedTable.iscompleted = 1  and completedTable.moduleseq = ".$moduleId;
        $list = $this->executeQuery($sql);
        return $list;
    }

    public function getPassCountGreaterThanPercentage($moduleId, $percent){
        $sql = "select count(a.score) as totalCount from activities as a left join modules on a.moduleseq = modules.seq";
        $sql .= " where (a.score/modules.maxscore) * 100 > $percent and modules.seq = $moduleId";
        $list = $this->executeQuery($sql);
        return $list[0][0];
    }

    public function getScorePercentage($moduleId){
        $sql = "select a.score/modules.maxscore * 100 from activities a left join modules on a.moduleseq = modules.seq";
        $sql .= " where modules.seq = $moduleId";
        $list = $this->executeQuery($sql);
        return $list;
    }
}


?>