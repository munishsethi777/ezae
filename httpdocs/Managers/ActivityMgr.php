<?php
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/Activity.php");
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/QuizProgress.php"); 
require_once($ConstantsArray['dbServerUrl']. "DataStores/ActivityDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "Utils/MailMessageUtil.php");
require_once($ConstantsArray['dbServerUrl']. "Utils/SessionUtil.php5");
require_once($ConstantsArray['dbServerUrl']. "Utils/CustomFieldsFormGenerator.php");
require_once($ConstantsArray['dbServerUrl']. "Enums/RoleType.php");
require_once($ConstantsArray['dbServerUrl']. "Enums/ManagerCriteriaType.php");


class ActivityMgr{

    private static $activityMgr;
    private static $mailMessageMgr;
    private static $sessionUtil;
    private static $quizProgressDataStore;
    public static function getInstance()
    {
        if (!self::$activityMgr)
        {
            self::$activityMgr = new ActivityMgr();
            self::$mailMessageMgr = new MailMessageMgr();
            self::$quizProgressDataStore = new BeanDataStore(QuizProgress::$classname,QuizProgress::$tablename);
            self::$sessionUtil = new SessionUtil();
            return self::$activityMgr;
        }
        return self::$activityMgr;
    }

    public function saveActivityData($moduleId, $learningPlanSeq, $userSeq, $progres, $score){
        $ads = ActivityDataStore::getInstance();
        $activity = new Activity();
        $activity->setDateOfPlay(new DateTime());
        $activity->setModuleSeq($moduleId);
        $activity->setProgress($progres);
        $activity->setScore($score);
        $activity->setUserSeq($userSeq);
        $activity->setIsCompleted(0);
        $activity->setLearningPlanSeq($learningPlanSeq);
        $existingActivity = $this->getActivityByUser($userSeq,$moduleId);
        if(!empty($existingActivity)){
            $activity->setSeq(intval($existingActivity->getSeq()));
            $activity->setScore($score + $existingActivity->getScore());      
        }
        if(($progres == 100 || $progres == "100")){
            $activity->setIsCompleted(1);
            $mailMessageMailUtils = MailMessageUtil::getInstance();
            $mailMessageMailUtils->checkForModuleOnMarksNotification($learningPlanSeq,$moduleId,$activity->getScore(),$userSeq);
            $mailMessageMailUtils->checkForModuleCompletedNotification($learningPlanSeq,$moduleId,$score,$userSeq);
        }

        $ads->saveActivityData($activity);

    }
    public function exportActivities($lpSeq,$moduleSeq){
        $activityDS = ActivityDataStore::getInstance();
        $companySeq = self::$sessionUtil->getAdminLoggedInCompanySeq();
        $userSeqs = $this->getUserSeqsByCustomFieldCriteria();
        $data = $activityDS->getUsersActivity($moduleSeq,$companySeq,$lpSeq,$userSeqs,true);
        $fullArr = array();
        $count = 0;
        $userMgr = UserMgr::getInstance();
        foreach($data as $dataArr){
            $arr = array();
            $arr['User Name'] = $dataArr['username'];
            $arr['Password'] = $dataArr['password'];
            $arr['Email'] = $dataArr['emailid'];
            $profile = $userMgr->getUserLearningProfiles($dataArr['seq']);
            $arr['Profiles'] = implode(",",$profile[1]);
            $arrCustomFields = ActivityMgr::getCustomValuesArray($dataArr['customfieldvalues']);
            $arr = array_merge($arr,$arrCustomFields);
            $arr['Score'] = $dataArr['score'];
            $arr['Progress'] = $dataArr['progress'];
            $arr['Date Of Registration'] = $dataArr['createdon'];
            $arr['Date of Play'] = $dataArr['dateofplay'];
            array_push($fullArr,$arr);
            $count++;
        }
        ExportUtil::ExportData($fullArr);           
    }
    
    public function getUserSeqsByCustomFieldCriteria(){
        $userSeqs = array();
        $role = self::$sessionUtil->getLoggedInRole();
            if($role == RoleType::MANAGER){
                $adminMgr = AdminMgr::getInstance();
                $adminSeq = self::$sessionUtil->getAdminLoggedInSeq();
                $managerCriteria = $adminMgr->findLoggedinManagerCriteria($adminSeq);
                $criteriaVals = $managerCriteria->getCriteriaValue();
                if($managerCriteria->getCriteriaType() == ManagerCriteriaType::CUSTOM_FIELD){
                    $customFieldGenerator = CustomFieldsFormGenerator::getInstance();
                    $customfieldArr = $customFieldGenerator->getCustomFieldsArray($criteriaVals,false);
                    $userMgr = UserMgr::getInstance();
                    $userSeqs = $userMgr->getUserSeqsByCustomfield($customfieldArr);
                }
            }
        return $userSeqs;
    }
    public function getCompletionCounts($learningPlanSeq,$moduleSeq){
       $userSeqs = $this->getUserSeqsByCustomFieldCriteria();
       $ads = ActivityDataStore::getInstance();
       return $ads->getCompletionCounts($learningPlanSeq,$moduleSeq,$userSeqs);
    }

    public function getUserPerformance($userSeq){
        $ads = ActivityDataStore::getInstance();
       return $ads->findByUser($userSeq);
    }
    //called for main chart on performance UI
    public function getPerformanceData($learningPlanSeq,$moduleId,$maxScore){
        $ads = ActivityDataStore::getInstance();
        $arr = $ads->getScorePercentage($learningPlanSeq,$moduleId);
        return $arr;
    }

    //returns customFieldsValues Array from csv data
    public static function getCustomValuesArray($lines){
        $mainLineArray = explode(';', $lines);
        $mainArray = array();
        $prefix = "cus_";
        foreach($mainLineArray as $line){
            if($line != "") {
                $nameValueArray = explode(':', $line);
                $val = $nameValueArray[1];
                $mainArray[trim("cus_".$nameValueArray[0])] =  urldecode($val);
            }

        }
        return $mainArray;

    }

    public function saveQuizProgress($quizProgress){
        $id = self::$quizProgressDataStore->save($quizProgress);
        return $id;
    }
    //called from AdminMgr for performance page table MMM
    public static function getMeanMedianModePassPercentForPerformance($learningPlanSeq,$moduleSeq){
        $ads = ActivityDataStore::getInstance();
        $data = $ads->getScorePercentage($learningPlanSeq,$moduleSeq);
        $arr = array();
        foreach($data as $item){
            array_push($arr, $item[0]);
        }
        $mainArray = array();
        $count = count($arr);
        $sum = array_sum($arr);
        $avg = $sum / $count;
        $avg = round($avg);

        rsort($arr);
        $middle = round($count/2);
        $median = $arr[$middle-1];

        $v = array_count_values($arr);
        arsort($v);
        foreach($v as $k => $v){$mode = $k; break;}

        $mainArray['mean'] = round($avg,2);
        $mainArray['median'] = round($median,2);
        $mainArray['mode'] = round($mode,2);
        return json_encode($mainArray);
    } 
    public function getActivityByUser($userSeq,$moduleId){
        $ads = ActivityDataStore::getInstance();
        $activity = $ads->findByUserAndModule($userSeq,$moduleId);    
        return $activity;
    }
    
    public function getQuizProgressByUser($userSeq,$moduleId,$lpseq){
        $colval["userseq"] = $userSeq;
        $colval["moduleseq"] = $moduleId;
        $colval["learningplanseq"] = $lpseq; 
        $quizProgressList = self::$quizProgressDataStore->executeConditionQuery($colval);
        return $quizProgressList;
    }
    public function getQuizProgressArr($userSeq,$moduleId,$lpseq){
        $quizProgressList = $this->getQuizProgressByUser($userSeq,$moduleId,$lpseq);
        $array = array();
        $quizProgressArr = array();
        foreach($quizProgressList as $quizProgress){
            $quesSeq = $quizProgress->getQuestionSeq();
            if(array_key_exists($quesSeq,$array)){
                $quizProgressArr = $array[$quesSeq];   
            }else{
                $quizProgressArr = array();
            }
            array_push($quizProgressArr,$quizProgress); 
            $array[$quesSeq] = $quizProgressArr;  
        }
        return $array;
    }
     public function getSelectedAnswerSeqs($userSeq,$moduleId,$lpseq){
        $colval["userseq"] = $userSeq;
        $colval["moduleseq"] = $moduleId;
        $colval["learningplanseq"] = $lpseq;
        $attr[0] = "answerseq"; 
        $ansSeqs = self::$quizProgressDataStore->executeAttributeQuery($attr,$colval);
        $arr = array();
        foreach($ansSeqs as $seq){
            array_push($arr,$seq[0]);    
        }
        return $arr;
    }
}
?>