<?php
    require_once('../IConstants.inc');  
    require_once($ConstantsArray['dbServerUrl'] ."Managers/MailMessageMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/MailMessage.php");
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/MailAction.php");
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/MailMessageLearningProfile.php");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php5");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/MailMessageDataStore.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php5");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/MessageConditions.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/LearningProfileMgr.php");
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
            if($condition == MessageConditions::ON_PARTICULER_DATE){
                $lpSeqs = $_POST["learningPlanDD"];
                foreach($lpSeqs as $lpseq){
                    saveMailMessageAction($id,0,$lpseq);   
                }               
            }else{
                $moduleSeqs = $_POST["moduleDD"];
                foreach($moduleSeqs as $moduleseq){
                    $seqs = explode("_",$moduleseq);
                    $lpseq = $seqs[0];
                    $moduleseq = $seqs[1];
                    saveMailMessageAction($id,$moduleseq,$lpseq);   
                }    
               
            } 
            $message = "Mail Message Saved Successfully."; 
        }catch(Exception $e){
            $success = 0;
            $message  = $e->getMessage();    
        }
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
        $mmMgr->saveMailMessageAction($mailAction);
       
        //save MailMessage LearningProfile
        $mmMgr->saveMailMessageLearningProfile($id,$lpseq);
     }
?>
