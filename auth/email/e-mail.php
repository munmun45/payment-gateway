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



$dsn = 'mysql:host=localhost;dbname=u965631061_payment';
$username = 'u965631061_payment';
$password = '7*GLkvKyQVmm';




if ($_SERVER['REQUEST_METHOD'] === 'GET') {


    $user_token = $_GET["token"];
    $duration = $_GET["days"];
    $order_id = $_GET["order_id"];
    $email = $_GET["email"];
    $amount = $_GET["amount"];



    $api_url = "https://munmunmaharana.in/payment/api/check-order-status";

    $postData = array(
        "user_token" => $user_token,
        "order_id" => $order_id
    );

    $ch = curl_init($api_url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "cURL Error: " . curl_error($ch);
        exit;
    }

    curl_close($ch);

    error_log("API response: $response");

    $responseData = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "JSON Error: " . json_last_error_msg();
        exit;
    }

    if ($responseData["status"] === "SUCCESS") {

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT expiry FROM users WHERE user_token = :user_token");
            $stmt->execute(['user_token' => $user_token]);
            $expiry_date = $stmt->fetchColumn();

            if ($expiry_date) {
                $new_expiry_date = date('Y-m-d', strtotime($expiry_date . ' +' . $duration . ' days'));

                $update_stmt = $pdo->prepare("UPDATE users SET expiry = :new_expiry_date WHERE user_token = :user_token");
                $update_stmt->execute([
                    'new_expiry_date' => $new_expiry_date,
                    'user_token' => $user_token
                ]);

                

                $message = "
                    
                        <p>

                            Renewal Successful : <br>
                            Order Id : " . $order_id . " <br>
                            Token Id : " . $user_token . " <br>
                            New Expiry Date : " . $new_expiry_date . " <br>
                            Paid Amount : " . $amount . " <br>
                
                        
                        </p>
                        
                        
                    ";





                try {






                    $mail->isSMTP();
                    $mail->Host = 'smtp.hostinger.com';
                    $mail->Port = 587;
                    $mail->SMTPDebug = 0;
                    $mail->SMTPAuth = true;
                    $mail->Username = 'info@munmunmaharana.in';
                    $mail->Password = 'dfgdsgb#2UGF41';

                    $mail->setFrom('info@munmunmaharana.in', 'Renewal Payment Getaway');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = "Payment Getaway Renewal Successful";
                    $mail->Body    = $message;

                    $mail->send();


                    echo "
                        <script>
                            window.location.href='../index.php';
                        </script>
                    ";
                    exit;

                } catch (Exception $e) {
                    

                    echo "
                        <script>
                            window.location.href='../error.php';
                        </script>
                    ";
                    exit;

                }
            } else {
                echo "User not found or expiry date not set.";
            }
        } catch (PDOException $e) {
            die("Database Error: " . $e->getMessage());
        }
    } else {

        $errorMessage = isset($responseData["message"]) ? $responseData["message"] : "Unknown error";
        echo "API Error: $errorMessage";

        error_log("API Error: $errorMessage");
    }
}
?>

















<?php











if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Sanitize and validate GET parameters




    // API endpoint URL

}
