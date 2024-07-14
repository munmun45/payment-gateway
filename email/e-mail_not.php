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




require("../config.php");




if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $id = $_GET['id'];
    $_book_id = $_GET['book_id'];
    $_name = $_GET['name'];
    $number = $_GET['number'];
    $email = $_GET['email'];
    $book_price = $_GET['book_price'];
    $book_name = $_GET['book_name'];

    $sql = "SELECT `message` FROM `books` WHERE `id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_book_id);
    $stmt->execute();
    $stmt->bind_result($message);

    if ($stmt->fetch()) {
        
        
        
        $message_1 = "
        
        <p style='font-size: 20px' >
        
        
        Dear ".$_GET['name'].", <br> <br>
        Greetings for the day! <br>
        Thank you for your interest in our Notes. <br><br><br>
        
        
        YOUR NAME:- ".$_GET['name']." <br>
        YOUR PHONE NUMBER:- ".$_GET['number']." <br>
        ORDER ID:- ".$_GET['order_id']." <br>
        YOUR MAIL ID:- ".$_GET['email']." <br>
        YOUR PURCHASE NOTE:- ".$_GET['book_name']." <br> <br>
        
        <span style='color:red;  > But Satyam Education (ଶିକ୍ଷ୍ୟା ସତ୍ୟମ୍) will not send your note because your payment has not reached us .
        
        <br><br>
        
        For more information call or message 9658255553 (Morning 10 a.m-Evening 4 p.m) </span> <br><br><br><br><br><br><br>
        
        Regards, <br>
        For B.Ed. admission or any other information <br>
        Satyam Education (ଶିକ୍ଷ୍ୟା ସତ୍ୟମ୍) Team <br>
        Satya sir-9658255553(10am-6pm) <br>
        
        </p>
        
        
        ";
        
        


        try {


            


            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com';
            $mail->Port = 587;
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->Username = 'info@satyameducation.org.in';
            $mail->Password = 'Qwertyuiop1@';

            $mail->setFrom('info@satyameducation.org.in', "Satyam Education");
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Payment Faild.";
            $mail->Body    = "$message_1";

            $mail->send();

            // Update status in the database
            // $stmt->close();

            $status = "Faild";


            $sql = "INSERT INTO `order_list` (`name`, `number`, `email`, `book_name`, `book_id`, `price`, `status`, `date`) VALUES (?, ?, ?, ?, ?, ?, ?, current_timestamp())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $_name, $number, $email, $book_name, $_book_id, $book_price, $status);
            $stmt->execute();
            $stmt->close();
        

            // Redirect or respond with success message
            echo "
                <script>
                    localStorage.setItem('alert_Email', '1');
                    window.location.href='../index.php';
                </script>
            ";
            exit;
        } catch (Exception $e) {
            // Handle exceptions here
            echo "
                <script>
                    localStorage.setItem('alert_Email', '2');
                    window.location.href='../index.php';
                </script>
            ";
            exit;
        }
    } else {
        echo "No record found with ID: $id";
    }

    $stmt->close();
}
