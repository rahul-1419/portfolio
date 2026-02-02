<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include '../db_connect.php';

$message = "";

// ✅ Handle form submission
if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $blog_link = mysqli_real_escape_string($conn, $_POST['blog_link']);

    $image = "";

    // ✅ Handle image upload with duplicate check
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $original_name = basename($_FILES['image']['name']);
        $target_dir = "../uploads/blogs/";
        $target_file = $target_dir . $original_name;

        // Ensure upload folder exists
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (file_exists($target_file)) {
            // ✅ Image already exists — use it directly
            $image = $original_name;
        } else {
            // ✅ Image does not exist — upload new one with timestamp
            $img_name = time() . '_' . $original_name;
            $target_file = $target_dir . $img_name;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = $img_name;
            } else {
                $message = '<div class="alert alert-danger text-center">❌ Failed to upload image.</div>';
            }
        }
    }

    // ✅ Insert blog into DB
    $query = "INSERT INTO blogs (title, description, image, blog_link, created_at) 
              VALUES ('$title', '$description', '$image', '$blog_link', NOW())";

    if (mysqli_query($conn, $query)) {
        $message = '<div class="alert alert-success text-center">✅ Blog added successfully!</div>';
    } else {
        $message = '<div class="alert alert-danger text-center">❌ Error adding blog: ' . mysqli_error($conn) . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
        }

        .form-container {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-custom {
            width: 100%;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Add New Blog</h2>
            <?= $message; ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Blog Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="4" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                    <small class="text-muted">If the same image name already exists, it will be reused automatically.</small>
                </div>

                <div class="mb-3">
                    <label for="blog_link" class="form-label">Blog Link (optional)</label>
                    <input type="url" name="blog_link" id="blog_link" class="form-control" placeholder="https://example.com/blog-post">
                </div>

                <button type="submit" name="submit" class="btn btn-primary btn-custom">Add Blog</button>
                <a href="blog_dashboard.php" class="btn btn-secondary btn-custom mt-2">Back to Blog Dashboard</a>
            </form>
        </div>
    </div>
</body>

</html>