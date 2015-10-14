<?php
    require_once($ConstantsArray['dbServerUrl'] ."Managers/MailMessageMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/MailMessageMailMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
     require_once($ConstantsArray['dbServerUrl'] ."Managers/ModuleMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/MailMessage.php");
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/MailMessageMail.php");
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/MailAction.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/MailMessageUtil.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/MailerUtils.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/LearningProfileMgr.php");
  Class MailMessageUtil{
    private static $mailMessageUtil;
    private static $mailMessageMgr;
    private static $mailMessageMailMgr;
    private static $sessionUtil;
    private static $adminSeq;
    private static $learningProfileMgr;
    private static $userMgr;
    
    public static function getInstance()
     {
        if (!self::$mailMessageUtil)
        {
            self::$mailMessageUtil = new MailMessageUtil();
            self::$mailMessageMgr = MailMessageMgr::getInstance();
            self::$mailMessageMailMgr = MailMessageMailMgr::getInstance();
            self::$sessionUtil = SessionUtil::getInstance();   
            self::$userMgr = UserMgr::getInstance();
            self::$adminSeq = self::$sessionUtil->getAdminLoggedInSeq();
            self::$learningProfileMgr = LearningProfileMgr::getInstance();
            return self::$mailMessageUtil;
        }
        return self::$mailMessageUtil;
     }
    
    public function checkForModuleEnrolementNotification($moduleSeqs,$profileSeqs){
        if(!empty($moduleSeqs)){
            $userLearningProfiles = self::$userMgr->getUserLearningProfileByProfileSeq($profileSeqs);
            $mailMessages = self::$mailMessageMgr->getMailMessageForModuleEnrollment($moduleSeqs);
            $sendDate = new DateTime();
            foreach($userLearningProfiles as $userLearningProfile){
                $userSeq = $userLearningProfile->getUserSeq();
                if(!empty($mailMessages)){
                    foreach($mailMessages as $mailMessage){
                        $this->saveMailMessageMail($mailMessage,$userSeq,$sendDate);    
                    }                
                }
            }    
        }          
    }
    
    public function checkForPariculerDateNotification($condition,$lerningPlanSeqs,$senddate){
        if($condition == MessageConditions::ON_PARTICULER_DATE){
            foreach($lerningPlanSeqs as $learningPlanSeq){
                $userLearningProfileArr = self::$userMgr->getUserLearningProfileByLearningPlan($learningPlanSeq);
                $mailMessage = self::$mailMessageMgr->getMailMessageForOnParticulerDate($learningPlanSeq);
                if($mailMessage != null){
                    foreach($userLearningProfileArr as $userLearningProfile){
                        $userSeq = $userLearningProfile->getUserSeq();
                        $this->saveMailMessageMail($mailMessage,$userSeq,$senddate);       
                    }        
                }
                
            }
        }    
    }
    
    public function checkForModuleOnMarksNotification($learningPlanSeq,$moduleSeq,$score,$userSeq){
        $mailMessage = self::$mailMessageMgr->getMailMessageForOnMarksCondition($learningPlanSeq,$moduleSeq);
        $moduleMgr = ModuleMgr::getInstance();
        if($mailMessage != null){
            $maxScore =  $moduleMgr->getMaxScore($moduleSeq);
            $score = intval($score);
            $maxScore = intval($maxScore);
            $percent = ($score / $maxScore) * 100;
            $condition = $mailMessage["messagecondition"];
            $gettingMarksValue = intval($mailMessage["gettingmarksvalue"]);
            $sendDate = new DateTime();
            self::$adminSeq = self::$sessionUtil->getUserLoggedInAdminSeq();
            if($condition == MessageConditions::ON_MARKS_EQUAL_TO){                
                if($percent == $gettingMarksValue){
                     $this->saveMailMessageMail($mailMessage,$userSeq,$sendDate);       
                }    
            }else if($condition == MessageConditions::ON_MARKS_GREATER_THAN){
               if($percent > $gettingMarksValue){
                    $this->saveMailMessageMail($mailMessage,$userSeq,$sendDate);       
               }                 
            }else if($condition == MessageConditions::ON_MARKS_LESS_THAN){
               if($percent < $gettingMarksValue){
                    $this->saveMailMessageMail($mailMessage,$userSeq,$sendDate);
               }                 
            }
        }
    }  
    public function checkForModuleCompletedNotification($learningPlanSeq,$moduleSeq,$score,$userSeq){
        $mailMessage = self::$mailMessageMgr->getMailMessageForOnModuleCompletion($learningPlanSeq,$moduleSeq);
        $moduleMgr = ModuleMgr::getInstance();
        $sendDate = new DateTime();
        if($mailMessage != null){
            self::$adminSeq = self::$sessionUtil->getUserLoggedInAdminSeq();
            $this->saveMailMessageMail($mailMessage,$userSeq,$sendDate);  
        }
    }
    
    private function saveMailMessageMail($mailMessage,$userSeq,$sendDate){
        $mailMessageMail = new MailMessageMail();
        $mailMessageMail->setMessageActionSeq($mailMessage["seq"]);
        $mailMessageMail->setAdminSeq(self::$adminSeq);
        $mailMessageMail->setSavedOn(new DateTime());
        $mailMessageMail->setUserSeq($userSeq);
        $mailMessageMail->setSendOn($sendDate);
        $mailMessageMail->setStatus("Pending");
        $mailMessageMail->setFailureCounter(0);
        self::$mailMessageMailMgr->save($mailMessageMail);
    }
    
    public static function sendforgotPasswordEmail($mailMessage,$user){
        MailerUtils::sendMandrillEmailNotification($mailMessage,$user);
    }
  }
?>
