<?php
require_once("BeanDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/MailMessage.php");
class MailMessageMailDataStore extends BeanDataStore {
    private static $mailMessageMailStore;
    public static function getInstance()
    {
        if (!self::$mailMessageMailStore)
        {
            self::$mailMessageMailStore = new MailMessageMailDataStore(MailMessageMail::$className,MailMessageMail::$tableName);
            return self::$mailMessageMailStore;
        }
        return self::$mailMessageMailStore;
    }
    
    public function getPendingMessages(){
        $sql = "select * from mailmessagemails where status = 'pending' and failurecounter < 3 and Date(mailMessageMails.sendon) <= SYSDATE() " ;
        $mailMessageMails = self::executeObjectQuery($sql);
        return $mailMessageMails;  
    }     
} 
?>
