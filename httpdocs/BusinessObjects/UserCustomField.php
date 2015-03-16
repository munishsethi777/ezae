<?php

  class UserCustomField{
      public static $tableName = "usercustomfields";
      private $seq,$companyseq,$name,$title,$description,$fieldtype,$adminseq,$isrequired;

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

      public function setName($name_){
        $this->name = $name_;
      }
      public function getName(){
        return $this->name;
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

      public function setFieldType($type_){
        $this->fieldtype = $type_;
      }

      public function getFieldType(){
        return $this->fieldtype;
      }
      
      public function setAdminSeq($adminseq_){
         $this->adminseq = $adminseq_;
      }

      public function getAdminSeq(){
         return $this->adminseq;
      }
      
      public function setIsRequired($isRequired_){
         $this->isrequired = $isRequired_;
      }
      public function getIsRequired(){
         return $this->isrequired;
      }

  }
?>
