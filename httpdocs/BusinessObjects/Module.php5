<?php
  
  class Module{
      public static $tableName = "modules";
      private $seq,$companyseq,$dateofexpiry,$title,$description,$uploadedby,$createdon,$isenabled;
      
      public function setSeq($seq_){
        $this->seq = $seq_;
      }
      public function getSeq(){
        return $this->seq;
      }
      
      public function setCompanySeq($companySeq_){
        $this->companyseq = $companySeq_;
      }
      public function getCompanySeq(){
        return $this->companyseq;
      }
      
      public function setDateOfExpiry($dateOfExpiry_){
        $this->dateofexpiry = $dateOfExpiry_;
      }
      public function getDateOfDateOfExpiry(){
        return $this->dateofexpiry;
      }
      
      public function setTitle($title_){
          $this->title = $title_;
      }
      public function getTitle(){
          return $this->title;
      }
       
      public function setDescription($description_){
        $this->description = $description_;
      }
      public function getDescription(){
        return $this->description;
      }
      
      public function setUploladedBy($uploadedBy_){
          $this->uploadedby = $uploadedBy_;
      }
      public function getUploadedBy(){
          return $this->uploadedby;
      }
      
      public function setCreatedOn($dateOfCreation_){
        $this->createdon = $dateOfCreation_;
      }
      public function getCreatedOn(){
        return $this->createdon;
      }
      
      public function setIsEnabled($enabled_){
        $this->isenabled = $enabled_;
      }
      public function getIsEnabled(){
        return $this->isenabled;
      }
  }

?>
