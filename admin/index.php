<?php
session_start(); // ✅ Start session first (important)

// ✅ Step 2: Admin authentication check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include '../db_connect.php';

$query = "SELECT * FROM projects ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Project Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin/css/admin.css">
    <style>
        /* Hover zoom effect for images */
        .img-thumbnail {
            transition: transform 0.2s;
            cursor: pointer;
        }

        .img-thumbnail:hover {
            transform: scale(1.2);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Project Dashboard</h1>

        <div class="mb-3 text-end">
            <a href="add_project.php" class="btn btn-success me-2">Add New Project</a>
            <a href="blog_dashboard.php" class="btn btn-info me-2">Blog Dashboard</a>
            <a href="logout.php" class="btn btn-outline-danger">Logout</a>
        </div>


        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>GitHub</th>
                        <th>Page</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($project = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $project['id'] ?></td>
                            <td><?= htmlspecialchars($project['title']) ?></td>
                            <td>
                                <?php
                                $img_path = "../uploads/" . $project['img']; // admin is one folder deep
                                if (!empty($project['img']) && file_exists($img_path)) : ?>
                                    <a href="<?= $img_path ?>" target="_blank">
                                        <img src="<?= $img_path ?>" alt="<?= htmlspecialchars($project['title']) ?>" class="img-thumbnail" style="width:120px;">
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">No Image</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if ($project['github']): ?>
                                    <a href="<?= $project['github'] ?>" target="_blank" class="btn btn-sm btn-dark">GitHub</a>
                                <?php else: ?>
                                    <span class="text-muted">N/A</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($project['page']): ?>
                                    <a href="<?= $project['page'] ?>" class="btn btn-sm btn-primary">View</a>
                                <?php else: ?>
                                    <span class="text-muted">N/A</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($project['description']) ?></td>
                            <td>
                                <a href="edit_project.php?id=<?= $project['id'] ?>" class="btn btn-sm btn-warning mb-1">Edit</a>
                                <a href="delete_project.php?id=<?= $project['id'] ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Are you sure you want to delete this project?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>