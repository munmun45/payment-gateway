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






$message_1 = "
        
                <p  jwedfwdf
                
                </p>
            
            
            ";





try {


    // $message_1 = " Name : - " . $name . " <br> Number : - " . $number . " <br> Email : - " . $email .   "  <br> Paid Amount : - ₹" . $product_price .   " <br>  <br> " . $message;










    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->Port = 587;
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->Username = 'contact@munmunmaharana.in';
    $mail->Password = 'dgfsdfg@#652H';

    $mail->setFrom('contact@munmunmaharana.in', 'Satyam Education');
    $mail->addAddress('maharanamunmun@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = "We have got your payment";
    $mail->Body    = $message_1;

    $mail->send();








    echo " s            ";






    // echo "
    //     <script>
    //         localStorage.setItem('alert_Email', '1');
    //         window.location.href='../index.php';
    //     </script>
    // ";
    // exit;
} catch (Exception $e) {
    // Handle exceptions here
    // echo "
    //     <script>
    //         localStorage.setItem('alert_Email', '2');
    //         window.location.href='../index.php';
    //     </script>
    // ";
    // exit;

    echo " e            ";
}
