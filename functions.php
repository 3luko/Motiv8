<?php
include('connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$env = parse_ini_file('.env');

require 'vendor/autoload.php';

function send_Entry_Mail($email){
    $mail = new PHPMailer(true);
    $env = parse_ini_file('.env');

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $env['SMTP_USER'];                      //SMTP username
        $mail->Password   = $env['SMTP_PASSWORD'];                  //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('noreplymotiv8@gmail.com', 'Mailer');
        $mail->addAddress($email, 'Ethan Lukoooo');     //Add a recipient
        $mail->addReplyTo('noreplymotiv8@gmail.com', '3luko');      //Name is optional

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Welcome to Motiv8!';
        $mail->Body    = 'This will be your first quote: Try your best in everything you do. Your time will come.';

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}

function addUser($input){

}

function checkEmail($conn, $email){
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $stmt->close();
        return true;
    } else{
        $stmt->close();
        return false;
    }
}

function checkUser($conn, $username){
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $stmt->close();
        return true;
    } else{
        $stmt->close();
        return false;
    }
}
function isEmpty($input){
    if (empty($input)){
        echo "Please fill all fields.";
        return true;
    }
    return false;
}

function isGmail($email){
    $gmailAccount = trim($email);

    if (strpos($gmailAccount, '@gmail.com') !== false){
        return true;
    } 
    echo "Please enter a Gmail Account.";
    return false;
}