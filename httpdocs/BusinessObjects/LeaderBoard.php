<?php
  class LeaderBoard{
    public static $tableName = "leaderboard";
    public static $className = "LeaderBoard";
    private $seq,$name,$leaderboardtype,$learningplanseq,$moduleseq,$createdon,$lastmodfiedon,$isenabled;
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
    
    public function setLeaderBoardType($type_){
        $this->leaderboardtype = $type_;
    }
    public function getLeaderBoardType(){
        return $this->leaderboardtype;
    }       
    
    public function setLearningPlanSeq($learningplanseq_){
        $this->learningplanseq = $learningplanseq_;
    }
    public function getLearningPlanSeq(){
        return $this->learningplanseq;
    }
    
    public function setModuleSeq($moduleseq_){
        $this->moduleseq = $moduleseq_;
    }
    public function getModuleSeq(){
        return $this->moduleseq;
    } 
    
    public function setCreatedOn($dateOfCreation_){
        $this->createdon = $dateOfCreation_;
    }
    public function getCreatedOn(){
        return $this->createdon;
    }
    
    public function setLastModifiedOn($lastModifiedOn_){
        $this->lastmodifiedon = $lastModifiedOn_;
    }
    public function getLastModifiedOn(){
        return $this->lastmodifiedon;
    }
    
    public function setIsEnabled($isEnabled_){
        $this->isenabled = $isEnabled_;
    }
    public function getIsEnabled(){
        return $this->isenabled;
    }              
  } 
?>
