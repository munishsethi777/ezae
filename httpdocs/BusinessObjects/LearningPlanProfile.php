<?php
    class LearningPlanProfile{
        
        public static $tableName = "learningplanprofiles";
        public static $className = "LearningPlanProfile";
      
        private $seq,$learningplanseq,$learningprofileseq;

        public function setSeq($seq_){
            $this->seq = $seq_;
        }
        public function getSeq(){
            return $this->seq;
        }
        public function setLearningPlanSeq($learningPlanSeq_){
            $this->learningplanseq = $learningPlanSeq_;
        }
        public function getLearningPlanSeq(){
            return $this->learningplanseq;
        }
        
        public function setLearningProfileSeq($learningProfileSeq_){
            $this->learningprofileseq = $learningProfileSeq_;
        }
        public function getLearningProfileSeq(){
            return $this->learningprofileseq;
        }

    }
?>
