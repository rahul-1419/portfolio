<?php
include '../db_connect.php';

// Define credentials
$username = 'flrc';
$password = 'Guggli190502';

// Hash the password before storing
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO admins (username, password) VALUES ('$username', '$hashed_password')";

if (mysqli_query($conn, $query)) {
    echo "✅ Admin user created successfully!";
} else {
    echo "❌ Error: " . mysqli_error($conn);
}
