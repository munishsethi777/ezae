<?php
    require_once('../IConstants.inc');  
    require_once($ConstantsArray['dbServerUrl'] ."Managers/MailMessageMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/MailMessageMailMgr.php");
     require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/MailMessage.php");
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/MailMessageMail.php");
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/MailAction.php");
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/MailMessageLearningProfile.php");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php5");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/MailMessageDataStore.php");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/MailMessageActionDataStore.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php5");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/MailMessageUtil.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/MessageConditions.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/LearningProfileMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
    $call = "";
    $success = 1;
    $message = "";
    $mmMgr = MailMessageMgr::getInstance();
    if(isset($_GET["call"]) && $_GET["call"] == "getMailMessageForGrid"){
        try{ 
            $data = $mmMgr->getMailMessageForGrid();
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        echo $data;  
    }
    
    if(isset($_GET["call"]) && $_GET["call"] == "deleteMessages"){
         $ids = $_GET["ids"];
         try{
            $mmMgr->deleteByIds($ids);
            $message = "Record Deleted successfully";
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
        }
        writeResponse($message,$success);
    }
     if(isset($_POST["call"]) && $_POST["call"] == "saveMailMessage"){
        try{
            $id = 0;
            if(isset($_POST["id"]) && !empty($_POST["id"])){
                $id =  intval($_POST["id"]);    
            }
            $name = $_POST["name"];
            $subject = $_POST["subject"];
            $messageText = $_POST["messageText"];
            $condition = $_POST["actOption"];
            $senddate = new DateTime();
            if(isset($_POST["sendDate"])){
                if(!empty($_POST["sendDate"])){                
                    $senddate = DateUtil::StringToDate($_POST["sendDate"]);    
                }
            }
            $mailMessage = new  MailMessage();
            $mailMessage->setSeq($id);
            $mailMessage->SetMessage($messageText);
            $mailMessage->SetName($name);
            $mailMessage->SetSubject($subject);
            
            $id = $mmMgr->save($mailMessage);
            //Delete Earlier Mail Mesasge Action for messageid
            $mmMgr->deleteMailMessageAction($id);
            $mmMgr->deleteMailMessageLearningProfiles($id);
            //Save MailMessageAction
            $lpSeqs = array();        
            if($condition == MessageConditions::ON_PARTICULER_DATE){
                $lpSeqs = $_POST["learningPlanDD"];
                foreach($lpSeqs as $lpseq){
                    saveMailMessageAction($id,0,$lpseq);   
                }               
            }else{
                $moduleSeqs = $_POST["moduleDD"];
                foreach($moduleSeqs as $moduleseq){
                    $seqs = explode("_",$moduleseq);
                    $lpseq = 0;
                    $moduleseq = $seqs[0];
                    if(count($seqs) > 1){
                        $lpseq = $seqs[0];
                        $moduleseq = $seqs[1];   
                    }
                    saveMailMessageAction($id,$moduleseq,$lpseq);
                    array_push($lpSeqs,$lpseq);
                }    
               
            } 
            $message = StringConstants::MAIL_MESSAGE_SAVED;
            $mailMessageUtil = MailMessageUtil::getInstance();
            $mailMessageUtil->checkForPariculerDateNotification($condition,$lpSeqs,$senddate); 
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();
            if($id > 0){
                $mmMgr->deleteByIds($id);   
            }
            $trace = $e->getTrace();
            if($trace[0]["args"][0][0] == "23000"){
                $message = StringConstants::MAIL_MESSAGE_DUPLICATE;    
            }
                
        }
        $response = new ArrayObject();
        $response["message"]  = $message;
        $response["success"]  = $success;
        echo json_encode($response);
     }
     
     function writeResponse($message,$success){
        $response = new ArrayObject();
        $response["message"]  = $message;
        $response["success"]  = $success; 
        echo json_encode($response);   
     }  
     function saveMailMessageAction($id,$moduleseq,$lpseq){
        global $mmMgr;
        $condition = $_POST["actOption"];
        if($condition == MessageConditions::ON_MARKS){
            $condition =   $_POST["conditionOperator"];      
        }
        $senddata = null;
        if(!empty($_POST["sendDate"])){                
            $senddata = DateUtil::StringToDate($_POST["sendDate"]);    
        }
       
        $modulemarks = 0;
        if(!empty($_POST["percent"])){
            $modulemarks = $_POST["percent"];    
        }

       
        $mailAction  = new MailAction();                
        $mailAction->setMessageCondition($condition);
        $mailAction->setGettingMarksValue($modulemarks);
        $mailAction->setLearningPlanSeq($lpseq);
        $mailAction->setMessageId($id);
        $mailAction->setModuleSeq($moduleseq);
        $mailAction->setSendOnDate($senddata);        
        //Save MailMessageAction
        $mailActionId = $mmMgr->saveMailMessageAction($mailAction);       
        if($mailActionId > 0){
            //save MailMessage LearningProfile
            $mmMgr->saveMailMessageLearningProfile($id,$lpseq);    
        }
        
        
     }
?>
