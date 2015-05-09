<?php
  class LearningPlan{
        public static $tableName = "learningplans";
         public static $className = "LearningPlan";
        private $seq,$adminseq,$companyseq,$title,$description,$isleaderboard,$issequencelocked,$isactive,$activateon,$deactivateon,$createdon,$lastmodifiedon;
        
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
        
        public function setIsActive($isActive_){
            $this->isactive = $isActive_;
        }
        public function getIsActive(){
            return $this->isactive;
        }
        public function setActivateOn($activateOn_){
            $this->activateon = $activateOn_;
        }
        public function getActivateOn(){
            return $this->activateon;
        }
        public function setDeactivateOn($deactivateOn_){
            $this->deactivateon = $deactivateOn_;
        }
        public function getDeactivateOn(){
            return $this->deactivateon;
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
        
        public function setIsSequenceLocked($isSequenceLocked_){
            $this->issequencelocked = $isSequenceLocked_;
        }
        public function getIsSequenceLocked(){
            return $this->issequencelocked;
        }
  }
?>
