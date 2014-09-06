<?php
  require_once("BeanDataStore.php5");
  require_once("UserDataStore.php5");
  require_once("ActivityDataStore.php5");
  require_once("CompanyDataStore.php5");
  require_once("ModuleDataStore.php5");
  require_once("../BusinessObjects/User.php5");
  require_once("../BusinessObjects/Company.php5");
  require_once("../BusinessObjects/Module.php5");
   require_once("../BusinessObjects/Activity.php5"); 
  testUserDataStore();
  $query_array = array();
  $col = array("customfieldvalues");
  $query_array['seq'] = 1;
 // $query_array['username'] = "testUser1";
 // $query_array['password'] = "rrrr";
  $beanDataStore = new BeanDataStore("User");
  $objList = $beanDataStore->executeAttributeQuery($col,$query_array);
  $obj = $objList[0]["customfieldvalues"];
  
  function testUserDataStore(){
     $a = ActivityDataStore::getInstance();
     $m = ModuleDataStore::getInstance();
     $c = CompanyDataStore::getInstance();
     $userdataStore = UserDataStore::getInstance();
     $user =  new User();
     $user->setCompanySeq(1);
     $user->setUserName("test");
     $user->setCreatedOn(new DateTime());
     $user->setEmailId("baljeet@gmail.com");
     $user->setIsEnabled(true);
     $user->setCustomFieldValues("customFieldValues");
     //$userdataStore->save($user);
     
     $userObj = $userdataStore->findByUserName("test");
     $CustomField = $userdataStore->findCustomfield(1);
  }
?>
