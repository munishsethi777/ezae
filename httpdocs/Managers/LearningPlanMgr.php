<?php
require_once($ConstantsArray['dbServerUrl'] ."Managers/AdminMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/RoleType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/ManagerCriteriaType.php");
require_once($ConstantsArray['dbServerUrl']. "DataStores/LearningPlanDataStore.php");
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/LearningPlanModule.php");


class LearningPlanMgr{
        private static $learningPlanMgr;
        private static $dataStore;
        private static $lpCoursedataStore;
        private static $learningPlanProfileDataStore;
        private static $adminSeq;
        private static $companySeq;
        private static $sessionUtil;

        public static function getInstance(){
            if (!self::$learningPlanMgr)
            {
                self::$learningPlanMgr = new LearningPlanMgr();
                self::$dataStore = LearningPlanDataStore::getInstance();
                self::$learningPlanProfileDataStore = new BeanDataStore(LearningPlanProfile::$className,LearningPlanProfile::$tableName);
                self::$lpCoursedataStore = new BeanDataStore(LearningPlanModule::$className,LearningPlanModule::$tableName);
                self::$sessionUtil = SessionUtil::getInstance();
                self::$adminSeq = self::$sessionUtil->getAdminLoggedInSeq();
                self::$companySeq = self::$sessionUtil->getAdminLoggedInCompanySeq();
                return self::$learningPlanMgr;
            }
            return self::$learningPlanMgr;
        }

        public function deleteLeaeningPlanCourses($learningPlanSeq){
            $columnValue = array();
            $columnValue["learningplanseq"] = $learningPlanSeq;
            $id = self::$lpCoursedataStore->deleteByAttribute($columnValue);
        }
        public function deleteLeaeningPlanProfiles($learningPlanSeq){
            $columnValue = array();
            $columnValue["learningplanseq"] = $learningPlanSeq;
            $id = self::$learningPlanProfileDataStore->deleteByAttribute($columnValue);
        }
        public function deleteLearningPlans($ids){
            $idArr = explode(",",$ids) ;
            foreach ($idArr as $id){
                $this->deleteLeaeningPlanCourses($id);
                $this->deleteLeaeningPlanProfiles($id);
            }
            self::$dataStore->deleteInList($ids);

        }
        public function saveLearningPlan($learningPlanObj,$courseIds,$enableLeaderboardArr){
            $learningPlan = new LearningPlan();
            $learningPlan = $learningPlanObj;
            $id = self::$dataStore->save($learningPlan);
            $lpCourseDataStore = new BeanDataStore("","");
            $this->deleteLeaeningPlanCourses($id);
            $this->deleteLeaeningPlanProfiles($id);
            $i = 0;
            foreach ($courseIds as $key=>$value){
                $val = $enableLeaderboardArr[$value];
                $enableLeaderboard = 0;
                if($val == "true"){
                    $enableLeaderboard = 1;
                }
                $lpCourse = new LearningPlanModule();
                $lpCourse->setCourseSeq($value);
                $lpCourse->setLearningPlanSeq($id);
                $lpCourse->setIsEnableLeaderBoard($enableLeaderboard);
                self::$lpCoursedataStore->save($lpCourse);
            }
            return $id;
        }
        public function getLearningPlanByCompany($isApplyFilter = false){
            $role = self::$sessionUtil->getLoggedInRole();
            if($role == RoleType::MANAGER){
                $adminMgr = AdminMgr::getInstance();
                $adminSeq = self::$sessionUtil->getAdminLoggedInSeq();
                $managerCriteria = $adminMgr->findLoggedinManagerCriteria($adminSeq);
                $criteriaVals = $managerCriteria->getCriteriaValue();
                if($managerCriteria->getCriteriaType() == ManagerCriteriaType::LEARNING_PLAN){
                    $learningPlans = $this->getLearningPlansBySeqs($criteriaVals);
                    return $learningPlans;
                }else if($managerCriteria->getCriteriaType() == ManagerCriteriaType::LEARNING_PROFILE){
                    $learningPlans = $this->getLearningPlansByProfiles($criteriaVals);
                    return $learningPlans;
                }
            }
            $learningPlans = self::$dataStore->findAllByCompany($isApplyFilter);
            return $learningPlans;
        }
        public function getLearningPlanForGrid($isApplyFilter){
            $learningPlans =  $this->getLearningPlanByCompany($isApplyFilter);
            $lpJson = self::geLearningPlanDataJson($learningPlans);
            $gridData["Rows"] = $lpJson;
            $gridData["TotalRows"] = self::$dataStore->executeCountQuery(null,$isApplyFilter);
            return json_encode($gridData);

        }
        public static function geLearningPlanDataJson($learningPlans){
            $fullArr = array();
            foreach($learningPlans as $learningPlan){
                $arr = self::getLearningPlanArry($learningPlan);
                array_push($fullArr,$arr);
            }
            return $fullArr;
        }
        public static function getCoursesIdBylearnigPlanSeq($learningPlanSeq){
             $colValuePair["learningplanseq"] =  $learningPlanSeq;
             $attributes[0] = "courseseq";
             $learningPlanModules = self::$lpCoursedataStore->executeAttributeQuery($attributes,$colValuePair);
             $ids = array();
             foreach($learningPlanModules as $key=>$value){
                array_push($ids,$value[0]);
             }
             return implode(",",$ids);
        }

