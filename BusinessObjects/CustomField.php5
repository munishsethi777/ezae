<?php
  class CustomField{
      private $seq,$userSeq,$name,$title,$description,$type;  
      
      public function setSeq($seq_){
        $this->seq = $seq_;
      }
      public function getSeq(){
        return $this->seq;
      }
      
      public function setUserSeq($UserSeq_){
        $this->userSeq = $UserSeq_;
      }
      public function getUserSeq(){
        return $this->userSeq;
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
        $this->type = $type;
      }
      
      public function getFieldType(){
        return $this->type;
      }
      
  }
?>
