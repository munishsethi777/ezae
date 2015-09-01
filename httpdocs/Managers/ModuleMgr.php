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
        $arr = array();
        $arr['id'] = $module['seq']; //$moduleObj->getSeq();
        $arr['title'] = $module['title']; //$moduleObj->getTitle();
        $arr['description'] = $module['description']; //$moduleObj->getDescription();
        //$expiringDate = new DateTime($module['seq']); // new DateTime($moduleObj->getDateOfDateOfExpiry());
        $arr['maxscore'] = $module['maxscore'];//$moduleObj->getMaxScore();
        $arr['passpercent'] = $module['passpercent'];//$moduleObj->getPassPercent();
        $arr["ispaid"] = $module['ispaid'];//$moduleObj->getIsPaid();
        $createdDate = new DateTime($module['createdon']); //new DateTime($moduleObj->getCreatedOn());
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
    public function getModulesJSON($companySeq){
        $modules =  $this->getModulesByCompany($companySeq);
        $moduleJson = self::getModulesDataJson($modules);
        return $moduleJson;
    }

    public function getModulesForGrid($companySeq){
        $modules =  $this->getModulesByCompany($companySeq);
        $moduleJson = self::getModulesDataJson($modules);
        return $moduleJson;
     }

    public function getLearningPlanModulesForGrid($larnignPlanSeq){
        $moduleDataStore = ModuleDataStore::getInstance();
        $arrList =  $moduleDataStore->findByLearningPlanSeq($larnignPlanSeq);
        $mainArr = array();
        foreach($arrList as $key=>$value){
            $arr = array();
            $arr['id'] = $value["seq"];
            $arr['enableleaderboard'] = $value["isenableleaderboard"] == "1" ? true : false;
            $arr['title'] = $value["title"];
            $arr['description'] = $value["description"];
            $arr['maxscore'] =  $value["maxscore"];
            $arr['passpercent'] =  $value["passpercent"];
            $arr["ispaid"] =  $value["ispaid"] == "1" ? true : false;
            array_push($mainArr,$arr);
        }
        return json_encode($mainArr);
     }
     public function getModulesByLearningPlans($larnignPlanSeq){
        $moduleDataStore = ModuleDataStore::getInstance();
        $arrList =  $moduleDataStore->findByLearningPlanSeq($larnignPlanSeq);
        $mainArr = array();
        foreach($arrList as $key=>$value){
            $arr = array();
            $arr['id'] = $value["seq"];
            $arr['title'] = $value["title"];
            $arr['lptitle'] = $value["lptitle"];
            $arr['lpseq'] = $value["lpseq"];
            array_push($mainArr,$arr);
        }
        return json_encode($mainArr);
     }


    /* Method used to display various modules on the training page for users*/
    public function getModulesForUserTrainingGrid($userSeq,$learningPlanSeq){
        $moduleDataStore = ModuleDataStore::getInstance();
        $arrList =  $moduleDataStore->findModulesForUserTrainingGrid($userSeq,$learningPlanSeq);
        $mainArr = array();
        $lastLocked = true;
        foreach($arrList as $key=>$value){
            $arr = array();
            $arr['id'] = $value["moduleseq"];
            if($value["iscompleted"] == "1"){
                $arr['status'] = '<span class="label label-warning">Completed</span>';

            }else{
                $arr['status'] = '<span class="label label-primary">Active</span>';

            }
            $arr['moduleName'] = $value["moduletitle"];
            $arr['daysToComplete'] = 12;
            $progress = 0;
            if($value["progress"]){
                $progress = $value["progress"];
            }
            $arr['completionPercent'] = '<small>Completed: '.$progress.'%</small>
                                        <div class="progress progress-mini">
                                            <div style="width: '.$progress.'%;" class="progress-bar"></div>
                                        </div>';
            $arr['leaderboardRank'] =  0;
            $arr["inactiveRemarks"] =  "No Remarks";
            $arr["scores"] =  $value["score"];
            if($value["issequencelocked"] == "1"){ //locked case
                if($value["iscompleted"] == 1){
                    $arr["action"] = "Completed";
                    $lastLocked = true;
                }else if(!$lastLocked){
                    $arr["action"] = "Locked";
                }else{
                    $lastLocked = false;
                    $arr["action"] = '<a href="userTraining.php?id='.$arr['id'].'&lpid='. $value['learningplanseq'] .'" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>';

                }
            }else{
                $arr["action"] = '<a href="userTraining.php?id='.$arr['id'].'&lpid='. $value['learningplanseq'] .'" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>';
            }

            array_push($mainArr,$arr);

        }
        return json_encode($mainArr);


    }

    private function getSelectedModuleForLearningPlan(){
        $moduleDataStore = ModuleDataStore::getInstance();
        $modules = $moduleDataStore->findByCompanySeq($companySeq);
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

    public function getMaxScore($moduleSeq){
        $attributes[0] = "maxscore";
        $colValuearr["seq"] = $moduleSeq;
        $moduleDataStore = ModuleDataStore::getInstance();
        $maxScore = $moduleDataStore->executeAttributeQuery($attributes,$colValuearr);
        if(is_array($maxScore) && count($maxScore) > 0){
            $maxScore = $maxScore[0][0];
        }
        return $maxScore;
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
