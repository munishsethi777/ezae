<?php
  class Question{
    private $seq,$title,$maxmarks,$timeallowed,$questiontype,$adminseq,$companyseq,$createdon,$isenabled,$lasmodifiedon;
    public static $classname = "Question";
    public static $tablename = "questions";
    public function setSeq($seq_){
        $this->seq = $seq_;
    }   
    public function getSeq(){
        return $this->seq;
    }
    
    public function setTitle($title_){
        $this->title = $title_ ;
    }
    public function getTitle(){
        return $this->title;
    }
    
    public function setMaxMarks($marks_){
        $this->maxmarks = $marks_;
    }
    public function getMaxMarks(){
        return  $this->maxmarks;
    }
    
    public function setTimeAllowed($timeAllowed_){
        $this->timeallowed = $timeAllowed_;
    }
    public function getTimeAllowed(){
        return $this->timeallowed;
    }
    
    public function setQuestionType($questionType_){
        $this->questiontype = $questionType_;
    }
    public function getQuestionType(){
        return $this->questiontype;
    }
    
    public function setAdminSeq($adminseq_){
        $this->adminseq = $adminseq_;
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
     public function setLastModifiedOn($lastModifiedOn_){
        $this->lastmodifiedon = $lastModifiedOn_;
     }
     public function getLastModifiedOn(){
        return $this->lastmodifiedon;
     }
     
     public function setCreatedOn($dateOfCreation_){
        $this->createdon = $dateOfCreation_;
     }
     public function getCreatedOn(){
        return $this->createdon;
     }
     
     public function setIsEnabled($isEnalbed_){
        $this->isenabled = $isEnalbed_;
     }
     public function getIsEnabled(){
        return $this->isenabled; 
     }
   
  }
?>
