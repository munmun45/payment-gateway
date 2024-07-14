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




require("../admin/config.php");




if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $product_id = $_GET['book_id'];
    $name = $_GET['name'];
    $number = $_GET['number'];
    $email = $_GET['email'];
 
    $product_price = $_GET['price'];
    $product_name = $_GET['book_name'];

    $sql = "SELECT `message` FROM `books` WHERE `id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($message);

    if ($stmt->fetch()) {

        // Create a new PHPMailer instance and configure it here
        
        
       
        
        
        
        
        
        $message_1 = "
        
                <p style='font-size: 20px' >
        
        
                    Dear ".$_GET['name'].", <br> <br>
                    Greetings for the day!
                    Thank you for your interest in our Notes.<br><br><br>
                    
                    
                    YOUR NAME:- ".$_GET['name']." <br>
                    YOUR PHONE NUMBER:- ".$_GET['number']." <br>
                    ORDER ID:- ".$_GET['order_id']." <br>
                    YOUR MAIL ID:- ".$_GET['email']." <br>
                    YOUR PURCHASE NOTE:- ".$_GET['book_name']." <br> <br>
                    
                    
                    Click on Below link👇👇
                    and PDF password 👉👉 satyasir  <br> <br>
                    
                    
                    
                    $message <br><br>
                    
                    Best of luck of Your Examination. <br><br><br><br><br>



 
                    N:B-This Note is only for Read.You can't download/print. <br>
                    
                    For more information call or message 9658255553 (Morning 10 a.m-Evening 4 p.m) <br> <br><br><br><br> <br><br>
                    
                    Regards, <br>
                    For B.Ed. admission or any other information <br>
                    Satyam Education (ଶିକ୍ଷ୍ୟା ସତ୍ୟମ୍) Team <br>
                    Satya sir-9658255553(10am-6pm) <br>
                
                </p>
            
            
            ";
            
        
        
        

        try {


            // $message_1 = " Name : - " . $name . " <br> Number : - " . $number . " <br> Email : - " . $email .   "  <br> Paid Amount : - ₹" . $product_price .   " <br>  <br> " . $message;
            
            
            
            
            
            
            
            


            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com';
            $mail->Port = 587;
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->Username = 'info@satyameducation.org.in';
            $mail->Password = 'Qwertyuiop1@';

            $mail->setFrom('info@satyameducation.org.in', 'Satyam Education');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "We have got your payment";
            $mail->Body    = $message_1;

            $mail->send();

            // Update status in the database
            $stmt->close();




            $status="Successful";


            $sql = "INSERT INTO `order_list` (`name`, `number`, `email`, `book_name`, `book_id`, `price`, `status`, `date`) VALUES (?, ?, ?, ?, ?, ?, ?, current_timestamp())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $name, $number, $email, $product_name, $product_id, $product_price, $status);
            $stmt->execute();
            $stmt->close();
        
           




            
            
            
            
            
            
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
        // echo "No record found with ID: $id";
    }

    $stmt->close();
}
