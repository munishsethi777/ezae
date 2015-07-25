<?php
  class MailMessage {
      public static $tableName = "mailmessage";
      public static $className = "MailMessage";
      private $seq,$name,$subject,$message;
      public function setSeq($seq_){
        $this->seq = $seq_;
      }
      public function getSeq(){
        return $this->seq;
      }

      public function setName($name_){
        $this->name = $name_;
      }
      public function getName(){
        return $this->name;
      }
      
      public function setSubject($subject_){
        $this->subject = $subject_;
      }
      public function getSubject(){
        return $this->subject;
      }
      
      public function setMessage($message_){
        $this->message = $message_;
      }
      public function getMessage(){
        return $this->message;
      }
  }
?>
