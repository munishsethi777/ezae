<?php
    require_once($ConstantsArray['dbServerUrl']. "DataStores/ModuleDataStore.php5");

class ModuleMgr{
    private static $moduleMgr;

    public static function getInstance()
    {
        if (!self::$moduleMgr)
        {
            self::$moduleMgr = new ModuleMgr();
            return self::$moduleMgr;
        }
        return self::$moduleMgr;
    }

    public static function getModulesDataJson($modules){
        $fullArr = array();
        foreach($modules as $module){
            $arr = self::getModuleDataArr($module);
            array_push($fullArr,$arr);
        }
        return json_encode($fullArr);
    }
    private static function getModuleDataArr($module){
        $moduleObj = new Module();
        $moduleObj = $module;
        $arr = array();
        $arr['id'] = $moduleObj->getSeq();
        $arr['title'] = $moduleObj->getTitle();
        $arr['description'] = $moduleObj->getDescription();
       // $arr['uploadedby'] = $moduleObj->getUploadedBy();
        $expiringDate = new DateTime($moduleObj->getDateOfDateOfExpiry());
        //$arr['dateofexpiry'] =  $expiringDate->format('d M Y');         
        $arr['maxscore'] = $moduleObj->getMaxScore();
        $arr['passpercent'] = $moduleObj->getPassPercent();
        $arr["ispaid"] = $moduleObj->getIsPaid(); 
        $createdDate = new DateTime($moduleObj->getCreatedOn());
        $arr['createdon'] = $createdDate->format('d M Y');
        //$arr['companyseq'] = $moduleObj->getCompanySeq();
        //$arr['isenabled'] = $moduleObj->getIsEnabled();
        return $arr;
    }
    public function getModulesByCompany($companySeq){
        $moduleDataStore = ModuleDataStore::getInstance();
        $modules = $moduleDataStore->findByCompanySeq($companySeq);
        return $modules;
    }
     /*JSON Methods for Grids*/
    public function getModuleGridJSON($companySeq){
        $headerJSON = self::getHeadersJSON();
        $modules =  $this->getModulesByCompany($companySeq);
        $moduleJson = self::getModulesDataJson($modules);

        $mainJsonArray = array();
        $mainJsonArray["columns"] = $headerJSON;
        $mainJsonArray["data"] = $moduleJson;
        return json_encode($mainJsonArray);
    }
    
     public function getModulesForGrid($companySeq){
        $modules =  $this->getModulesByCompany($companySeq);
        $moduleJson = self::getModulesDataJson($modules);
        return $moduleJson;
     }
     
    public static function getHeadersJSON(){
        $fullArr = array();
        $arr = array();
        $arr['text'] = "Title";
        $arr['datafield'] = "title";
        array_push($fullArr,$arr);

        $arr = array();
        $arr['text'] = "Description";
        $arr['datafield'] = "description";
        array_push($fullArr,$arr);

        $arr = array();
        $arr['text'] = "Stakeholder";
        $arr['datafield'] = "uploadedby";
        array_push($fullArr,$arr);

        $arr = array();
        $arr['text'] = "Expiry Date";
        $arr['datafield'] = "dateofexpiry";
        array_push($fullArr,$arr);

        $arr = array();
        $arr['text'] = "Created On";
        $arr['datafield'] = "createdon";
        array_push($fullArr,$arr);

        //$arr = array();
//        $arr['text'] = "Enabled";
//        $arr['datafield'] = "isenabled";
//        array_push($fullArr,$arr);

        return json_encode($fullArr);

    }

    public function getModule($moduleSeq){
        $moduleDataStore = ModuleDataStore::getInstance();
        $module = $moduleDataStore->findBySeq($moduleSeq);
        return $module;
    }

    //API for users login to display modules with user's performance
    public function getModulesForLoggedInUserWithPerformance(){
        $sessionUtil = SessionUtil::getInstance();
        $companySeq = $sessionUtil->getUserLoggedInCompanySeq();
        $userSeq = $sessionUtil->getUserLoggedInSeq();
        $modules = self::getModulesByCompany($companySeq);
        $activityMgr = ActivityMgr::getInstance();
        $activities = $activityMgr->getUserPerformance($userSeq);
        $fullArr = array();
        foreach ($modules as $module){
           $mod = new Module();
           $mod = $module;
           $modArr = self::getModuleDataArr($mod);
           if(count($activities) == 0){
               $modArr['status'] = "Did not Played";
           }else{
               foreach($activities as $activity){
                   $activityObj = new Activity();
                   $activityObj = $activity;
                   if($mod->getSeq() == $activityObj->getModuleSeq()){
                        $modArr['isCompleted'] = $activityObj->getIsCompleted();
                        $modArr['dateOfPlay'] = $activityObj->getDateOfPlay();
                        $modArr['progress'] = $activityObj->getProgress();
                        $modArr['score'] = $activityObj->getScore();
                        $status = "";
                        if($activityObj->getIsCompleted() == 1){
                            $status = "Completed with Score :".$activityObj->getScore() ;
                        }else{
                            $status = "Progress ". $activityObj->getProgress() +"%";
                        }
                        $modArr['status'] = $status;

                   }
               }
           }
           array_push($fullArr,$modArr);
        }
        return json_encode($fullArr);
    }
}
?>
