<?php
class SignupFormField{
    public static $tableName = "signupformfields";
    private $seq,$adminseq,$companyseq,$customfieldseq,$isrequired,$isvisible;

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
    
    public function setCustomFieldSeq($customfieldseq_){
        $this->customfieldseq = $customfieldseq_;
    }
    public function getCustomFieldSeq(){
        return $this->customfieldseq;
    }
    
    public function setIsRequired($isRequired_){
        $this->isrequired = $isRequired_;
    }
    public function getIsRequired(){
        return $this->isrequired;
    }
    
    public function setIsVisible($isVisible_){
        $this->isvisible = $isVisible_;
    }
    public function getIsVisible(){
        return $this->isvisible;
    }
}
?>
