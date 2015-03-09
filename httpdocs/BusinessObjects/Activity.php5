<?php
  class Activity{

      public static $tableName = "activities";
      private $seq,$moduleseq,$userseq,$iscompleted,$progress,$score,$dateofplay;

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

      public function setUserSeq($userSeq_){
        $this->userseq = $userSeq_;
      }
      public function getUserSeq(){
        return $this->userseq;
      }

      public function setIsCompleted($isCompleted_){
        $this->iscompleted = $isCompleted_;
      }
      public function getIsCompleted(){
        return $this->iscompleted;
      }

      public function setProgress($progress_){
         $this->progress = $progress_;
      }
      public function getProgress(){
        return $this->progress;
      }

      public function setScore($score){
         $this->score = $score;
      }
      public function getScore(){
        return $this->score;
      }

      public function setDateOfPlay($dateOfPlay_){
        $this->dateofplay = $dateOfPlay_;
      }
      public function getDateOfPlay(){
        return $this->dateofplay;
      }
  }
?>
