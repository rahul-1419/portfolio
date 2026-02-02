<?php
session_start();

// ✅ Step 1: Ensure admin authentication
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include '../db_connect.php';

// ✅ Step 2: Validate blog ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: blog_dashboard.php");
    exit;
}

$id = intval($_GET['id']);

// ✅ Step 3: Fetch blog info to delete image
$query = "SELECT image FROM blogs WHERE id = $id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $blog = mysqli_fetch_assoc($result);

    // Delete image file if exists
    if (!empty($blog['image'])) {
        $image_path = "../uploads/blogs/" . $blog['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    // ✅ Step 4: Delete blog record
    $delete_query = "DELETE FROM blogs WHERE id = $id";
    if (mysqli_query($conn, $delete_query)) {
        $_SESSION['message'] = "✅ Blog deleted successfully!";
    } else {
        $_SESSION['message'] = "❌ Error deleting blog: " . mysqli_error($conn);
    }
} else {
    $_SESSION['message'] = "⚠️ Blog not found.";
}

// ✅ Step 5: Redirect back to dashboard
header("Location: blog_dashboard.php");
exit;
