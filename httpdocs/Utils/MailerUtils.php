<?php
require_once($ConstantsArray['dbServerUrl'] . "Mandrill/Mandrill.php");
require_once($ConstantsArray['dbServerUrl']. "Managers/MailMessageMailMgr.php");
require_once($ConstantsArray['dbServerUrl']. "Managers/MailMessageMgr.php");
require_once($ConstantsArray['dbServerUrl']. "Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] . "Utils/ses/class.phpmailer.php");
require_once($ConstantsArray['dbServerUrl'] . "Utils/ses/class.smtp.php");
class MailerUtils{

    public static function sendContactEmail($GET){
        $name = $GET['name'];
        $employeeId = $GET['employeeId'];
        $workLocation = $GET['workLocation'];
        $internetSpeed = $GET['internetSpeed'];
        $yourLocation = $GET['yourLocation'];
        $phoneNo = $GET['phoneNo'];
        $emailId = $GET['emailId'];
        $problemDetails = $GET['problemDetails'];

        $txt = "Name: ". $name;
        $txt .= "<br/>EmployeeId: ". $employeeId;
        $txt .= "<br/>Work Location: ". $workLocation;
        $txt .= "<br/>Internet Speed: ". $internetSpeed;
        $txt .= "<br/>Your Location: ". $yourLocation;
        $txt .= "<br/>Phone No: ". $phoneNo;
        $txt .= "<br/>Email Id: ". $emailId;
        $txt .= "<br/>Problem: ". $problemDetails;

        $to = "baljeetgaheer@gmail.com";
        $subject = "Contact Form at EZAE.IN";
        $headers = "From: noreply@ezae.in" . "\r\n" .
    "CC: baljeetgaheer@gmail.com@gmail.com";
        $mailMessage = new MailMessage();
        $mailMessage->setMessage($txt);
        $mailMessage->setSubject("Contact Form at EZAE.IN");
        $user = new User();
        $user->setEmailId($to);
        $user->setUserName($name);
        MailerUtils::sendMandrillEmailNotification($mailMessage,$user);
        return true;
    }

    public static function sendMandrillEmail(){

            try {
                $mandrill = new Mandrill('knMTJMqu1M6pPB5zahJ6XA');
                $message = array(
                    'html' => '<p>Example HTML content</p>',
                    'text' => 'Example text content',
                    'subject' => 'example subject',
                    'from_email' => 'noreply@ezae.in',
                    'from_name' => 'Example Name',
                    'to' => array(
                        array(
                            'email' => 'munishsethi777@gmail.com',
                            'name' => 'Recipient Name',
                            'type' => 'to'
                        )
                    ),
                    'headers' => array('Reply-To' => 'noreply@ezae.in'),
                    'important' => false,
                    'track_opens' => null,
                    'track_clicks' => null,
                    'auto_text' => null,
                    'auto_html' => null,
                    'inline_css' => null,
                    'url_strip_qs' => null,
                    'preserve_recipients' => null,
                    'view_content_link' => null,
                    'bcc_address' => 'munishsethi777@gmail.com',
                    'tracking_domain' => null,
                    'signing_domain' => null,
                    'return_path_domain' => null,
                    'recipient_metadata' => array(
                        array(
                            'rcpt' => 'munishsethi777@gmail.com',
                            'values' => array('user_id' => 'munishsethi777')
                        )
                    )
                );
                $async = false;
                $ip_pool = 'Main Pool';
                $result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
                print_r($result);
                /*
                Array
                (
                    [0] => Array
                        (
                            [email] => recipient.email@example.com
                            [status] => sent
                            [reject_reason] => hard-bounce
                            [_id] => abc123abc123abc123abc123abc123
                        )

                )
                */
            } catch(Mandrill_Error $e) {
                // Mandrill errors are thrown as exceptions
                echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
                // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
                throw $e;
            }
    }

        
        
        
        public static function sendMandrillEmailNotification($mailMessage,$user){
            MailerUtils::sendSESEmailNotification($mailMessage->getMessage(), $mailMessage->getSubject(),null,$user->getEmailId());    
            //try {
//                $mandrill = new Mandrill('knMTJMqu1M6pPB5zahJ6XA');
//                $async = "";
//                $ip_pool = "";
//                $send_at = "";
//                $message = array(
//                    'html' => $mailMessage->getMessage(),
//                    'text' => $mailMessage->getMessage(),
//                    'subject' => $mailMessage->getSubject(),
//                    'from_email' => 'noreply@ezae.in',
//                    'from_name' => 'Ezae Admin',
//                    'to' => array(
//                        array(
//                            'email' => $user->getEmailId(),
//                            'name' => $user->getUserName(),
//                            'type' => 'to'
//                        )
//                    ),
//                    'headers' => array('Reply-To' => 'noreply@ezae.in'),
//                    'important' => false,
//                    'track_opens' => null,
//                    'track_clicks' => null,
//                    'auto_text' => null,
//                    'auto_html' => null,
//                    'inline_css' => null,
//                    'url_strip_qs' => null,
//                    'preserve_recipients' => null,
//                    'view_content_link' => null,
//                    'bcc_address' => 'munishsethi777@gmail.com',
//                    'tracking_domain' => null,
//                    'signing_domain' => null,
//                    'return_path_domain' => null,
//                    'recipient_metadata' => array(
//                        array(
//                            'rcpt' => 'munishsethi777@gmail.com',
//                            'values' => array('user_id' => 'munishsethi777')
//                        )
//                    )
//                );
//                $async = false;
//                $ip_pool = 'Main Pool';
//                $result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
                //print_r($result);
//                /*
//                Array
//                (
//                    [0] => Array
//                        (
//                            [email] => recipient.email@example.com
//                            [status] => sent
//                            [reject_reason] => hard-bounce
//                            [_id] => abc123abc123abc123abc123abc123
//                        )

//                )
//                */
//            } catch(Mandrill_Error $e) {
                // Mandrill errors are thrown as exceptions
//                echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
                // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
//                throw $e;
//            }
    }
        //Calling this function from cron job---
        public static function excuteSendNotifications(){
            $mailMessageMailMgr = MailMessageMailMgr::getInstance();
            $mailMessageMails = $mailMessageMailMgr->getPendingMessages();
            $mailMessageMgr = MailMessageMgr::getInstance();
            $userMgr = UserMgr::getInstance();
            foreach($mailMessageMails as $mailMessageMail){
                try{
                    $obj = new  MailMessageMail();
                    $obj = $mailMessageMail;
                    $mailMessageActionSeq = $obj->getMessageActionSeq();
                    $userSeq =  $obj->getUserSeq();
                    $mailMessage = $mailMessageMgr->findByMailMessageActionSeq($mailMessageActionSeq);
                    $user = $userMgr->findBySeq($userSeq);
                    self::sendMandrillEmailNotification($mailMessage,$user);
                    $obj->setSentOn(new DateTime());
                    $obj->setStatus("Sent");
                }catch(Mandrill_Error $e){
                    $obj->setFailureError("Error during sending email " . $e->getMessage());
                    $failuerCounter = intval($obj->getFailureCounter());
                    $obj->setFailureCounter($failuerCounter + 1);
                    $obj->setStatus("Fail");
                }
                //update mailMessageMail
               $mailMessageMailMgr->save($obj);
            }
        }
        
        
        
        private function sendSESEmailNotification($message,$subject,$from,$to,$cc=null,$bcc=null){
            try{
                $host = 'ssl://email-smtp.us-west-2.amazonaws.com';
                $port = 443;
                $user = 'AKIAJYPTWUNYHKCXUVRA';  //'AKIAJWYIGTNFZEQRG67A';//
                $pass = 'AsHTg3oScaZcc+yjZdqANdON9ubyJfJ417Hzs9IBF19/';//'AjQGBsfMw7HomawOKOqVexqr1EwijL1bu3GZynvNU/cy';//
                $from = "noreply@ezae.in";
                //$to = "munishsethi777@gmail.com";

                $mail = new PHPMailer();
                $mail->IsSMTP(true);
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth   = true;
                $mail->Mailer = "smtp";
                $mail->Host = $host;
                $mail->Port = $port;
                $mail->Username = $user;
                $mail->Password = $pass;
                $mail->SetFrom($from, 'EZAE');
                $mail->AddReplyTo($from,'EZAE');
                $mail->Subject = $subject;
                $mail->MsgHTML($message);
                $toAddresses = explode(",",$to);
                foreach($toAddresses as $toAdd){
                    $mail->AddAddress($toAdd, $toAdd);
                }
                $mail->addBCC("munishsethi777@gmail.com","munishsethi777@gmail.com");
                //var_dump($mail);
                if(!$mail->Send()){
                    return "false";
                }else{
                    return "true";
                }
            } catch (phpmailerException $e) {
              echo $e->errorMessage(); //Pretty error messages from PHPMailer
            } catch (Exception $e) {
              echo $e->getMessage(); //Boring error messages from anything else!
            }
        }
}
?>
