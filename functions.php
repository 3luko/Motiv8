<?php
include('connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$env = parse_ini_file('.env');

require 'vendor/autoload.php';

function send_Entry_Mail($email, $username)
{
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
        $mail->setFrom('noreplymotiv8@gmail.com', 'Motiv8');
        $mail->addAddress($email, 'Ethan Lukoooo');     //Add a recipient
        $mail->addReplyTo('noreplymotiv8@gmail.com', '3luko');      //Name is optional

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Welcome to Motiv8 ' . $username . '!';
        $mail->Body    = 'This will be your first quote: Try your best in everything you do. Your time will come.';

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function addUser($input) {}

function checkEmail($conn, $email)
{
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return false;
    }
}

function checkUser($conn, $username)
{
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return false;
    }
}
function isEmpty($input)
{
    if (empty($input)) {
        echo "Please fill all fields.";
        return true;
    }
    return false;
}

function isGmail($email)
{
    $gmailAccount = trim($email);

    if (strpos($gmailAccount, '@gmail.com') !== false) {
        return true;
    }
    echo "Please enter a Gmail Account.";
    return false;
}

function quote_of_the_week($email, $username)
{
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
        $mail->setFrom($env['SMTP_USER'], 'Motiv8');
        $mail->addAddress($email, $username);     //Add a recipient

        //Hard coding the image for the email
        $mail->addEmbeddedImage('images/image.png', 'logo', 'image.png');

        //Fetch the quote from API
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://zenquotes.io/api/random");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);

        $quoteArray = json_decode($output, true);
        if ($quoteArray && is_array($quoteArray)) {
            $quote = $quoteArray[0]['q'];
            $author = $quoteArray[0]['a'];
        } else {
            $quote = "Keep moving forward no matter what.";
            $author = "Unknown";
        }

        $emailBody = '<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Email</title>
  <link rel="stylesheet" href="./style.css ?<?php echo time(); ?>" />
  <link rel="icon" href="./favicon.ico" type="image/x-icon" />
</head>

<body>
  <main>
    <div>
      <h1 style="text-align: center; font-family: monospace;">"' . $username . '"</h1>
    </div>
    <div style="height: 250;
    width: 50%;
    padding-bottom: 20%;
    background-color: black;
    text-align: center;
    margin: auto;
    color: white;
    padding: 50px;
    font-family: monospace">
      <img src="cid:logo" height="100" width="250">
      <h3 style="color:white; font-family: monospace;">
       "' . $quote . '"<br>
       <small>- ' . $author . '</small>
      </h3>
    </div>
  </main>
</body>
</html>';


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Quote of the week';
        $mail->Body    = $emailBody;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
