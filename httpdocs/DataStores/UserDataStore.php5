<?php
 require_once("BeanDataStore.php5");
 require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/User.php");

 class UserDataStore extends BeanDataStore{

    private static $userDataStore ;
    
    public static function getInstance()
    {
        if (!self::$userDataStore)
        {
            self::$userDataStore = new UserDataStore("User",User::$tableNames);
                return self::$userDataStore;
        }
        return self::$userDataStore;
    }
    public function findByUserName($userName){
        $colValuePair = array();
        $colValuePair["username"] = $userName;
        $userList = self::executeConditionQuery($colValuePair);
        if(sizeof($userList) > 0){
            return $userList[0];
        }
        return null;
    }

     public function findByCompany($companySeq){
        $colValuePair = array();
        /*'companyseq' is columnName*/
        $colValuePair["companyseq"] = $companySeq;
        $userList = self::executeConditionQuery($colValuePair);
        return $userList;
    }

      public function findCustomfield($userSeq){
        $attributes = array("customfieldValues");
        $colValuePair = array();
        $colValuePair["seq"] = $userSeq;
        $colList = $this->executeAttributeQuery($attributes,$colValuePair);
        if(sizeof($colList) > 0){
            return $colList[0]["customfieldValues"];
        }
      }
      public function saveUser($userObj,$isChangePassword){
        $user = new User();
        $user = $userObj;
        $id = $user->getSeq();        
        if($id > 0){
            $UPDATE = "update users set username=:username,emailid=:emailId,companyseq=:comanyseq, customfieldvalues=:customfieldvalues,isenabled=:isenabled,adminseq=:adminseq,lastmodifiedon=:lastmodified " ;             
            $db_New = MainDB::getInstance();
            $conn = $db_New->getConnection();
            if($isChangePassword){
                $UPDATE .= ", password=:password where seq=:seq";  
            }else{
                $UPDATE .= "where seq=:seq";  
            }
            $stmt = $conn->prepare($UPDATE);
            $stmt->bindValue(':username', $user->getUserName());
            $stmt->bindValue(':emailId', $user->getEmailId());
            $stmt->bindValue(':comanyseq',$user->getCompanySeq());
            $stmt->bindValue(':customfieldvalues',$user->getCustomFieldValues());
            $stmt->bindValue(':isenabled',$user->getIsEnabled());
            $stmt->bindValue(':adminseq',$user->getAdminSeq());
            $stmt->bindValue(':lastmodified',$user->getLastModifiedOn()->format('Y-m-d H:i:s'));
            if($isChangePassword){ 
                $stmt->bindValue(':password', $user->getPassword());     
            }
            $stmt->bindValue(':seq',$user->getSeq());
            $stmt->execute(); 
            $error = $stmt->errorInfo();
            if($error[2] <> ""){
                throw new Exception($error[2]);
            }        
        }else{
            $id = self::save($userObj);    
        }
        return $id;   
      }



 }
?>
