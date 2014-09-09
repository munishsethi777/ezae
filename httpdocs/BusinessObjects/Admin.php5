<?php
  class Admin{
      public static $tableName = "admins";
      private $seq,$username,$password,$emailid,$companyseq,$name,$createdon,$isenabled;

      public function setSeq($seq_){
        $this->seq = $seq_;
      }
      public function getSeq(){
        return $this->seq;
      }
      
      public function setUserName($username_){
        $this->username = $username_;
      }
      public function getUserName(){
        return $this->username;
      }
      
      public function setPassword($password_){
        $this->password = $password_;
      }
      public function getPassword(){
        return $this->password;
      }  
      
      public function setEmailId($emailId_){
        $this->emailid = $emailId_;
      }
      public function getEmailId(){
        return $this->emailid;
      }
      
      public function setCompanySeq($companySeq_){
        $this->companyseq = $companySeq_;
      }
      public function getCompanySeq(){
        return $this->companyseq;
      }
      
      public function setName($name){
        $this->name = $name_;
      }
      public function getName(){
        return $this->name;
      }
      
      public function setCreatedOn($dateOfJoining_){
        $this->createdon = $dateOfJoining_;
      }
      public function getCreatedOn(){
        return $this->createdon;
      }
      public function setIsEnabled($isEnabled_){
        $this->isenabled = $isEnabled_;
      }
      public function getIsEnabled(){
        return $this->isenabled;
      } 
  }
?>
