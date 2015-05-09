<?php
    class LearningPlanMgr{
        private static $learningPlanMgr;
        private static $dataStore;
        private static $lpCoursedataStore;
        private static $adminSeq;
        private static $companySeq;
        private static $sessionUtil;


        public static function getInstance()
        {
            if (!self::$learningPlanMgr)
            {
                self::$learningPlanMgr = new LearningPlanMgr();
                self::$dataStore = new BeanDataStore(LearningPlan::$className,LearningPlan::$tableName);
                self::$lpCoursedataStore = new BeanDataStore(LearningPlanCourse::$className,LearningPlanCourse::$tableName);                
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
        
        public function saveLearningPlan($learningPlanObj,$courseIds,$enableLeaderboardArr){
            $learningPlan = new LearningPlan();
            $learningPlan = $learningPlanObj;
            $id = self::$dataStore->save($learningPlan);
            $lpCourseDataStore = new BeanDataStore("","");
            $this->deleteLeaeningPlanCourses($id);
            $i = 0;
            foreach ($courseIds as $key=>$value){
                $val = $enableLeaderboardArr[$value];
                $enableLeaderboard = 0;
                if($val == "true"){
                    $enableLeaderboard = 1;    
                }               
                $lpCourse = new LearningPlanCourse();
                $lpCourse->setCourseSeq($value);
                $lpCourse->setLearningPlanSeq($id);
                $lpCourse->setIsEnableLeaderBoard($enableLeaderboard);
                self::$lpCoursedataStore->save($lpCourse);
            }
            return $id;     
        }
       
        public function getLearningPlanByCompany($companySeq){
            $learningPlans = self::$dataStore->findAllByCompany();
            return $learningPlans;
        }
        public function getLearningPlanForGrid($companySeq){
            $modules =  $this->getLearningPlanByCompany($companySeq);
            $moduleJson = self::geLearningPlanDataJson($modules);
            return $moduleJson;
        }
        public static function geLearningPlanDataJson($learningPlans){
            $fullArr = array();
            foreach($learningPlans as $learningPlan){
                $arr = self::getLearningPlanArry($learningPlan);
                array_push($fullArr,$arr);
            }
            return json_encode($fullArr);
        }
        public static function getCoursesIdBylearnigPlanSeq($learningPlanSeq){
             $colValuePair["learningplanseq"] =  $learningPlanSeq;
             $attributes[0] = "courseseq"; 
             $learningPlanCourses = self::$lpCoursedataStore->executeAttributeQuery($attributes,$colValuePair);
             $ids = array();
             foreach($learningPlanCourses as $key=>$value){
                array_push($ids,$value[0]);    
             }
             return implode(",",$ids);    
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
