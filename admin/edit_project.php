<?php
session_start(); // ✅ Start session first (important)

// ✅ Step 2: Admin authentication check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
include '../db_connect.php';
$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM projects WHERE id=$id");
$project = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $github = $_POST['github'];
    $page = $_POST['page'];
    $description = $_POST['description'];
    $alt = $_POST['alt'];

    // Check if new image uploaded
    if($_FILES['img']['name'] != "") {
        $img_name = $_FILES['img']['name'];
        $img_tmp = $_FILES['img']['tmp_name'];
        move_uploaded_file($img_tmp, "uploads/".$img_name);
        $img_sql = ", img='$img_name'";
    } else {
        $img_sql = "";
    }

    $query = "UPDATE projects SET title='$title', alt='$alt', github='$github', page='$page', description='$description' $img_sql WHERE id=$id";
    if(mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: ".mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Project</title>

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

    .image-preview {
        text-align: center;
        margin-bottom: 15px;
    }

    .image-preview img {
        border-radius: 10px;
        width: 120px;
        height: auto;
        box-shadow: 0 3px 10px rgba(0,0,0,0.15);
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
    <h1>Edit Project</h1>
    <form method="post" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($project['title']) ?>" required>

        <label>Alt Text:</label>
        <input type="text" name="alt" value="<?= htmlspecialchars($project['alt']) ?>" required>

        <label>GitHub URL:</label>
        <input type="text" name="github" value="<?= $project['github'] ?>">

        <label>Project Page:</label>
        <input type="text" name="page" value="<?= $project['page'] ?>">

        <label>Description:</label>
        <textarea name="description" rows="4"><?= htmlspecialchars($project['description']) ?></textarea>

        <div class="image-preview">
            <label>Current Image:</label><br>
            <img src="uploads/<?= $project['img'] ?>" alt="Project Image"><br><br>
            <label>Change Image:</label>
            <input type="file" name="img">
        </div>

        <input type="submit" name="submit" value="Update Project">
    </form>
    <a class="back-link" href="index.php">← Back to Projects</a>
</div>
</body>
</html>
