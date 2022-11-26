<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class wsp_mailer{

    function send_mail($recipent,$subject,$message,$attachment_path){
        global $options_fetch_controller;
        global $mailer_sandbox;
        global $mailer_live;
        global $mailer_additional;
        // Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
//Load Composer's autoloader
require 'phpmailer6/vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Mail configurations from general_config.php
    $mail_config = $mailer_sandbox; //Replace variable if live or sandbox
    $mail_host = $mail_config[0];
    $mail_username = $mail_config[1];
    $mail_password = $mail_config[2];
    $mail_protocol = $mail_config[3];
    $mail_port = $mail_config[4];
    $mail_from_name = $mail_config[5];
    //Mail configurations from general_config.php

    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $mail_host;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $mail_username;                 // SMTP username
    $mail->Password = $mail_password;                           // SMTP password
    $mail->SMTPSecure = $mail_protocol;                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $mail_port;                                    // TCP port to connect to

    //Recipients
    $sender_mail = $mail_username;
    $sender_name = $mail_from_name;
    $mail->setFrom($sender_mail, $sender_name);

    $mail->addAddress($recipent);     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    if($mail_config[7] != ""){
    $mail->addReplyTo($mail_config[7],$mail_config[8] ?: $mail_from_name);
    }
    
    if($mail_config[6] != ""){
    $mail->addCC($mail_config[6]);
    }
    //$mail->addBCC('bcc@example.com');

    //Attachments
    if($attachment_path != ""){
    $mail->addAttachment($attachment_path);         // Add attachments
}
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = $message;

    $mail->send();

    
//Save Email Transaction
$record_controller = new records_insert_controller();
//Insert Items
$record_type = "email";
$record_type_array_insert = array("email_from"=>$sender_mail,"email_to"=>$recipent,"email_subject"=>$subject,"email_status"=>"Sent","email_body"=>$message,"email_attachments"=>$attachment_path,"date_created"=>generate_mysql_timestamp());
$insert_record = $record_controller->insert_record([$record_type_array_insert,$record_type]);
//Save Email Transaction

    return true;
} catch (Exception $e) {
    echo 
    $response = array("status"=>"failure","message"=>'Message could not be sent. Mailer Error: ', $mail->ErrorInfo);
    $response = json_encode($response);
	print_r($response);
}

    }

}

?>