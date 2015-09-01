<?php
require_once("BeanDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/Module.php");

class ModuleDataStore extends BeanDataStore{
    private static $moduleDataStore;

    public static function getInstance()
    {
        if (!self::$moduleDataStore)
        {
            self::$moduleDataStore = new ModuleDataStore("Module",Module::$tableName);
                return self::$moduleDataStore;
        }
        return self::$moduleDataStore;
    }

    public function findByCompanySeq($companySeq){
        $colValuePair = array();
        $list = $this->executeQuery("select * from modules left join companymodules on modules.seq = companymodules.moduleseq
        where companymodules.companyseq = $companySeq;");
        return $list;
    }

    public function findByLearningPlanSeq($learningPlanSeqs){
        $colValuePair = array();
        $list = $this->executeQuery("select lp.seq as lpseq, lp.`title` as lptitle,lpc.isenableleaderboard,m.* from learningplans lp inner join learningplanmodules lpc on lp.seq = lpc.learningplanseq inner join modules m on lpc.courseseq = m.seq where lp.seq in ($learningPlanSeqs) ");
        return $list;
    }

    //Method used to display modules on user trainings page
    public function findModulesForUserTrainingGrid($userSeq,$learningPlanSeq){
        $sql = "select modules.seq as moduleseq,modules.title as moduletitle,
learningplans.seq as learningplanseq,learningplans.title as learningplantitle,learningplans.issequencelocked
,activities.progress, activities.score, activities.iscompleted
from learningplanmodules
left join modules on modules.seq = learningplanmodules.courseseq
left join learningplans on learningplans.seq = learningplanmodules.learningplanseq
left join learningplanprofiles on learningplanprofiles.learningplanseq = learningplans.seq
left join activities on activities.learningplanseq = learningplans.seq and activities.moduleseq = modules.seq and activities.userseq = $userSeq
left join learningprofiles on learningprofiles.seq = learningplanprofiles.learningprofileseq
left join userlearningprofiles on userlearningprofiles.tagseq = learningplanprofiles.learningprofileseq
where userlearningprofiles.userseq =  $userSeq
and learningplans.seq = $learningPlanSeq";
        $list = $this->executeQuery($sql);
        return $list;
    }
}
?>
