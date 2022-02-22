<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$mail2 = new PHPMailer(true);

try {
    //Server settings
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
   
    $mail->isSMTP();
	$mail->Host = 'smtpout.secureserver.net';
	$mail->Port = '587';
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls';
	$mail->Username   = 'info@peekchat.live';                     //SMTP username
    $mail->Password   = 'Toseef3@789';  
                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
// var_dump($mail);
    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('info@peekchat.live', $name);     //Add a recipient
  


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = strip_tags(nl2br($message." \n".$phone));
    

    $mail->send();


     $mail2->isSMTP();
	 $mail2->Host = 'smtpout.secureserver.net';
	 $mail2->Port = '587';
	 $mail2->SMTPAuth = true;
	 $mail2->SMTPSecure = 'tls';
	 $mail2->Username   = 'info@peekchat.live';                     //SMTP username
     $mail2->Password   = 'Toseef3@789';  
                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
// var_dump($mail);
    //Recipients
    $mail2->setFrom('info@peekchat.live', 'Peekchat');
    $mail2->addAddress($email, $name);     //Add a recipient
  
    //Content
    $mail2->isHTML(true);                                  //Set email format to HTML
    $mail2->Subject = $subject;
    $mail2->Body    = 'Hi ' . $name . ',<br> Your email has been received. We will get in touch with you soon.';
    $mail2->send();
	
	$arrResult = array ('response'=>'success');
} catch (Exception $e) {
	$arrResult = array ('response'=>'error','errorMessage'=>$e->errorMessage());
} catch (\Exception $e) {
	$arrResult = array ('response'=>'error','errorMessage'=>$e->getMessage());
}

if ($debug == 0) {
	echo json_encode($arrResult);
}

?>