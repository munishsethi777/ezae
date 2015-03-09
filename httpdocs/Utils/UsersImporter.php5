<?php
    require_once('..\\IConstants.inc');
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/User.php");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/UserDataStore.php5");

    $userImporter = new UserImporter();
    $userImporter->importUsers("G:/Webdocs/EZAsessmentEngine/resources/JCB.csv");

    class UserImporter{
        private static $mainTableFields = array("emailid");
        private static $dateBasedFields = array("dateOfBirth","dateOfJoining","asOn31072014");
        public function importUsers($filePath){
            $userDataStore = UserDataStore::getInstance();
            $content = file($filePath);
            $totalLines = count($content);
            $fieldNames = explode(',', trim($content[0]));
            for ($i = 1; $i < $totalLines; $i++) {
                $paramsLine = $content[$i];
                $paramsArray = explode(",",$paramsLine);
                $user = new User();
                $user->setUserName($paramsArray[0]);
                $pass = $paramsArray[5];
                $pass = str_replace("/","",$pass);
                $user->setPassword($pass);
                $user->setCompanySeq(1);
                $user->setAdminSeq(1);
                $user->setCreatedOn(new DateTime());
                $user->setIsEnabled(true);
                $customVal = "";
                for($j=0;$j<count($fieldNames);$j++){
                    $val =  $paramsArray[$j];
                    $fieldName =  $fieldNames[$j];
                    if(in_array($fieldName,self::$dateBasedFields)){
                        $val = $this->getDateString($val);
                    }
                    $customVal .= $fieldName .":". $val .";";
                }
                $user->setCustomFieldValues($customVal);
                $userDataStore->save($user);

            }
        }

        private function getDateString($date){
            $dateInfo = date_parse_from_format('d/m/YYYY', $date);
            $unixTimestamp = mktime(
                $dateInfo['hour'], $dateInfo['minute'], $dateInfo['second'],
                $dateInfo['month'], $dateInfo['day'], $dateInfo['year'],
                $dateInfo['is_dst']
            );
            $val = date('m/d/Y', $unixTimestamp);
            return $val;
        }
    }
?>
