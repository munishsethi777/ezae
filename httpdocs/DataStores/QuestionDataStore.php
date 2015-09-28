<?php
require_once("BeanDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/Question.php");
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/QuestionAnswer.php");
class QuestionDataStore extends BeanDataStore {
    private static $questionDataStore;
    public static function getInstance()
    {
        if (!self::$questionDataStore)
        {
            self::$questionDataStore = new QuestionDataStore(Question::$classname,Question::$tablename);
            return self::$questionDataStore;
        }
        return self::$questionDataStore;
    }
    
    public function getQuestionAnswers($moduleId){
        $questionAnsDataStore = new  BeanDataStore(QuestionAnswer::$classname,QuestionAnswer::$tablename);
        $sql = "select qans.* from questions q inner join modulequestions mq on q.seq = mq.questionseq"
." inner join questionanswers qans on q.seq = qans.questionseq where mq.moduleseq = $moduleId " ;
        $questionsAns = $questionAnsDataStore->executeObjectQuery($sql);
        $arrayList = array();
        foreach($questionsAns as $ans){            
            $array = array();
            $quesSeq = $ans->getQuestionSeq();
            if(array_key_exists($quesSeq,$arrayList)){
                $array = $arrayList[$quesSeq];
            }
            array_push($array,$ans);
            $arrayList[$quesSeq] = $array;                   
        }
        return $arrayList;  
    }
    public function getQuestions($moduleId){
        $sql = "select q.* from questions q inner join modulequestions mq on q.seq = mq.questionseq where mq.moduleseq = $moduleId " ;
        $questions = self::executeObjectQuery($sql);        
        return $questions;  
    }
         
}   
?>
