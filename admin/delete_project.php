<?php
session_start(); // ✅ Start session first (important)

// ✅ Step 2: Admin authentication check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
include '../db_connect.php';
$id = $_GET['id'];

// Get image to delete from folder
$res = mysqli_query($conn, "SELECT img FROM projects WHERE id=$id");
$row = mysqli_fetch_assoc($res);
if(file_exists("uploads/".$row['img'])) {
    unlink("uploads/".$row['img']);
}

// Delete record
mysqli_query($conn, "DELETE FROM projects WHERE id=$id");
header("Location: index.php");
exit;
?>
