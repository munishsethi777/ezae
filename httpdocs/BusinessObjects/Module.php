<?php

  class Module{
      public static $tableName = "modules";
      private $seq,$dateofexpiry,$title,$description,$uploadedby,$createdon,$isenabled,$ispaid,$maxscore,$price,$passpercent,$lastmodifiedon;

      public function setSeq($seq_){
        $this->seq = $seq_;
      }
      public function getSeq(){
        return $this->seq;
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
      public function setIsPaid($paid_){
        $this->ispaid = $paid_;
      }
      public function getIsPaid(){
        return $this->ispaid;
      }
      public function setMaxScore($maxScore_){
        $this->maxscore = $maxScore_;
      }
      public function getMaxScore(){
        return $this->maxscore;
      }

      public function setPassPercent($passPercent_){
        $this->passpercent = $passPercent_;
      }
      public function getPassPercent(){
        return $this->passpercent;
      }
      public function setLastModifiedOn($lastModifiedOn_){
        $this->lastmodifiedon = $lastModifiedOn_;
      }
      public function getLastModifiedOn(){
        return $this->lastmodifiedon;
      }
  }

?>
