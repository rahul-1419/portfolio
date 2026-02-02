<?php
$host = "localhost";   // or 127.0.0.1
$user = "root";        // default username in XAMPP/WAMP
$pass = "";            // leave blank if using XAMPP local server
$dbname = "portfolio_db";

// Create connection
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
