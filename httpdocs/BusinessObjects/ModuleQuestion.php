<?php
    class ModuleQuestion{
        public static $tableName = "modulequestions";
        public static $className = "ModuleQuestion";
        private $seq,$moduleseq,$questionseq,$addedon;
        
        public function setSeq($seq_){
            $this->seq = $seq_;
        }
        public function getSeq(){
            return $this->seq;
        }
        
        public function setModuleSeq($moduleSeq_){
            $this->moduleseq = $moduleSeq_;
        }
        public function getModuleSeq(){
            return $this->moduleseq;
        }
        
        public function setQuestionSeq($questionSeq_){
            $this->questionseq = $questionSeq_;
        }
        public function getQuestionSeq(){
            return $this->questionseq;
        }
        
        public function setAddedOn($addedOn_){
            $this->addedon = $addedOn_;
        }
        public function getAddedOn(){
            return $this->addedon;
        }
    }
?>
