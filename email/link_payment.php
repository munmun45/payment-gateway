<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);




if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $number = $_GET["number"];
    $amount = $_GET["amount"];
    $email = $_GET["email"];
    $order_id = $_GET["order_id"];






    try {


        $message_1 = "
        
            <p>
            Payment Successful:
            Mobile No : '.$number.' <br>
            Email Id : '.$email.' <br>
            Order Id : '.$order_id.' <br>
            Amount : '.$amount.' <br>
            
            </p>
        ";






        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->Port = 587;
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->Username = 'info@munmunmaharana.in';
        $mail->Password = 'dfgdsgb#2UGF41';

        $mail->setFrom('info@munmunmaharana.in', 'UPI PAYMENT SUCCESSFUL');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "We have got your payment";
        $mail->Body    = $message_1;

        $mail->send();



        echo "
            <script>
                localStorage.setItem('alert_Email', '1');
                window.location.href='../success.php';
            </script>
        ";
        exit;

    } catch (Exception $e) {


        echo "
            <script>
                localStorage.setItem('alert_Email', '2');
                window.location.href='../index.php';
            </script>
        ";
        exit;


    }
}
