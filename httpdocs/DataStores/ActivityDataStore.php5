<?php
require_once("BeanDataStore.php5");
require_once("../BusinessObjects/Activity.php5");   
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
}
?>
