<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Company.php");  
require_once($ConstantsArray['dbServerUrl'] ."Managers/AdminMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/CompanyDataStore.php");       
class CompanyMgr{
    
    private static $companyMgr;

    public static function getInstance()
    {
        if (!self::$companyMgr)
        {
            self::$companyMgr = new CompanyMgr();
        }
        return self::$companyMgr;
    }
    public function SignUpCompany(){
        $name = $_GET["name"];
        $description = $_GET["description"];
        $email = $_GET["email"];
        $mobile = $_GET["mobileno"];
        $contactPerson = $_GET["contactperson"];
        $address = $_GET["address"];
        $phone =   $_GET["phone"];
        
        $company = new Company();
        $company->setName($name);
        $company->setDescription($description);
        $company->setEmailId($email);
        $company->setMobileNo($mobile);
        $company->setContactPerson($contactPerson);
        $company->setAddress($address);
        $company->setPhone($phone);
        $company->setIsEnabled(true);
        $company->setCreatedOn(new DateTime());
        
        $CDS = CompanyDataStore::getInstance();
        $id = $CDS->save($company);
        $adminMgr = new AdminMgr();
        $adminMgr->saveAdmin($id);       
        
    }   
}
     
    
?>
