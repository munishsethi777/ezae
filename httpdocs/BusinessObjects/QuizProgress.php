<?php
  class QuizProgress{
      public static $classname = "QuizProgress";
      public static $tablename = "quizprogress";
      private $seq,$moduleseq,$learningplanseq,$questionseq,$answerseq,$dated,$userseq;
      
      public function setSeq($seq_){
        $this->seq = $seq_;
      }
      public function getSeq(){
        return $this->seq;
      }
      
      public function setModuleSeq($moduleSeq_){
        $this->moduleseq = $moduleSeq_;
      }
      public function getModuleSeq(){
        return $this->moduleseq;
      }
      
      public function setLearningPlanSeq($learningPlanSeq_){
        $this->learningplanseq = $learningPlanSeq_;
      }
      public function getLearningPlanSeq(){
        return $this->learningplanseq;
      }
      
      public function setQuestionSeq($questionSeq_){
        $this->questionseq = $questionSeq_;
      }
      public function getQuestionSeq(){
        return $this->questionseq;
      }
      public function setAnswerSeq($ansSeq_){
        $this->answerseq = $ansSeq_;
      }
      public function getAnswerSeq(){
        return $this->answerseq;
      }
      
      public function setDated($dated_){
        $this->dated = $dated_;
      }
      public function getDated(){
        return $this->dated;
      }
      
      public function setUserSeq($userSeq_){
        $this->userseq = $userSeq_;
      }
      public function getUserSeq(){
        return $this->userseq;
      }
  }
?>
