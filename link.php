<?php
// Connect to your database (replace these details with your own)


// Send the JSON response
header('Content-Type: application/json');
require "auth/config.php";
// Function to generate a random short code
function generateShortCode($length = 6)
{
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $length);
}

// Function to shorten a URL
function shortenURL($originalURL)
{
    global $conn;

    $shortCode = generateShortCode();
    $sql = "INSERT INTO url_shortener (original_url, short_code) VALUES ('$originalURL', '$shortCode')";

    if ($conn->query($sql) === TRUE) {
        return $shortCode;
    } else {
        return false;
    }
}

// Function to retrieve the original URL from the short code
function getOriginalURL($shortCode)
{
    global $conn;

    $sql = "SELECT original_url FROM url_shortener WHERE short_code = '$shortCode'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['original_url'];
    } else {
        return false;
    }
}

// Main logic to handle URL shortening or redirection
if (isset($_GET['pay'])) {
    $shortCode = $_GET['pay'];
    $originalURL = getOriginalURL($shortCode);

    if ($originalURL) {
        header("Location: $originalURL");
        exit();
    } else {
        echo 'URL not found.';
    }
} elseif (isset($_GET['url'])) {
    $originalURL = $_GET['url'];
    $shortCode = shortenURL($originalURL);

    if ($shortCode) {
       
        $link =  "https://".$_SERVER['SERVER_NAME'] . "/link.php?pay=$shortCode";
$response = ['status' => 200, 'url' => $link];
        echo json_encode($response, JSON_UNESCAPED_SLASHES);
        exit();
    } else {
        $response = ['status' => 500, 'error' => 'Error shortening URL'];
        echo json_encode($response, JSON_UNESCAPED_SLASHES);
    }
}
?>
