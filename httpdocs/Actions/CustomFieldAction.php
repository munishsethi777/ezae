 <?php
 require_once('../IConstants.inc');
 require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomFieldMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/User.php");
 require_once($ConstantsArray['dbServerUrl'] ."Utils/StringUtil.php"); 
 require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/UserCustomfield.php");
 require_once($ConstantsArray['dbServerUrl'] ."DataStores/UserDataStore.php5");
   $call = $_GET["call"];
   $success = 1;
   $message = "";
   $response["message"]  = "";
   $sessionUtil = SessionUtil::getInstance();
   $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
   $adminSeq =  $sessionUtil->getAdminLoggedInSeq();
    if($call == "saveImportedFields"){     
        
        $data = $_GET["data"];
        $data = str_replace('\\', '', $data);
        $rows = json_decode($data,true);
        
        $userNameField = $_GET["userName"];
        $passwordField = $_GET["password"]; 
        $emailField = $_GET["emailId"]; 
        $prefix = $_GET["userNamePrefix"]; 
        $randomPassword =$_GET["randomPassword"];
        $isRandomPassword = $randomPassword == "on";
        
        $fieldData = $_GET["fieldData"];
        $fieldData = str_replace('\\', '', $fieldData);
        $fieldRows = json_decode($fieldData,true);
        $names = $fieldRows[0];
        $types = $fieldRows[1];
         
        $msg = validateImportedData($rows,$fieldRows,$userNameField,$passwordField,$emailField);
        if(count($msg) > 0){
            $success = 0;
            foreach($msg as  $key => $value){
                $message .=  $value . "<br/>";   
            }      
        }else{             
             saveFieldRowsData($fieldRows,$companySeq,$adminSeq);
             saveUserRowsData($rows,$userNameField,$passwordField,$emailField,$prefix,$isRandomPassword,$companySeq,$adminSeq);
             $message = "Imported data Saved successfully";
        }
        
        $response = getResponse($success,$message);
        echo json_encode($response);  
    }
    
    if($call == "saveCustomField"){
        $id = $_GET["id"];
        $fieldName = $_GET["fieldName"];
        $fieldType = $_GET["fieldType"];
        $required = $_GET["isRequired"];
        $isRequired = false;
        if($required == "on"){
             $isRequired  =  true;
        }
        $customField = new UserCustomField();
        $customField->setSeq(intval($id));
        $customField->setName($fieldName);
        $customField->setTitle($fieldName);
        $customField->setFieldType($fieldType);
        $customField->setIsRequired($isRequired);        
        $adminSeq =  $sessionUtil->getAdminLoggedInSeq();
        $customField->setCompanySeq($companySeq);
        $customField->setAdminSeq($adminSeq);

        $dataRow = "";
        try{
            $customFieldMgr = CustomFieldMgr ::getInstance();
            $dataRow = $customFieldMgr->saveCustomFields($customField,true);
            $id = $_GET["id"];
            $message  = "Custom Field Saved Sucessfully";
            if(intval($id) > 0){
              $message  = "Custom Field Updated Sucessfully";
            }
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject();
        $response["success"]  = $success;
        $response["message"]  = $message;
        $response["row"] = $dataRow;
        echo json_encode($response);
    }

    if($call == "getCustomFields"){
        try{
            $customFieldMgr = CustomFieldMgr ::getInstance();
            $customfields = $customFieldMgr->getCustomfieldsForGrid($companySeq);
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject();
        $response["data"] = $customfields;
        $json = json_encode($response);
        echo $json;
    }

     if($call == "deleteCustomfield"){
         $ids = $_GET["ids"];
         try{
            $customFieldMgr = CustomFieldMgr ::getInstance();
            $customfields = $customFieldMgr->deleteCustomFields($ids);
            $message = "Record Deleted successfully";
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject();
        $response["message"]  = $message;
        $response["success"]  = $success;
        $response["data"] = $customfields;

        echo json_encode($response);
     }
     function getResponse($success,$message){
        $response = new ArrayObject();
        $response["success"]  = $success;
        $response["message"]  = $message;
        return $response;
     }
     function validateImportedData($data,$fieldData,$userNameField,$passwordField,$emailField){
         $msg = array();
         if(StringUtil::IsNullOrEmptyString($userNameField)){
            $msg["userNameField"] = "UserName cannot be null";    
         }
         if(StringUtil::IsNullOrEmptyString($passwordField)){
            $msg["passwordField"] = "UserName cannot be null";    
         }
         if(count($msg) > 0){
             return $msg;
         }
         $msg = validateFieldData($fieldData);
         if(count($msg) > 0){
             return $msg;
         }
         $msg = validateData($data,$userNameField,$passwordField,$emailField);
         return $msg;
     }
     
     function validateFieldData($fieldRows){
        $msg = array();
        $names = $fieldRows[0];
        foreach($names as  $key => $value){
           if(StringUtil::IsNullOrEmptyString($value)){
                $msg[$key] = $key + " cannot be null";    
           }
         }
        return $msg;         
     }
     
     function validateData($data,$userNameField,$passwordField,$emailField){
        $msg = array();
        foreach($data as  $key => $value){
             $userName = $value[$userNameField];
             $rowNo = $key + 1;
             if(StringUtil::IsNullOrEmptyString($userName)){
                $msg["userName"] = "Value is null for selected username field for Row no." . $rowNo;    
             }
             $password = $value[$passwordField];
             if(StringUtil::IsNullOrEmptyString($password)){
                $msg["password"] = "Value is null for selected password field for Row no." . $rowNo;  
             }
             if(StringUtil::IsNullOrEmptyString($emailField)){
               $email = $value[$emailField]; 
               if(StringUtil::IsNullOrEmptyString($userName)){
                    $msg["email"] = "Value is null for selected email field for Row no." . $rowNo;  
               }   
             }
         }
         return $msg;  
     }
     
     function saveFieldRowsData($fieldData,$companySeq,$adminSeq){
         $names = $fieldData[0];
         $types = $fieldData[1];
         unset($names["uid"]);
         unset($types["uid"]);
         foreach($names as  $key => $value){
            $customField = new UserCustomField();
            $customField->setName($names[$key]);
            $customField->setTitle($names[$key]);
            $customField->setFieldType($types[$key]);
            $customField->setIsRequired(true); 
            $customField->setCompanySeq($companySeq);
            $customField->setAdminSeq($adminSeq);
            try{
                $customFieldMgr = CustomFieldMgr ::getInstance();
                $id = $customFieldMgr->saveCustomFields($customField);
            }catch(Exception $e){
                //TODO Log Error Here---
            } 
         }
     }
     
     function saveUserRowsData($data,$userNameField,$passwordField,$emailId,$prefix,$isRandom,$companySeq,$adminSeq){
        $userDataStore = UserDataStore::getInstance();
        foreach($data as  $key => $value){
            $userName = $value[$userNameField] . $prefix;
            $email = $value[$emailId];
            $password = "";
            if(!$isRandom){
                $password = $value[$passwordField];
            }else{
               $password = StringUtil::generatePassword();
            }
            $user = new User();
            $user->setUserName($userName);
            $user->setPassword($password);
            $user->setEmailId($email);
            $user->setCompanySeq($companySeq);
            $user->setAdminSeq($adminSeq);
            $user->setCreatedOn(new DateTime());
            $user->setIsEnabled(true);
            $customVal = "";
            unset($value["uid"]);
            foreach($value as $id => $val){
                $customVal .= $id .":". $val .";";
            }
            $user->setCustomFieldValues($customVal);
            $userDataStore->save($user);
        }  
     }
?>
