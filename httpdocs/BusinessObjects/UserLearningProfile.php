<?php
  class UserLearningProfile{
    private $seq,$userseq,$adminseq,$tagseq;
    
     public function setSeq($seq_){
        $this->seq = $seq_;
      }
      public function getSeq(){
        return $this->seq;
      }
      
      public function setUserSeq($userSeq_){
        $this->userseq = $userSeq_;
      }
      public function getUserSeq(){
        return $this->userseq;
      }
      
      public function setAdminSeq($adminSeq_){
        $this->adminseq = $adminSeq_;
      }
      public function getAdminSeq(){
        return $this->adminseq;
      }
      
      public function setTagSeq($tagSeq_){
        $this->tagSeq = $tagSeq_;
      }
      public function getTagSeq(){
        return $this->tagSeq;
      }    
  }
?>
