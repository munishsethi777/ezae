<?php
require_once("BeanDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/MailMessage.php");
class MailMessageDataStore extends BeanDataStore {
    private static $mailMessageStore;
    public static function getInstance()
    {
        if (!self::$mailMessageStore)
        {
            self::$mailMessageStore = new MailMessageDataStore(MailMessage::$className,MailMessage::$tableName);
            return self::$mailMessageStore;
        }
        return self::$mailMessageStore;
    }
    
    public function getMailMessagesForGrid($isApplyFilter = false){
        $isApplyFilter = true;
        $mailMessages = $this->executeQuery("select mm.*,mma.sendondate,mma.messagecondition,mma.gettingmarksvalue as percent, mma.moduleseq,lp.seq as lpseq,lp.title, m.title as modulename from mailmessage mm inner join mailmessageaction mma on mm.seq  = mma.messageid left outer join learningplans lp on mma.learningplanseq = lp.seq left outer join modules m on mma.moduleseq = m.seq ",$isApplyFilter);
        return $mailMessages;
    }
    
    public function getMailMessageLogsForGrid($adminseq){
        $isApplyFilter = true;
        $mailMessages = $this->executeQuery("select u.username,mmm.*,mm.* from mailmessagemails mmm inner join mailmessageaction mma on mmm.messageactionseq = mma.seq inner join mailmessage mm on mma.messageid = mm.seq inner join users u on mmm.userseq = u.seq where mmm.adminseq = $adminseq ",$isApplyFilter);
        return $mailMessages;
    }
    
    public function getMailMessagesByMailMessageAction($mailMessageActionSeq){
        $mailMessage = $this->executeObjectQuery("select mm.* from mailmessage mm inner join mailmessageaction mma on mm.seq = mma.messageid where mma.seq = $mailMessageActionSeq");
        if(!empty($mailMessage)){
            return $mailMessage[0];
        }
        return null;
    }
}
?>
