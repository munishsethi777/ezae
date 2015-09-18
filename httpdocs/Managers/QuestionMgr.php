<?php
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php5");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Question.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/QuestionAnswer.php");
 class QuestionMgr{
    private static $questionMgr;
    private static $sessionUtil;
    private static $questionDataStore;
    private static $questionAnswerDataStore;
    public static function getInstance()
    {
        if (!self::$questionMgr)
        {
            self::$questionMgr = new QuestionMgr();
            self::$sessionUtil = new SessionUtil();
            self::$questionDataStore = new BeanDataStore(Question::$classname,Question::$tablename);
            self::$questionAnswerDataStore = new BeanDataStore(QuestionAnswer::$classname,QuestionAnswer::$tablename);
            return self::$questionMgr;
        }
        return self::$questionMgr;
    }
    
    public function saveQuestion($question){
        $id = self::$questionDataStore->save($question);
        return $id;
    }
    
    public function saveQuestionAnswer($questionAns){
        $id = self::$questionAnswerDataStore->save($questionAns);
        return $id;
    }
    
    public function getQuestions(){
        $adminSeq = self::$sessionUtil->getAdminLoggedInSeq();
        $colValue["adminseq"] = $adminSeq;
        $questions =  self::$questionDataStore->executeConditionQuery($colValue);
        $mainArr = array();
        foreach($questions as $question){
            $arr = $this->toArray($question);
            array_push($mainArr,$arr);
        }
        return json_encode($mainArr);
     }
     
     public function toArray($question){
        $arr = array();
        $arr['id'] = $question->getSeq();
        $arr['title'] = $question->getTitle();
        return $arr;
     }
     
     public function isAlreadyExist($name){
       $companySeq = self::$sessionUtil->getAdminLoggedInCompanySeq();
       $colValue["companyseq"] = $companySeq;
       $colValue["title"] = $name;
       $count = self::$questionDataStore->executeCountQuery($colValue);
       return $count > 0;  
     }
      
  }
?>
