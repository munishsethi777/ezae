<?php
  class MailMessageMgr{
    private static $mailMessageMgr;
    private static $dataStore;
    private static $adminSeq;
    private static $companySeq;
    private static $sessionUtil;
    private static $mailMessageActionDataStore;
    private static $mailMessageLearningProfileDataStore;
    
     public static function getInstance()
     {
        if (!self::$mailMessageMgr)
        {
            self::$mailMessageMgr = new MailMessageMgr();
            self::$dataStore = new MailMessageDataStore(MailMessage::$className,MailMessage::$tableName);
            self::$mailMessageActionDataStore  = new BeanDataStore(MailAction::$className,MailAction::$tableName);
            self::$mailMessageLearningProfileDataStore = new BeanDataStore(MailMessageLearningProfile::$className,MailMessageLearningProfile::$tableName);
            self::$sessionUtil = SessionUtil::getInstance();   
            self::$adminSeq = self::$sessionUtil->getAdminLoggedInSeq(); 
            self::$companySeq = self::$sessionUtil->getAdminLoggedInCompanySeq();           
            return self::$mailMessageMgr;
        }
        return self::$mailMessageMgr;
     }
     
     public function getMailMessageForGrid(){
        $isApplyFilter = true; 
        $mailMessages =  self::$dataStore->getMailMessagesForGrid($isApplyFilter);
        $fullArr = array();        
        foreach($mailMessages as $mailMessage){
            $seq = $mailMessage["seq"];
            $lpSeqs = $mailMessage["lpseq"];
            $moduleSeqs = $lpSeqs . "_" . $mailMessage["moduleseq"];
            $moduleNames = $mailMessage["modulename"];      
            if(array_key_exists ($seq, $fullArr)){
                $mmArr =  $fullArr[$seq];
                $learningPlans = $mmArr["learningplans"] . " , " . $mailMessage["title"];
                $lpSeqs = $mmArr["lpSeqs"] . "," . $lpSeqs;
                $moduleSeqs = $mmArr["moduleSeqs"] . "," . $moduleSeqs;
                $mmArr["moduleSeqs"] = $moduleSeqs;
                if(isset($mmArr["moduleNames"])){
                    $moduleNames = $mmArr["moduleNames"] . " , " . $mailMessage["modulename"];    
                }
                $mmArr["moduleNames"] = $moduleNames;                            
                $mmArr["lpSeqs"] = $lpSeqs;
                $mmArr["learningplans"] = $learningPlans;
                $mmArr["condition"] = $this->getCondition($mailMessage,$mmArr); //$mailMessage["messagecondition"];//
                $fullArr[$seq]  =  $mmArr;
                
                continue;  
            }
            $mmArr = array();            
            $mmArr["id"] = $seq;
            $mmArr["name"] = $mailMessage["name"];
            $mmArr["subject"] = $mailMessage["subject"];
            $mmArr["messageText"] = $mailMessage["message"];
            $mmArr["lpSeqs"] = $lpSeqs;
            $mmArr["moduleSeqs"] = $moduleSeqs;
            $mmArr["moduleNames"] = $moduleNames;            
            $mmArr["dated"] = $mailMessage["sendondate"];;
            $mmArr["condition"] = $this->getCondition($mailMessage,$mmArr);//$mailMessage["messagecondition"];//
            $mmArr["status"] = "";
            $mmArr["percent"] = $mailMessage["percent"];
            $mmArr["learningplans"] = $mailMessage["title"];
            $fullArr[$seq]  =  $mmArr;
            //array_push($fullArr,$mmArr);
        }
        $gridData["Rows"] = array_values($fullArr);
        $gridData["TotalRows"] = self::$dataStore->executeCountQuery(null,$isApplyFilter);
        return json_encode($gridData);
     }
     private function getCondition($mailMessage,$mmArr){
        $condition = $mailMessage["messagecondition"];
        $percent = $mailMessage["percent"];
        if($condition == MessageConditions::ON_PARTICULER_DATE){
            $sendOnDate = $mailMessage["sendondate"];
            $sendOnDate = DateUtil::StringToDateByGivenFormat("Y-m-d H:i:s",$sendOnDate);
            $condition = date_format($sendOnDate, 'jS F Y \a\t g:i a');                
        }else {            
            $moduleNames = $mmArr["moduleNames"];
            if($condition == MessageConditions::ON_ENROLLMENT){
                $condition = "Enrollment in " . $moduleNames;    
            }else if($condition == MessageConditions::ON_COMPLETION){
                $condition = "Completion of " . $moduleNames;
            }else if($condition == MessageConditions::ON_MARKS_EQUAL_TO){
                $condition = "Scoring " . $percent . "% in " . $moduleNames;
            }else if($condition == MessageConditions::ON_MARKS_GREATER_THAN){
                $condition = "Scoring more than " . $percent . "% in " . $moduleNames;
            }else if($condition == MessageConditions::ON_MARKS_LESS_THAN){
                $condition = "Scoring less than " . $percent . "% in " . $moduleNames;
            }
        }
        return $condition;
      }
     public function save($mailMessage){
        $id = self::$dataStore->save($mailMessage);
        return $id;
     }
     public function deleteMailMessageAction($messageId){
         $colValue["messageid"] = $messageId;
         self::$mailMessageActionDataStore->deleteByAttribute($colValue);
     }
     public function saveMailMessageAction($mailAction){        
        $id = self::$mailMessageActionDataStore->save($mailAction);
        return $id;  
     }
     public function deleteMailMessageLearningProfiles($messageId){
         $colValue["messageid"] = $messageId;
         self::$mailMessageLearningProfileDataStore->deleteByAttribute($colValue);
     }
     public function saveMailMessageLearningProfile($mailMessageId,$lpseq){
        $learningProfileMgr = LearningProfileMgr::getInstance();
        $learningProfile = $learningProfileMgr->getLearningPlanProfile($lpseq);
        $mmlp = new MailMessageLearningProfile();
        $mmlp->setMessageId($mailMessageId);
        $mmlp->setLearningProfileId($learningProfile[0]->getLearningProfileSeq());
        $id = self::$mailMessageLearningProfileDataStore->save($mmlp);
        return $id;  
     }
     
  }
?>
