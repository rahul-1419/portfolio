<?php
require_once __DIR__ . "/../db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    if (empty($name) || empty($email) || empty($message)) {
        die("All fields required");
    }

    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $message = mysqli_real_escape_string($conn, $message);

    $sql = "INSERT INTO contacts (name,email,message)
            VALUES ('$name','$email','$message')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../index.php?success=1"); // ✅ redirect
        exit();
    } else {
        echo "Error saving message";
    }
}
