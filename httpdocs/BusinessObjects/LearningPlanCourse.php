<?php
  class LearningPlanCourse{
      
      private $seq,$learningplanseq,$courseseq;
      public static $tableName = "learningplancourses";
      public static $className = "LearningPlanCourse";
      
      public function setSeq($seq_){
        $this->seq = $seq_;
      }
      public function getSeq(){
        return $this->seq;
      }
      
      public function setLearningPlanSeq($lpSeq_){
        $this->learningplanseq = $lpSeq_;
      }
      public function getLearningPlanSeq(){
        return $this->learningplanseq;
      }
      
      public function setCourseSeq($courseSeq_){
        $this->courseseq = $courseSeq_;
      }
      public function getCourseSeq(){
        return $this->courseseq;
      }
      
  }
?>