<?php
  class CompanyModule{
        private $seq,$companyseq,$adminseq,$moduleseq,$addedon;
        public static $tableName = "companymodules";
        public static $className = "CompanyModule";
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
        
        public function setCompanySeq($companyseq_){
            $this->companyseq = $companyseq_;
        }         
        public function getCompanySeq(){
            return $this->companyseq;
        }
        
        public function setModuleSeq($moduleSeq_){
            $this->moduleseq = $moduleSeq_;
        }
        public function getModuleSeq(){
            return $this->moduleseq;
        }
        
        public function setAddedOn($addedOn_){
            $this->addedon = $addedOn_;
        }
        public function getAddedOn(){
            return $this->addedon;
        }
        
        
  }
?>