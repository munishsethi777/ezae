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
       /*'companyseq' is columnName*/
        $colValuePair["companyseq"] = $companySeq;
        //$moduleList = $this->executeConditionQuery($colValuePair);
        $moduleList = $this->findAll();
        return $moduleList;
    }
    
    public function findByLearningPlanSeq($learningPlanSeqs){
        $colValuePair = array();
        $list = $this->executeQuery("select lp.seq as lpseq, lp.`title` as lptitle,lpc.isenableleaderboard,m.* from learningplans lp inner join learningplancourses lpc on lp.seq = lpc.learningplanseq inner join modules m on lpc.courseseq = m.seq where lp.seq in ($learningPlanSeqs) ");
    }

    //Method used to display modules on user trainings page
    public function findModulesForUserTrainingGrid($userSeq){
        $sql = "select modules.seq as moduleseq,modules.title as moduletitle,learningplans.title as learningplantitle from learningplanmodules
left join modules on modules.seq = learningplanmodules.courseseq
left join learningplans on learningplans.seq = learningplanmodules.learningplanseq
left join learningplanprofiles on learningplanprofiles.learningplanseq = learningplans.seq
left join learningprofiles on learningprofiles.seq = learningplanprofiles.learningprofileseq
left join userlearningprofiles on userlearningprofiles.tagseq = learningplanprofiles.learningprofileseq
where userlearningprofiles.userseq =  $userSeq";
        $list = $this->executeQuery($sql);
        return $list;
    }
}
?>
