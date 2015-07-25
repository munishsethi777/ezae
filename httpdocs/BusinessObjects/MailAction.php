<?php
  class MailAction{
      private $seq,$messageid,$sendondate,$messagecondition,$gettingmarksvalue,$moduleseq,$learningplanseq;
      public static $tableName = "mailmessageaction";
      public static $className = "MailAction";
      
      public function setSeq($seq_){
        $this->seq = $seq_;
      }
      public function getSeq(){
        return $this->seq;
      }
      
      public function setMessageId($messageid){
        $this->messageid = $messageid;
      }
      public function getMessageId(){
        return $this->messageid;
      }
      
      public function setSendOnDate($sendOnDate_){
        $this->sendondate = $sendOnDate_;
      }
      public function getSendOnDate(){
        return $this->sendondate;
      }
      
      public function setMessageCondition($condition_){
        $this->messagecondition = $condition_;
      }
      public function getMessageCondition(){
        return $this->messagecondition;
      }
      
      public function setGettingMarksValue($gettingmarksvalue_){
        $this->gettingmarksvalue = $gettingmarksvalue_;
      }
      public function getGettingMarksValue(){
        return $this->gettingmarksvalue;
      }
      
      public function setModuleSeq($moduleseq_){
        $this->moduleseq = $moduleseq_;
      }
      public function getModuleSeq(){
        return $this->moduleseq;
      }
      
      public function setLearningPlanSeq($LearningSeq_){
        $this->learningPlanSeq = $LearningSeq_;
      }
      public function getLearningPlanSeq(){
        return $this->learningPlanSeq;
      }
      
  }
?>
