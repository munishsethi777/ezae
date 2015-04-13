<?php
  class Company{

      public static $tableName = "companies";
      private $seq,$name,$description,$emailid,$mobileno,$contactperson,$createdon,$isenabled,$address,$phone,$prefix;

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

      public function setDescription($description_){
        $this->description = $description_;
      }
      public function getDescription(){
        return $this->description;
      }

      public function setEmailId($emailId_){
        $this->emailid = $emailId_;
      }
      public function getEmailId(){
        return $this->emailid;
      }

      public function setMobileNo($mobileNo_){
        $this->mobileno = $mobileNo_;
      }
      public function getMobileNo(){
        return $this->mobileno;
      }

      public function setContactPerson($contactPerson_){
        $this->contactperson = $contactPerson_;
      }
      public function getContactPerson(){
        return $this->contactperson;
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
      
      public function setAddress($address_){
        $this->address = $address_;
      }
      public function getAddress(){
        return $this->address;
      }
      
      public function setPhone($phone_){
        $this->phone = $phone_;
      }
      public function getPhone(){
        return $this->phone;
      }
      
      public function setPrefix($prefix_){
        $this->prefix = $prefix_;
      }
      public function getPrefix(){
        return $this->prefix;
      }

     }




?>
