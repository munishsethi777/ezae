<?php
    require_once($ConstantsArray['dbServerUrl']. "DataStores/BeanDataStore.php5");
    require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/tag.php");
    require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/UserLearningProfile.php");
    class LearningProfileMgr{
        private static $learnerProfileMgr;
        private static $dataStore;   
        public static function getInstance()
        {
            if (!self::$learnerProfileMgr)
            {
                self::$learnerProfileMgr = new LearningProfileMgr();
                self::$dataStore = new BeanDataStore("tag","learningprofiles");
                return self::$learnerProfileMgr;
            }
            return self::$learnerProfileMgr;
        }  
        
        public function getLearnerProfilesForGrid($adminSeq,$companySeq){
            $fullArr = array();
            $params = array();
            $params["adminseq"] = $adminSeq;
            $params["companyseq"] = $companySeq; 
            $learnerProfiles = self::$dataStore->executeConditionQuery($params);
            foreach($learnerProfiles as $lpObj){
                $lp = new tag();
                $lp = $lpObj;
                $arr = array();
                $arr['id'] = $lp->getSeq();
                $arr['tag'] = $lp->getTag();
                $arr['description'] = $lp->getDescription();
                $arr['awesomefontid'] = "<i id='icon". $lp->getSeq() . "' class='fa ". $lp->getAwesomeFontId() . "'></i>";
                $arr['lastmodifiedon'] = $lp->getLastModifiedOn();                
                array_push($fullArr,$arr);
            }
            return json_encode($fullArr);    
        }
        
        public function deleteCustomFields($ids){
            self::$dataStore->deleteInList($ids);
        }
        
        public function Save($learningProfile,$isAjaxCall = false){
            $id = self::$dataStore->save($learningProfile);
            if($isAjaxCall){
                $learningProfile->setSeq($id);
                return $this->getSavedRowArray($learningProfile);    
            }
            return $id;
        }
        
        private function getSavedRowArray($learningProfile){
            $learningProfileObj = new tag();
            $learningProfileObj = $learningProfile;
            $row = array();
            $row["id"] = $learningProfileObj->getSeq();
            $row["tag"] = $learningProfileObj->getTag();
            $row["description"] = $learningProfileObj->getDescription();
            $row['awesomefontid'] = "<i id='icon". $learningProfileObj->getSeq() . "' class='fa ". $learningProfileObj->getAwesomeFontId() . "'></i>";         
            $row['lastmodifiedon'] = $learningProfileObj->getLastModifiedOn()->format("m-d-Y h:m:s A");                
            return json_encode($row);
        } 
        
        public function setProfileOnLearner($userLearningProfiles){
            $dataStore = new BeanDataStore("UserLearningProfile","userlearningprofiles");
            $id = $dataStore->save($userLearningProfiles);
            return $id;           
        }
        public function removeProfileFromLearner($learnerSeq){
            $dataStore = new BeanDataStore("UserLearningProfile","userlearningprofiles");
            $dataStore->executeQuery("delete from userlearningprofiles where userseq =" .$learnerSeq);
        }
    }
?>
