<?php
require_once("BeanDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/MailAction.php");
require_once($ConstantsArray['dbServerUrl']. "Utils/MessageConditions.php");
class MailMessageActionDataStore extends BeanDataStore {
    private static $mailMessageActionDataStore;
    public static function getInstance()
    {
        if (!self::$mailMessageActionDataStore)
        {
            self::$mailMessageActionDataStore = new MailMessageActionDataStore(MailAction::$className,MailAction::$tableName);
            return self::$mailMessageActionDataStore;
        }
        return self::$mailMessageActionDataStore;
    }
    
         
     public function getMailMessageForOnMarksCondition($learningPlanSeq,$moduleSeq){
        $condition = MessageConditions::ON_MARKS;
        $sql = "select * from mailmessageaction where learningplanseq = $learningPlanSeq and moduleseq = $moduleSeq and messagecondition like ('%$condition%') ";
        $mailMessage = self::executeQuery($sql);
        if(!empty($mailMessage)){
            return $mailMessage[0]; 
        }
        return null;                
     }
     public function getMailMessageForOnParticulerDate($learningPlanSeq){
        $condition = MessageConditions::ON_PARTICULER_DATE;
        $sql = "select * from mailmessageaction where learningplanseq = $learningPlanSeq and messagecondition like ('%$condition%') ";
        $mailMessage = self::executeQuery($sql);
        if(!empty($mailMessage)){
            return $mailMessage[0]; 
        }
        return null;        
     }
     public function getMailMessageForOnModuleCompletion($learningPlanSeq,$moduleSeq){
        $condition = MessageConditions::ON_COMPLETION;
        $sql = "select * from mailmessageaction where learningplanseq = $learningPlanSeq and moduleseq = $moduleSeq and messagecondition like ('%$condition%') ";
        $mailMessage = self::executeQuery($sql);
        if(!empty($mailMessage)){
           return $mailMessage[0]; 
        }
        return null;        
     }
     public function getMailMessageForModuleEnrollment($moduleSeqs){
        $moduleSeqs = implode(",",$moduleSeqs);
        $condition = MessageConditions::ON_ENROLLMENT;
        $sql = "select * from mailmessageaction where moduleseq in ($moduleSeqs) and messagecondition like ('%$condition%') ";
        $mailMessage = self::executeQuery($sql);
       // if(!empty($mailMessage)){
//           return $mailMessage[0]; 
//        }
        return $mailMessage;        
     } 
}
?>
