<?php
class MatchingRule{
    
    public static $tableName = "matchingrules";
    public static $className = "MatchingRule";
    private $seq,$usernamefield,$emailfield,$passwordfield,$companyseq,$adminseq;
    
    public function setSeq($seq_){
        $this->seq = $seq_;
    }
    public function getSeq(){
        return $this->seq;
    }
    
    public function setUserNameField($userNameField_){
        $this->usernamefield = $userNameField_;
    }
    public function getUserNameField(){
        return $this->usernamefield;
    }
    
    public function setEmailField($emailField_){
        $this->emailfield = $emailField_;
    }
    public function getEmailField(){
        return $this->emailfield;
    } 
    
    public function setPasswordField($passwordField_){
        $this->passwordfield = $passwordField_;
    }
    public function getPasswordField(){
        return $this->passwordfield;
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
    
          
}
?>
