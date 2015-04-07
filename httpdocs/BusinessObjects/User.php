<?php
  class User{
      public static $tableNames = "users";
      private $seq,$username,$password,$emailid,$companyseq,$customfieldvalues,$createdon,$isenabled,$lastmodifiedon,$adminseq;

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

      public function setCustomFieldValues($customFieldValues_){
        $this->customfieldvalues = $customFieldValues_;
      }
      public function getCustomFieldValues(){
        return $this->customfieldvalues;
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
      
      public function setLastModifiedOn($lastModifiedOn_){
          $this->lastmodifiedon = $lastModifiedOn_;
      }
      public function getLastModifiedOn(){
          return $this->lastmodifiedon;          
      }
      
      public function setAdminSeq($adminSeq_){
        $this->adminseq = $adminSeq_;
      }
      public function getAdminSeq(){
        return $this->adminseq;
      }
  }
?>
