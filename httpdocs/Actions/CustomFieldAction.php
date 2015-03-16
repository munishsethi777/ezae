 <?php
 require_once('../IConstants.inc');  
 require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomFieldMgr.php");
   $call = $_GET["call"];  
   $success = 1;
   $message = "";
   $response["message"]  = "";
     
    if($call == "saveCustomField"){
        $dataRow = "";
        try{       
            $customFieldMgr = CustomFieldMgr ::getInstance();
            $dataRow = $customFieldMgr->saveCustomFields(true);
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
            $customfields = $customFieldMgr->getCustomfieldsForGrid();
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        $response = new ArrayObject(); 
        //$response["success"]  = $success;
        //$response["message"]  = $message;
        $response["data"] = $customfields;
        
        echo json_encode($response);
    }  
    
     if($call == "deleteCustomfield"){ 
         try{       
            $customFieldMgr = CustomFieldMgr ::getInstance();
            $customfields = $customFieldMgr->deleteCustomFields();
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
?>
