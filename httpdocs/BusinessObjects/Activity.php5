<?php
  class Activity{
      
      public static $tableName = "activity";
      private $seq,$moduleseq,$userseq,$iscompleted,$progress,$dateofplay;
      
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
         $this->progress = $$progress_; 
      } 
      
      public function setDateOfPlay($dateOfPlay_){
        $this->dateofplay = $dateOfPlay_;
      }
      public function getDateOfPlay(){
        return $this->dateofplay;
      } 
  }
?>
