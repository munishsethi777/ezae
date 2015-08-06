<?php
  class ManagerCriteria{
      private $seq,$managerseq,$criteriatype,$criteriavalue;
      public static $tableName = "managercriteria";
      public static $className = "ManagerCriteria";
      public function setSeq($seq_){
        $this->seq = $seq_;
      }
      public function getSeq(){
        return $this->seq;
      }
      public function setManagerSeq($managerseq_){
        $this->managerseq = $managerseq_;
      }
      public function getManagerSeq(){
        return $this->managerseq;
      }
      public function setCriteriaType($criteriaType_){
        $this->criteriatype = $criteriaType_;
      }
      public function getCriteriaType(){
        return $this->criteriatype;
      }
      public function setCriteriaValue($criteriaValue_){
        $this->criteriavalue = $criteriaValue_;
      }
      public function getCriteriaValue(){
        return $this->criteriavalue;
      }
      
      
  }
?>
