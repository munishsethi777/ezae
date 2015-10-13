<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Company.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/AdminMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/CompanyDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php5");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CompanyModule.php");
class CompanyMgr{

    private static $companyMgr;
    private static $companyModuleDataStore;
    public static function getInstance()
    {
        if (!self::$companyMgr)
        {
            self::$companyMgr = new CompanyMgr();
            self::$companyModuleDataStore = new BeanDataStore(CompanyModule::$className,CompanyModule::$tableName); 
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
        $isUpdate = "";
        if(isset($_GET["isUpdate"])){
             $isUpdate = $_GET["isUpdate"];
        }
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
        if($isUpdate == "true"){
            $sessionUtil = SessionUtil::getInstance();
            $seq = $sessionUtil->getAdminLoggedInCompanySeq();
            $company->setSeq($seq);
        }
        $this->checkVaidations($company);
        $adminMgr = new AdminMgr();
        $admin = $adminMgr->getAdminObjectFromRequest();
        $adminMgr->checkValidations($admin);
        $CDS = CompanyDataStore::getInstance();
        $id = $CDS->save($company);       
        $adminMgr->saveAdmin($admin,$id);
    }
    
    
    private function checkVaidations($company){
        if($this->isExist($company,$company->getEmailId(),"emailid")){
            throw new Exception(StringConstants::EMAIL_EXIST);
        } 
        if($this->isExist($company,$company->getMobileNo(),"mobileno")){
            throw new Exception(StringConstants::MOBILE_EXIST);
        }       
    }
    private function isExist($company,$value,$attrName){
        $seq = $company->getSeq();
        $att[0] = $attrName;
        $att[1] = "seq";
        $colVal[$attrName] = $value;
        $CDS = CompanyDataStore::getInstance();
        $existingCompany = $CDS->executeAttributeQuery($att,$colVal);
        $isExist = false;
        if(!empty($existingCompany)){   
            if(empty($seq) || $seq != $existingCompany[0]["seq"]){
                $isExist = true;        
            }
        }
        return $isExist;
    }
   private function isAdminExist($admin,$attrName){
        $seq = $company->getSeq();
        $att[0] = $attrName;
        $att[1] = "seq";
        $colVal[$attrName] = $company->getEmailId();
        $CDS = CompanyDataStore::getInstance();
        $existingCompany = $CDS->executeAttributeQuery($att,$colVal);
        $isExist = false;
        if(!empty($existingCompany)){   
            if(empty($seq) || $seq != $existingCompany[0]["seq"]){
                $isExist = true;        
            }
        }
        return $isExist;
    }
    public function getCompanyBySeq($companySeq){
        $CDS = CompanyDataStore::getInstance();
        $company =  $CDS->FindBySeq($companySeq);
        return $company;
    }

    public function getCompanyPrefix($companySeq){
        $CDS = CompanyDataStore::getInstance();
        $prefix =  $CDS->getPrefix($companySeq);
        return $prefix;
    }

    public function updateCompanyPrefix($companySeq,$prefix){
        $CDS = CompanyDataStore::getInstance();
        $prefix =  $CDS->updateCompanyPrefix($companySeq,$prefix);
    }
    
    public function saveCompanyModule($moduleId){
        $sessionUtil = SessionUtil::getInstance();
        $adminSeq = $sessionUtil->getAdminLoggedInSeq();
        $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
        $companyModule = new CompanyModule();
        $companyModule->setAddedOn(new DateTime());
        $companyModule->setAdminSeq($adminSeq);
        $companyModule->setCompanySeq($companySeq);
        $companyModule->setModuleSeq($moduleId);
        $this->deleteCompanyModule($moduleId);       
        self::$companyModuleDataStore->save($companyModule);
    }
    public function deleteCompanyModule($moduleId){
        $sessionUtil = SessionUtil::getInstance();
        $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
        $colValues["companyseq"]  =  $companySeq;
        $colValues["moduleseq"] = $moduleId;
        self::$companyModuleDataStore->deleteByAttribute($colValues);
    }



}


?>
