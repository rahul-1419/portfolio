<?php
session_start(); // ✅ Start session first (important)

// ✅ Step 2: Admin authentication check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include '../db_connect.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $github = $_POST['github'];
    $page = $_POST['page'];
    $description = $_POST['description'];
    $alt = $_POST['alt'];

    // Image upload
    $img_name = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];

    // Make sure uploads folder exists
    $upload_dir = "../uploads/";  // admin folder is one level deep
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    move_uploaded_file($img_tmp, $upload_dir . $img_name);

    // Insert into database
    $query = "INSERT INTO projects (title, img, alt, github, page, description) 
              VALUES ('$title', '$img_name', '$alt', '$github', '$page', '$description')";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add New Project</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        background: #fff;
        padding: 30px 40px;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        width: 420px;
        max-width: 95%;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 25px;
    }

    label {
        font-weight: 600;
        color: #555;
        margin-bottom: 5px;
        display: block;
    }

    input[type="text"], 
    textarea, 
    input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 14px;
        transition: 0.3s;
    }

    input[type="text"]:focus,
    textarea:focus {
        border-color: #007bff;
        box-shadow: 0 0 4px rgba(0,123,255,0.3);
        outline: none;
    }

    textarea {
        resize: none;
    }

    input[type="submit"] {
        width: 100%;
        background: #007bff;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
        font-weight: 600;
    }

    input[type="submit"]:hover {
        background: #0056b3;
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 15px;
        text-decoration: none;
        color: #007bff;
        font-size: 14px;
    }

    .back-link:hover {
        text-decoration: underline;
    }
</style>
</head>

<body>
<div class="container">
    <h1>Add New Project</h1>
    <form method="post" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Alt Text:</label>
        <input type="text" name="alt" required>

        <label>GitHub URL:</label>
        <input type="text" name="github">

        <label>Project Page:</label>
        <input type="text" name="page">

        <label>Description:</label>
        <textarea name="description" rows="4"></textarea>

        <label>Image:</label>
        <input type="file" name="img" required>

        <input type="submit" name="submit" value="Add Project">
    </form>
    <a class="back-link" href="index.php">← Back to Projects</a>
</div>
</body>
</html>
