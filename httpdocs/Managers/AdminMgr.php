<?php
require_once($ConstantsArray['dbServerUrl']. "DataStores\\AdminDataStore.php5");
      
class AdminMgr{
      public function logInAdmin($username, $password){
            $adminDataStore = AdminDataStore::getInstance();
            $admin = $adminDataStore->findByUserName($userName);
            if($admin == null){
                return "No User Found";
            }
      }
}
?>
