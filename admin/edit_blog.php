<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include '../db_connect.php';

$message = "";
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: blog_dashboard.php");
    exit;
}

// ✅ Fetch existing blog data
$query = "SELECT * FROM blogs WHERE id = $id";
$result = mysqli_query($conn, $query);
$blog = mysqli_fetch_assoc($result);

if (!$blog) {
    $message = '<div class="alert alert-danger text-center">Blog not found.</div>';
}

// ✅ Handle form submission
if (isset($_POST['update'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $blog_link = mysqli_real_escape_string($conn, $_POST['blog_link']);
    $image = $blog['image']; // Default to old image

    // ✅ Handle new image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../uploads/blogs/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $original_name = basename($_FILES['image']['name']);
        $target_file = $target_dir . $original_name;

        // ✅ If image already exists, just use it (no re-upload)
        if (file_exists($target_file)) {
            $image = $original_name;
        } else {
            // If it doesn't exist, move new image
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // Delete old image (only if it's different)
                if (!empty($blog['image']) && $blog['image'] !== $original_name && file_exists($target_dir . $blog['image'])) {
                    unlink($target_dir . $blog['image']);
                }
                $image = $original_name;
            }
        }
    }

    // ✅ Update query
    $update_query = "UPDATE blogs 
                     SET title='$title', description='$description', image='$image', blog_link='$blog_link'
                     WHERE id=$id";

    if (mysqli_query($conn, $update_query)) {
        $message = '<div class="alert alert-success text-center">✅ Blog updated successfully!</div>';
        // Refresh data
        $result = mysqli_query($conn, "SELECT * FROM blogs WHERE id = $id");
        $blog = mysqli_fetch_assoc($result);
    } else {
        $message = '<div class="alert alert-danger text-center">❌ Error updating blog: ' . mysqli_error($conn) . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Blog</title>
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

        .current-img {
            display: block;
            margin: 10px auto;
            max-width: 200px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Edit Blog</h2>
            <?= $message; ?>

            <?php if ($blog): ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Blog Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="<?= htmlspecialchars($blog['title']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="4" class="form-control" required><?= htmlspecialchars($blog['description']) ?></textarea>
                    </div>

                    <div class="mb-3 text-center">
                        <label class="form-label">Current Image</label><br>
                        <?php if (!empty($blog['image']) && file_exists("../uploads/blogs/" . $blog['image'])): ?>
                            <img src="../uploads/blogs/<?= $blog['image'] ?>" alt="Current Image" class="current-img">
                        <?php else: ?>
                            <p class="text-muted">No image uploaded</p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Change Image (optional)</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label for="blog_link" class="form-label">Blog Link (optional)</label>
                        <input type="url" name="blog_link" id="blog_link"
                            class="form-control"
                            value="<?= htmlspecialchars($blog['blog_link'] ?? '') ?>"
                            placeholder="https://example.com/blog-post">
                    </div>

                    <button type="submit" name="update" class="btn btn-primary btn-custom">Update Blog</button>
                    <a href="blog_dashboard.php" class="btn btn-secondary btn-custom mt-2">Back to Blog Dashboard</a>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>