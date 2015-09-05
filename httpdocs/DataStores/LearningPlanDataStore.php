<?php
require_once("BeanDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/LearningPlan.php");

 class LearningPlanDataStore extends BeanDataStore{
    private static $learningPlanDataStore;
    public static function getInstance()
    {
        if (!self::$learningPlanDataStore)
        {
            self::$learningPlanDataStore = new LearningPlanDataStore(LearningPlan::$className,LearningPlan::$tableName);
            return self::$learningPlanDataStore;
        }
        return self::$learningPlanDataStore;
    }
    
    public function getLearningPlansByProfiles($profileSeqs){
        $sql = "select lp.* from learningplans lp inner join learningplanprofiles lpp on lp.seq = lpp.learningplanseq" 
                ." where lpp.learningprofileseq in($profileSeqs)";
        $learningPlans = self::$learningPlanDataStore->executeObjectQuery($sql);
        return $learningPlans;
    }
    //Calling from LearningPlanMgr
    public function getLearningPlansByModule($moduleSeq){
        $sql = "select lpm.seq as moduleseq,lp.* from learningplanmodules lpm inner join learningplans lp on lpm.learningplanseq = lp.seq where lpm.courseseq = $moduleSeq";
        $learningPlans = self::$learningPlanDataStore->executeObjectQuery($sql);
        return $learningPlans;
    }
 }  
?>
