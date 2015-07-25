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
        return $list;
    }
  }
?>
