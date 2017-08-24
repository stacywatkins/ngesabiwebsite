<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
require 'phpmailer' . DIRECTORY_SEPARATOR . 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'alexandria.aserv.co.za';                     // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'site@ngesabi.co.za';                 // SMTP username
$mail->Password = 'p}Xcff$gkTzg';                           // SMTP password
$mail->SMTPSecure = '';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('site@ngesabi.co.za', 'Ngesabi Website');
// $mail->addAddress('info@ngesabi.co.za', Ngesbi');     // Add a recipient
$mail->addAddress('stacy@generalgenius.co.za', 'Stacy Watkins');     // Add a recipient
$mail->addReplyTo('site@ngesabi.co.za', 'Ngesabi Website');

$mail->isHTML(true);                                  // Set email format to HTML

$valid = true;

$emailContent = [
    'name' => isset($_POST['name']) ? $_POST['name'] : '',
    'email' => isset($_POST['email']) ? $_POST['email'] : '',
    'phone' => isset($_POST['email']) ? $_POST['phone'] : '',
    'message' => isset($_POST['message']) ? $_POST['message'] : '',
];

$errors = [
    'name' => $emailContent['name'] === '',
    'email' => $emailContent['email'] === '',
    'phone' => $emailContent['phone'] === '',
    'message' => $emailContent['message'] === ''
];

$valid = !$errors['name'] && !$errors['email'] && !$errors['message'] && !$errors['phone'];

if (!$valid) {
    echo json_encode(['status' => 400, 'errors' => $errors]);
    return;
}

$mail->Subject = 'You\'ve received an email from your website';

$mail->Body    = '';
foreach($emailContent as $key => $value) {
    $mail->Body .= implode(': ', [ucfirst($key), $value]) . '<br />';
}

if(!$mail->send()) {
    echo json_encode(['status' => 500, 'errors' => $mail->ErrorInfo]);
} else {
    echo json_encode(['status' => 200]);
}