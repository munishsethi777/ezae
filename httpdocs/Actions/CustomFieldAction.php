<?php
 require_once('../IConstants.inc');
 require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomFieldMgr.php");
 require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php"); 
 require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/User.php");
 require_once($ConstantsArray['dbServerUrl'] ."Utils/StringUtil.php"); 
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
        $data = $_GET["data"];
        $data = str_replace('\\', '', $data);
        $rows = json_decode($data,true);
        $userNameField = $_GET["userName"];
        $passwordField = $_GET["password"];
        $emailField = $_GET["emailId"];
        $prefix = $_GET["userNamePrefix"];
        $randomPassword = "off";
        if(isset($_GET["randomPassword"])){
           $randomPassword =$_GET["randomPassword"];
        }

        $isRandomPassword = $randomPassword == "on";
        $fieldData = $_GET["fieldData"];
        $fieldData = str_replace('\\', '', $fieldData);
        $fieldRows = json_decode($fieldData,true);


        $msg = validateImportedData($rows,$fieldRows,$userNameField,$passwordField,$emailField);
        if(count($msg) > 0){
            $success = 0;
            foreach($msg as  $key => $value){
                $message .=  $value . "<br/>";
            }
        }else{
             $customMgr = CustomFieldMgr::getInstance();
             $isExist = $customMgr->isExists($adminSeq,$companySeq);
             if(!$isExist){
                saveFieldRowsData($fieldRows,$companySeq,$adminSeq);
             }
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
        $customField = new UserCustomField();
        $customField->setSeq(intval($id));
        $customField->setTitle($fieldName);
        $name =  str_replace(" ","_",trim($fieldName));
        $customField->setName($name);
        $customField->setFieldType($fieldType);
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
        $message  = $e->getMessage();
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
        unset($names["uid"]);
        $values = array();
        $duplicate = array();
        foreach($names as  $key => $value){
           if(StringUtil::IsNullOrEmptyString($value)){
                $msg[$key] = $key . " cannot be null";
           }else{
                 if (in_array($value, $values)){
                     $msg[$key] = $key . " has dulicate Value :- $value .";
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

     function createCustomFieldObj($name,$type,$companySeq,$adminSeq) {
        $customField = new UserCustomField();
        $title = $name;
        $customField->setTitle($title);
        $name =  str_replace(" ","_",trim($name));
        $customField->setName($name);
        $customField->setFieldType($type);
        $customField->setCompanySeq($companySeq);
        $customField->setAdminSeq($adminSeq);
        return  $customField;
     }

     function saveFieldRowsData($fieldData,$companySeq,$adminSeq){
         $names = $fieldData[0];
         $types = $fieldData[1];
         unset($names["uid"]);
         unset($types["uid"]);
         foreach($names as  $key => $value){
            $customField = createCustomFieldObj($names[$key],$types[$key],$companySeq,$adminSeq);
            try{
                $customFieldMgr = CustomFieldMgr ::getInstance();
                $id = $customFieldMgr->saveCustomFields($customField);
            }catch(Exception $e){
                //TODO Log Error Here---
            }
         }
     }

     function saveUserRowsData($data,$userNameField,$passwordField,$emailId,$prefix,$isRandom,$companySeq,$adminSeq){
        $userMgr = UserMgr::getInstance();
        foreach($data as  $key => $value){
            $userName = $prefix . $value[$userNameField];
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
               //$val = urlencode($val);
                $customVal .= $id .":". $val .";";
            }
            $user->setCustomFieldValues($customVal);
            $userMgr->Save($user);
        }
     }
?>
