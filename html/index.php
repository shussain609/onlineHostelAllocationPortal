<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
set_time_limit(600);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'hostelallotmentism@gmail.com';                // SMTP username
    $mail->Password ='azsxdcfvgbhnjm';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('hostelallotmentism@gmail.com', 'administration');
    $mail->addAddress('khobaib222@gmail.com', 'khobaib');     // Add a recipient             // Name is optiona

    //Attachments
   // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'hackfest';
    $mail->Body    = 'your code is 1235';
    $mail->AltBody = 'your code is 1234';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}