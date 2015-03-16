<?php
  class LearningPlan{
        public static $tableNames = "learningplans";
        private $seq,$adminseq,$companyseq,$title,$description,$isleaderboard,$issequencelocked,$isenabled,$expiringon,$createdon,$lastmodifiedon;
        
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
        
        public function setIsLeaderBoard($leaderBoard_){
            $this->isleaderboard = $leaderBoard_;
        }
        public function getIsLeaderBoard(){
            return $this->isleaderboard;
        }
        
        public function setIsSequence($isSequenceLocked_){
            $this->issequencelocked = $isSequenceLocked_;
        }
        public function getIsSequence(){
            return $this->issequencelocked;
        }
        
        public function setIsEnabled($isEnabled_){
            $this->isenabled = $isEnabled_;
        }
        public function getIsEnabled(){
            return $this->isenabled;
        }
        
        public function setExpiringOn($expiringOn_){
            $this->expiringon = $expiringOn_;
        }
        public function getExpiringOn(){
            return $this->expiringon;
        }
        
        public function setCreatedOn($createdOn_){
            $this->createdon = $createdOn_;
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
  }
?>
