<?php
  class MailMessageLearningProfile{
      private $seq,$messageid,$learningprofileid;
      public static $tableName = "mailmessagelearningprofiles";
      public static $className = "MailMessageLearningProfile";
      
      public function setSeq($seq_){
        $this->seq = $seq_;
      }
      public function getSeq(){
        return $this->seq;
      }
      
      public function setMessageId($messageid_){
        $this->messageid = $messageid_;
      }
      public function getMessageId(){
        return $this->messageid;
      }
      
      public function setLearningProfileId($learningprofileseq_){
        $this->learningprofileid = $learningprofileseq_;
      }
      public function getLearningProfileId(){
        return $this->learningprofileid;
      }
 
  }
?>
