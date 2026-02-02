<?php include('utilities/header.php'); ?>
<?php
include 'db_connect.php';

$query = "SELECT * FROM projects ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<section class="work" style='padding-bottom: 50px;' id='project-dir'>
    <div class="container" style='margin-top:120px'>
        <div class="row">
            <div class="section-title">
                <h2 style="margin-left: 16px;">Projects</h2>
            </div>
        </div>

        <div class="row g-4" id="project-grid">
            <?php while ($project = mysqli_fetch_assoc($result)): ?>
                <div class="col-sm-6 col-md-4">
                    <div class="project-card shadow bg-white">
                        <img src="uploads/<?= $project['img'] ?>" alt="<?= htmlspecialchars($project['alt']) ?>">
                        <div class="project-overlay">
                            <a href="<?= htmlspecialchars($project['github']) ?>" target="_blank"><i class="fab fa-github"></i></a>
                            <a href="<?= htmlspecialchars($project['page']) ?>"><i class="fas fa-eye"></i></a>
                        </div>
                    </div>
                    <h5 class="project-title" style='color:aliceblue'><?= htmlspecialchars($project['title']) ?></h5>
                    <p class="project-desc" style='margin-top:5px'><?= htmlspecialchars($project['description']) ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php include('utilities/footer.php'); ?>