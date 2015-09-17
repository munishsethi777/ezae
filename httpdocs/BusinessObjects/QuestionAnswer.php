<?php
  class QuestionAnswer{
    
    private $seq,$questionseq,$title,$feedback,$marks;
    public static $classname = "QuestionAnswer";
    public static $tablename = "questionanswers";
    public function setSeq($seq_){
        $this->seq = $seq_;
    }   
    public function getSeq(){
        return $this->seq;
    }
    
    public function setQuestionSeq($QuestionSeq_){
        $this->questionseq = $QuestionSeq_;
    }   
    public function getQuestionSeq(){
        return $this->questionseq;
    }
    
    public function setTitle($title_){
        $this->title = $title_;
    }   
    public function getTitle(){
        return $this->title;
    }
    
    public function setFeedback($feedback_){
        $this->feedback = $feedback_;
    }   
    public function getFeedback(){
        return $this->feedback;
    }
    
    public function setMarks($marks_){
        $this->marks = $marks_;
    }   
    public function getMarks(){
        return $this->marks;
    }
    
  }
?>