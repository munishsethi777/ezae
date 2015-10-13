<?php
 require_once('../IConstants.inc');
 require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomFieldMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."Managers/CompanyMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."Managers/SignupFormMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."Managers/MatchingRuleMgr.php");   
 require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/User.php");
 require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/MatchingRule.php");
 require_once($ConstantsArray['dbServerUrl'] ."Utils/StringUtil.php"); 
  require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
 require_once($ConstantsArray['dbServerUrl'] ."Utils/ErrorUtil.php"); 
 require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/UserCustomField.php");
 require_once($ConstantsArray['dbServerUrl'] ."DataStores/UserDataStore.php5");
   $call = $_GET["call"];
   $success = 1;
   $message = "";
   $response["message"]  = "";
   $sessionUtil = SessionUtil::getInstance();
   $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
   $adminSeq =  $sessionUtil->getAdminLoggedInSeq();

   if($call == "saveImportedFields"){
       try{
            $data = $_POST["data"];
        $data = str_replace('\\', '', $data);
        $rows = json_decode($data,true);
        $userNameField = $_POST["userName"];
        $passwordField = $_POST["password"];
        $emailField = $_POST["emailId"];
        $prefix = $_POST["userNamePrefix"];
        $randomPassword = "off";
        $isFirstRowContainsFields = $_POST["isFirstRowContainFields"];
        if(isset($_POST["randomPassword"])){
           $randomPassword =$_POST["randomPassword"];
        }

        $isRandomPassword = $randomPassword == "on";
        $fieldData = $_POST["fieldData"];
        $fieldData = str_replace('\\', '', $fieldData);
        $fieldRows = json_decode($fieldData,true);
       
        
        if($isFirstRowContainsFields == "false"){
            $newArr = array();
            $selectedFields = $fieldRows[0];
            array_push($selectedFields,"uid");
            foreach($rows as $row){
                $list = array_combine($selectedFields, array_values($row));
                array_push($newArr,$list);
            }
            $rows = $newArr;
        }
        

        $msg = validateImportedData($rows,$fieldRows,$userNameField,$passwordField,$emailField);
        if(count($msg) > 0){
            $success = 0;
            foreach($msg as  $key => $value){
                $message .=  $value . "<br/>";
            }
        }else{
              $userMgr = UserMgr::getInstance();
              $userMgr->saveUserRowsData($rows,$userNameField,$passwordField,$emailField,$prefix,$isRandomPassword,$companySeq,$adminSeq);               
              $customMgr = CustomFieldMgr::getInstance();
              $isExist = $customMgr->isExists($adminSeq,$companySeq);
             if(!$isExist){
                saveFieldRowsData($fieldRows,$companySeq,$adminSeq);
             }             
             $message = "Imported data Saved successfully";
             updatePrefix($companySeq,$prefix);
             saveMatchingRules($userNameField,$passwordField,$emailField);
        }
         
       }catch(Exception $e){
            $success = 0;
            $message = ErrorUtil::checkDulicateEntryError($e);
        }
        $response = getResponse($success,$message);
        echo json_encode($response);
    }

   if($call == "saveCustomField"){
        $id = $_GET["id"];
        $fieldName = $_GET["fieldName"];
        $fieldType = $_GET["fieldType"];
        $mappedField = $_GET["mappedField"];
        $customField = new UserCustomField();
        $customField->setSeq(intval($id));
        $customField->setTitle($fieldName);
        $name =  str_replace(" ","_",trim($fieldName));
        $customField->setName($name);
        $customField->setFieldType($fieldType);
        $adminSeq =  $sessionUtil->getAdminLoggedInSeq();
        $customField->setCompanySeq($companySeq);
        $customField->setAdminSeq($adminSeq);
        $customField->setLastModifiedOn(new DateTime());
        $dataRow = "";
        try{
            $customFieldMgr = CustomFieldMgr ::getInstance();
            $dataRow = $customFieldMgr->saveCustomFields($customField,true);
            $id = $_GET["id"];
            $value = $fieldName;
            $arr = array();
            $attribute = "";
            if(isset($_GET["username_map"])){
                array_push($arr,"usernamefield");   
            }
            if(isset($_GET["password_map"])){                 
                array_push($arr,"passwordfield");    
            }
            if(isset($_GET["email_map"])){                
                 array_push($arr,"emailfield");                
            }
            if(!empty($arr)){
                $attribute = implode(",",$arr);    
            }            
            saveOrUpdateMatchingRules($value,$attribute,$mappedField);
            $dataRow["mappedfield"] = $attribute;
            $dataRow = json_encode($dataRow);
            $message  = "Custom Field Saved Sucessfully";
            if(intval($id) > 0){
              $message  = "Custom Field Updated Sucessfully";
            }
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
            $trace = $e->getTrace();
            if($trace[0]["args"][0][1] == "1062"){
                $message = StringConstants::DUPLICATE_CUSTOMFIELD_NAME;
            }  
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
            $isApplyFilter = true;
            $customfields = $customFieldMgr->getCustomfieldsForGrid($isApplyFilter);
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
       // $response = new ArrayObject();
       // $response["data"] = $customfields;
       // $json = json_encode($response);
        echo $customfields;
    }

    if($call == "isCustomFieldsExists"){
     $isExist = 0;
     try{
        $customFieldMgr = CustomFieldMgr ::getInstance();
        $isExist = $customFieldMgr->isExists($adminSeq,$companySeq);
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
    $response = new ArrayObject();
    $response["isExist"]  = $isExist;
    echo json_encode($response);
    }
    if($call == "deleteCustomfield"){
     $ids = $_GET["ids"];
     try{
        $customFieldMgr = CustomFieldMgr ::getInstance();
        $customFieldMgr->deleteCustomFields($ids);
        $message = "Record Deleted successfully";
    }catch(Exception $e){
        $success = 0;
        $message  = ErrorUtil::checkReferenceError("Field",$e);
    }
    $response = new ArrayObject();
    $response["message"]  = $message;
    $response["success"]  = $success;

    echo json_encode($response);
    }
    if($call == "getCustomFieldNames"){
     $isExist = 0;
     try{
        $customFieldMgr = CustomFieldMgr ::getInstance();
        $titles = $customFieldMgr->getCustomfieldTitles($adminSeq,$companySeq);
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
    $response = new ArrayObject();
    $response["names"]  = $titles;
    echo json_encode($response);
    }
    
    
    if($call == "getCustomFieldValuesByName"){
        try{
            $customFieldMgr = CustomFieldMgr ::getInstance();
            $customFieldName = $_GET["cusFieldName"];
            $values = $customFieldMgr->getCustomFieldValuesByName($customFieldName,$adminSeq);
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject();
        $response["values"]  = $values;
        echo json_encode($response);
    }
    if($call == "isBindingCompleted"){        
        $matchingRuleMgr = MatchingRuleMgr::getInstance();
        $unCompletedBindingFields = $matchingRuleMgr->getUncompletedBinding();
        $response = new ArrayObject();
        if(!empty($unCompletedBindingFields)){
             $response["success"]  = 0;
             $message = "Please Complete the custom field binding for ". implode(", ",$unCompletedBindingFields);    
        }
        $response["message"]  = $message;
        echo json_encode($response);     
    }
    function getResponse($success,$message){
        $response = new ArrayObject();
        $response["success"]  = $success;
        $response["message"]  = $message;
        return $response;
    }
    
    
    if($call == "getMatchingRule"){
        try{
            $matchingRuleMgr = MatchingRuleMgr::getInstance();       
            $matchingRule = $matchingRuleMgr->getMatchingRule();
            $json = "";
            if(isset($matchingRule)){
                $arr =  (array) $matchingRule;
                $json = json_encode($arr, JSON_FORCE_OBJECT);
                $json = str_replace("\\u0000MatchingRule\\u0000","",$json);    
            }
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $json = json_encode($json);
        echo $json;
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
     $msg = validateData($data,$userNameField,$passwordField,$emailField,$fieldData);
     return $msg;
    }


   function validateFieldData($fieldRows){
        $msg = array();
        $names = $fieldRows[0];
        unset($names["uid"]);
        $values = array();
        $duplicate = array();
        foreach($names as  $key => $value){
           if(StringUtil::IsNullOrEmptyString($value)){
                $msg[$key] = $key . " cannot be null";
           }else{
                 if (in_array($value, $values)){
                     $msg[$key] = $key . " has dulicate Value :- $value in imported file.";
                 }else{
                     array_push($values,$value);
                 }
           }
         }
         return $msg;

     }

     function validateData($data,$userNameField,$passwordField,$emailField){
        $msg = array();
        foreach($data as  $key => $value){
             $userName = $value[$userNameField];
             $rowNo = $key + 2;
             if(StringUtil::IsNullOrEmptyString($userName)){
                $msg["userName"] = "Value is null for selected $userNameField (UserName) field for Row no. " . $rowNo ;
             }
             $password = $value[$passwordField];
             if(StringUtil::IsNullOrEmptyString($password)){
                $msg["password"] = "Value is null for selected $passwordField (Password) field for Row no. " . $rowNo ;
             }
             if(!StringUtil::IsNullOrEmptyString($emailField)){
               $email = $value[$emailField];
               if(StringUtil::IsNullOrEmptyString($email)){
                    $msg["email"] = "Value is null for selected $emailField (EmailId) field for Row no. " . $rowNo;
               }
             }
             if(count($msg) > 0){
                 return $msg;
             }
         }
         return $msg;
     }
     
     function createCustomFieldObj($name,$type,$companySeq,$adminSeq) {
        $customField = new UserCustomField();
        $title = $name;
        $customField->setTitle($title);
        $name =  str_replace(" ","_",trim($name));
        $customField->setName($name);
        $customField->setFieldType($type);
        $customField->setCompanySeq($companySeq);
        $customField->setAdminSeq($adminSeq);
        $customField->setLastModifiedOn(new DateTime()); 
        return  $customField;
     }

     function saveFieldRowsData($fieldData,$companySeq,$adminSeq){
         $names = $fieldData[0];
         $types = $fieldData[1];
         unset($names["uid"]);
         unset($types["uid"]);
         $customFieldArr = array();
         foreach($names as  $key => $value){
            $customField = createCustomFieldObj($names[$key],$types[$key],$companySeq,$adminSeq);
            array_push($customFieldArr,$customField);
            try{
                $customFieldMgr = CustomFieldMgr ::getInstance();
                $id = $customFieldMgr->saveCustomFields($customField);
            }catch(Exception $e){
               // TODO Log Error Here---
            }
         }
     }

     
     
     function updatePrefix($companySeq,$prefix){
        $companyMgr = CompanyMgr::getInstance();
        $companyMgr->updateCompanyPrefix($companySeq,$prefix);   
     }
     function saveOrUpdateMatchingRules($value,$attribute,$mappedField){
        $matchingRuleMgr = MatchingRuleMgr::getInstance();
        $id = $matchingRuleMgr->SaveOrUpdateByCompany($value,$attribute,$mappedField);   
     }
     function saveMatchingRules($userNameField,$passwordField,$emailField){
        global $companySeq;
        global $adminSeq;
        $matchingRule = new MatchingRule();
        $matchingRule->setAdminSeq($adminSeq);
        $matchingRule->setCompanySeq($companySeq);
        $matchingRule->setUserNameField($userNameField);
        $matchingRule->setEmailField($emailField);
        $matchingRule->setPasswordField($passwordField);
        $matchingRuleMgr = MatchingRuleMgr::getInstance();
        $id = $matchingRuleMgr->saveMatchingRule($matchingRule);    
     }
     
     
?>
