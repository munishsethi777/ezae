<?php
require_once("BeanDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/SignupFormField.php");
  
class SignupFormFieldDataStore extends BeanDataStore{       
    private static $signupFormFieldDataStore;

    public static function getInstance()
        {
        if (!self::$signupFormFieldDataStore)
        {
            self:: $signupFormFieldDataStore = new SignupFormFieldDataStore("SignupFormField",SignupFormField::$tableName);           
            return self::$signupFormFieldDataStore;
        }
        return self::$signupFormFieldDataStore;        
    }



    public function findByCompany($companySeq){
        $query = "Select cf.seq, cf.companyseq , cf.name, cf.title, cf.fieldtype ,ff.isrequired , ff.isvisible from usercustomfields cf inner join signupformfields ff on cf.seq = ff.customfieldseq";
        $query .= " where ff.companyseq = $companySeq";
        $arrList = $this->executeQuery($query);
        return $arrList;
    }
    
    public function findByAdmin($adminseq){
        $query = "Select cf.seq, cf.companyseq , cf.name, cf.title, cf.fieldtype ,ff.isrequired , ff.isvisible from usercustomfields cf inner join signupformfields ff on cf.seq = ff.customfieldseq";
        $query .= " where ff.adminseq = $adminseq";
        $arrList = $this->executeQuery($query);
        return $arrList;
    }
    
    public function deleteAll(){
        self::deleteAllByCompany();
    }


   

}
?>
