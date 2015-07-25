<?php
require_once('Mandrill/Mandrill.php');
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
        $txt .= "\nEmployeeId: ". $employeeId;
        $txt .= "\nWork Location: ". $workLocation;
        $txt .= "\nInternet Speed: ". $internetSpeed;
        $txt .= "\nYour Location: ". $yourLocation;
        $txt .= "\nPhone No: ". $phoneNo;
        $txt .= "\nEmail Id: ". $emailId;
        $txt .= "\nProblem: ". $problemDetails;

        $to = "munishsethi777@gmail.com";
        $subject = "Contact Form at EZAE.IN";
        $headers = "From: noreply@ezae.in" . "\r\n" .
    "CC: amandeepdubey@gmail.com";
        mail($to,$subject,$txt,$headers);
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


}
?>
