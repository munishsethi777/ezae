<?php
 require_once($ConstantsArray['dbServerUrl']. "Utils/MessageStatus.php");
 require_once($ConstantsArray['dbServerUrl']. "DataStores/MailMessageMailDataStore.php");
  class MailMessageMailMgr{
     private static $mailMessageMailMgr;
     private static $dataStore;
     public static function getInstance()
     {
        if (!self::$mailMessageMailMgr)
        {
            self::$mailMessageMailMgr = new MailMessageMailMgr();
            self::$dataStore = new MailMessageMailDataStore(MailMessageMail::$className,MailMessageMail::$tableName);
            return self::$mailMessageMailMgr;
        }
        return self::$mailMessageMailMgr;
     }
     
     public function save($mailMessageMail){
         $id = self::$dataStore->save($mailMessageMail);
         return $id;
     }
     
     public function getPendingMessages(){         
       $mailMessageMails = self::$dataStore->getPendingMessages();
       return $mailMessageMails;
     }     
  }
?>
