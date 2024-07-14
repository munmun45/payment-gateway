<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.7/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.7/dist/sweetalert2.min.js"></script>

<?php
error_reporting(0);
require_once('header.php');
require_once('lib/config.php');
require_once('lib/checksum.php');





   

// Initialize variables to store payment details and validation results.
$verifySignature = '';
$array = array();
$paramList = array();


// Retrieve payment details from the POST request.
$status = filter_var($_POST['status'], FILTER_SANITIZE_STRING); // Sanitize and validate Payment Status
$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING); // Sanitize and validate Txn Message
$cust_Mobile = filter_var($_POST['cust_Mobile'], FILTER_SANITIZE_STRING); // Sanitize and validate Customer Mobile
$cust_Email = filter_var($_POST['cust_Email'], FILTER_SANITIZE_EMAIL); // Sanitize and validate Customer Email
$hash = filter_var($_POST['hash'], FILTER_SANITIZE_STRING); // Sanitize and validate Encrypted Hash
$checksum = filter_var($_POST['checksum'], FILTER_SANITIZE_STRING); // Sanitize and validate Checksum verifySignature

// Check the payment status.
if ($status == "SUCCESS") {
    // Decrypt the hash using the secret key.
    $paramList = hash_decrypt($hash, $secret);

    // Verify the signature to ensure data integrity.
    $verifySignature = RechPayChecksum::verifySignature($paramList, $secret, $checksum);

    // If the signature is valid, proceed with processing the payment details.
    if ($verifySignature) {
        // Decode the JSON-formatted payment details.
        $array = json_decode($paramList);

        // Extract and store each payment detail in a separate variable.
        $paymentStatus = $status;
        $paymentMessage = $message;
        $paymentHash = $hash;
        $paymentChecksum = $checksum;
        $customerMobile = $cust_Mobile;
        $customerEmail = $cust_Email;
        $senderNote = $array->sender_note;
        $amount = $array->txnAmount;
        $orderId = $array->orderId;
        $txnStatus = $array->txnStatus;
        $resultInfo = $array->resultInfo;
        $txnId = $array->txnId;
        $bankTxnId = $array->bankTxnId;
        $paymentMode = $array->paymentMode;
        $txnDate = $array->txnDate;
        $utr = $array->utr;
        $senderVpa = $array->sender_vpa;
        $payeeVpa = $array->payee_vpa;
        
$email=$customerEmail;


// Check if a transaction ID has been stored in the session
if (isset($_SESSION['transaction_id'])) {
    // Get the stored transaction ID
    $storedTransactionId = $_SESSION['transaction_id'];

    // Check if the current transaction matches the stored one
    if ($storedTransactionId === $orderId) {
        // Show a message indicating that the payment has already been completed for this transaction
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
        echo '<script>
            Swal.fire({
                icon: "info",
                title: "Payment for this transaction has already been completed.",
                showConfirmButton: true,
                confirmButtonText: "Ok!",
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "https://' . $_SERVER["SERVER_NAME"] . '/auth/dashboard";
                }
            });
        </script>';
        exit;
    }
}
       
       
       
       
       
       if ($amount == 100) {
    $monthsToAdd = 1;

} elseif ($amount == 299) {
    $monthsToAdd = 3;
    
} elseif ($amount == 449) {
    $monthsToAdd = 6;
} elseif ($amount == 699) {
    $monthsToAdd = 12;
    
} else {
    $monthsToAdd = 0;
}



     
       $sql = "UPDATE users SET expiry = DATE_ADD(expiry, INTERVAL $monthsToAdd MONTH) WHERE email = '$email'";
        $rrrr = mysqli_query($conn, $sql);

        if ($rrrr) {
            // Set a session variable to indicate successful payment for this transaction
            $_SESSION['transaction_id'] = $orderId;

            // Show SweetAlert2 success message
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Plan Purchase successfully !!",
                    showConfirmButton: true,
                    confirmButtonText: "Ok!",
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "https://' . $_SERVER["SERVER_NAME"] . '/auth/dashboard"; // Redirect to the dashboard
                    }
                });
            </script>';
            exit;
        }
        
        else{
            //echo "SQL Error: " . mysqli_error($conn);
            
             // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "Please Try again later!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "subscription"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';
exit;

            
            
        }
       

        // Update wallet or execute any other required actions.
        //here you can use database operations
        
    } else {
        
        // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "Payment failed due to an invalid checksum!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "subscription"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';
exit;

        

    }
} else {
    
     // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "Payment failed or was cancelled!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "subscription"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';
exit;


}
?>
