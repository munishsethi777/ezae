<?php
  class Manager{
      private $seq,$companyseq,$adminseq,$name,$email,$password,$mobile,$isenabled,$createdon,$lastmodifiedon;
      
        public function setSeq($seq_){
            $this->seq = $seq_;
        }
        
        public function getSeq(){
            return $this->seq;
        }
        
        public function setAdminSeq($adminSeq_){
            $this->adminseq = $adminSeq_;
        }
        public function getAdminSeq(){
            return $this->adminseq;
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
        public function setEmail($emailId_){
            $this->email = $emailId_;
        }
        public function getEmail(){
            return $this->email;
        }
        public function setPassword($password_){
          $this->password = $password_;
        }
        public function getPassword(){
          return $this->password;
        }
        
        public function setMobileNo($mobile_){
            $this->mobile = $mobile_;
        }
        public function getMobileNo(){
            return $this->mobile;
        }
        public function setIsEnabled($isEnabled_){
            $this->isenabled = $isEnabled_;
        }
        public function getIsEnabled(){
            return $this->isenabled;
        }
        public function setCreatedOn($dateOfCreation_){
            $this->createdon = $dateOfCreation_;
        }
        public function getCreatedOn(){
            return $this->createdon;
        }
        public function setLastModifiedOn($lastModifiedOn_){
          $this->lastmodfiedon = $lastModifiedOn_;
        }
        public function getLastModifiedOn(){
          return $this->lastmodfiedon;          
        }
  }
?>
