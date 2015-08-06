<?php
  class Admin{
      public static $tableName = "admins";
      private $seq,$username,$password,$emailid,$companyseq,$name,$createdon,$isenabled,$lastmodifiedon,$mobileno,$issuper,$signupformheader,$ismanager,$parentadminseq;

      public function setSeq($seq_){
        $this->seq = $seq_;
      }
      public function getSeq(){
        return $this->seq;
      }
      
      public function setParentAdminSeq($parentAdminSeq_){
        $this->parentadminseq = $parentAdminSeq_;
      }
      public function getParentAdminSeq(){
        return $this->parentadminseq;
      }
      public function setIsManager($isManager_){
        $this->ismanager = $isManager_;
      }
      public function getIsManager(){
        return $this->ismanager;
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

      public function setName($name_){
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
      public function setLastModifiedOn($lastModifiedOn_){
        $this->lastmodifiedon = $lastModifiedOn_;
      }
      public function getLastModifiedOn(){
        return $this->lastmodifiedon;
      }
      public function setMobileNo($mobileNo_){
        $this->mobileno = $mobileNo_;
      }
      public function getMobileNo(){
        return $this->mobileno;
      }
      public function setIsSuper($isSuper_){
        $this->issuper = $isSuper_;
      }
      public function getIsSuper(){
        return $this->issuper;
      }
      public function setSignupFormHeader($header_){
        $this->signupformheader = $header_;
      }
      public function getSignupFormHeader(){
        return $this->signupformheader;
      }
  }
?>
