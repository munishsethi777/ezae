<?php
  class LearningPlanModule{

      private $seq,$learningplanseq,$courseseq,$isenableleaderboard;
      public static $tableName = "learningplanmodules";
      public static $className = "LearningPlanModule";

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

      public function setIsEnableLeaderBoard($isleaderBoard_){
            $this->isenableleaderboard = $isleaderBoard_;
        }
        public function getIsEnableLeaderBoard(){
            return $this->isenableleaderboard;
        }

  }
?>
