<?php
session_start();

// ✅ Step 1: Admin authentication check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include '../db_connect.php';

// ✅ Step 2: Fetch blogs
$query = "SELECT * FROM blogs ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .img-thumbnail {
            transition: transform 0.2s;
            cursor: pointer;
        }
        .img-thumbnail:hover {
            transform: scale(1.2);
        }
        .table thead th {
            white-space: nowrap;
        }
        .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Blog Dashboard</h1>

        <div class="mb-3 text-end">
            <a href="add_blog.php" class="btn btn-success me-2">Add New Blog</a>
            <a href="index.php" class="btn btn-secondary me-2">Back to Projects</a>
            <a href="logout.php" class="btn btn-outline-danger">Logout</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Blog Link</th> <!-- ✅ Added new column -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($blog = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $blog['id'] ?></td>
                            <td><?= htmlspecialchars($blog['title']) ?></td>
                            <td>
                                <?php
                                $img_path = "../uploads/blogs/" . $blog['image'];
                                if (!empty($blog['image']) && file_exists($img_path)) : ?>
                                    <a href="<?= $img_path ?>" target="_blank">
                                        <img src="<?= $img_path ?>" alt="<?= htmlspecialchars($blog['title']) ?>" class="img-thumbnail" style="width:120px;">
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($blog['author'] ?? 'Admin') ?></td>
                            <td><?= htmlspecialchars($blog['date'] ?? '-') ?></td>
                            <td style="max-width: 300px;"><?= htmlspecialchars($blog['description']) ?></td>

                            <!-- ✅ Blog link column -->
                            <td>
                                <?php if (!empty($blog['blog_link'])): ?>
                                    <a href="<?= htmlspecialchars($blog['blog_link']) ?>" target="_blank" class="btn btn-sm btn-info text-white">
                                        Visit Link
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">No Link</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a href="edit_blog.php?id=<?= $blog['id'] ?>" class="btn btn-sm btn-warning mb-1">Edit</a>
                                <a href="delete_blog.php?id=<?= $blog['id'] ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