        public function getLearningPlansForUser($userSeq){
            $learningProfilesMgr = LearningProfileMgr::getInstance();
            $learningProfiles = $learningProfilesMgr->getLearningProfilesByUser($userSeq);
            $learningProfilesArr = array();
            foreach($learningProfiles as $learningProfile){
                array_push($learningProfilesArr, $learningProfile->getSeq());
            }
            $learningPlans = self::getLearningPlansByProfiles(implode(",",$learningProfilesArr));
            $learningPlansArr = array();
            foreach($learningPlans as $learningPlan){
                $learningPlanArr = self::getLearningPlanArry($learningPlan);
                array_push($learningPlansArr, $learningPlanArr);
            }
            return $learningPlansArr;
        }
        private function getLearningPlansBySeqs($seqs){
            $colvalue["seq"] = $seqs;
            $learningPlans = self::$dataStore->executeInListQuery($colvalue);
            return $learningPlans;
        }
        private function getLearningPlansByProfiles($profileSeqs){
            $learningPlans = self::$dataStore->getLearningPlansByProfiles($profileSeqs);
            return $learningPlans;
        }
        private static function getLearningPlanArry($learningPlanObj){
            $learningPlan = new LearningPlan();
            $learningPlan = $learningPlanObj;
            $lpArr = array();
            $lpArr["id"] = $learningPlan->getSeq();
            $lpArr["title"] = $learningPlan->getTitle();
            $lpArr["description"] = $learningPlan->getDescription();
            $lpArr["activateon"] = $learningPlan->getActivateOn();
            $lpArr["deactivateon"] = $learningPlan->getDeactivateOn();
            $lpArr["isactive"] = $learningPlan->getIsActive();
            $lpArr["lastmodifiedon"] = $learningPlan->getLastModifiedOn();
            $lpArr["lockSequence"] = $learningPlan->getIsSequenceLocked() == 1 ? true : false;
            $lpArr["moduleIds"] = self::getCoursesIdBylearnigPlanSeq($learningPlan->getSeq());
            $isDeactivate = false;
            if($learningPlan->getDeactivateOn() != null && $learningPlan->getDeactivateOn() != ""){
                $isDeactivate =  true;
            }
            $lpArr["isdeactivate"] = $isDeactivate;
            $lpArr["isenableleaderboard"] = $learningPlan->getIsLeaderBoard();
            return $lpArr;
        }


}
?>
