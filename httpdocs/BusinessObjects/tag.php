<?php
  class tag {
        private $seq,$tag,$adminseq,$companyseq,$createdon ;
        public function setSeq($seq_){
            $this->seq = $seq_;
        }

        public function getSeq(){
            return $this->seq;
        }
        
        public function setTag($tag_){
            $this->tag = $tag_;
        }

        public function getTag(){
            return $this->tag;
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
        
        public function setCreatedOn($dateOfCreation_){
            $this->createdon = $dateOfCreation_;
        }
        public function getCreatedOn(){
            return $this->createdon;
        }
        
  }
?>
