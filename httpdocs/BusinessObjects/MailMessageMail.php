<?php
  class MailMessageMail{

    private $seq, $userseq, $mailmessageactionseq, $adminseq, $savedon, $senton, $status, $failurecounter, $failureerror;

    public static $tableName = "mailmessagemails";
    public static $className = "MailMessageMail";

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

    public function setMailMessageActionSeq($mailMessageActionSeq_){
    $this->mailmessageactionseq = $mailMessageActionSeq_;
    }
    public function getMailMessageActionSeq(){
    return $this->mailmessageactionseq;
    }

    public function setAdminSeq($adminSeq_){
        $this->adminseq = $adminSeq_;
    }
    public function getAdminSeq(){
        return $this->adminseq;
    }

    public function setSavedOn($savedon_){
        $this->savedon = $savedon_;
    }
    public function getSavedOn(){
        return $this->savedon;
    }

    public function setSentOn($sentOn_){
        $this->senton = $sentOn_;
    }
    public function getSentOn(){
        return $this->senton;
    }

    public function setStatus($status_){
        $this->status = $status_;
    }
    public function getStatus(){
        return $this->status;
    }

    public function setFailureCounter($failurecounter_){
        $this->failurecounter = $failurecounter_;
    }
    public function getFailureCounter(){
        return $this->failurecounter;
    }

    public function setFailureError($failureerror_){
        $this->failureerror = $failureerror_;
    }
    public function getFailureError(){
        return $this->failureerror;
    }

  }
?>
