<?php include('utilities/header.php'); ?>
<?php
include 'db_connect.php';

$query = "SELECT * FROM projects ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<section class="work" style='padding: 150px 0 0 0;background: #100028;' id='project-dir'>
    <div class="container">
        <!-- Section Header -->
        <div class="row">
            <div class="col-12">
                <div style="color: #00d4ff; font-size: 12px; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 15px; font-weight: 600;">
                    MY WORK
                </div>
                <div class="section-title">
                    <h2 style="color: #ffffff; font-size: 42px; font-weight: 700; margin-bottom: 20px;">Projects</h2>
                </div>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="row g-4" id="project-grid">
            <?php while ($project = mysqli_fetch_assoc($result)): ?>
                <div class="col-lg-4 col-md-6 col-sm-12" style='margin:0px 0px 30px 0px'>
                    <div class="modern-project-card" style="border: 2px solid rgba(0, 212, 255, 0.3); border-radius: 20px; overflow: hidden; transition: all 0.3s ease; height: 100%;">
                        <!-- Project Image Container -->
                        <div class="project-image-wrapper" style="position: relative; overflow: hidden; height: 250px;">
                            <img src="uploads/<?= $project['img'] ?>"
                                alt="<?= htmlspecialchars($project['alt']) ?>"
                                style="width: 100%; height: 100%; object-fit: fill; transition: transform 0.5s ease;">

                            <!-- Overlay with Icons -->
                            <div class="project-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.85); display: flex; align-items: center; justify-content: center; gap: 20px; opacity: 0; transition: opacity 0.3s ease;">
                                <a href="<?= htmlspecialchars($project['github']) ?>"
                                    target="_blank"
                                    style="width: 50px; height: 50px; border: 2px solid #00d4ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00d4ff; font-size: 20px; transition: all 0.3s ease; text-decoration: none;">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="<?= htmlspecialchars($project['page']) ?>"
                                    style="width: 50px; height: 50px; border: 2px solid #00d4ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00d4ff; font-size: 20px; transition: all 0.3s ease; text-decoration: none;">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Project Info -->
                        <div style="padding: 25px;">
                            <h5 class="project-title" style="color: #ffffff; font-size: 20px; font-weight: 600; margin-bottom: 12px; line-height: 1.4;">
                                <?= htmlspecialchars($project['title']) ?>
                            </h5>
                            <p class="project-desc" style="color: #b8b8d1; font-size: 14px; line-height: 1.6; margin-bottom: 15px;">
                                <?= htmlspecialchars($project['description']) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- Modern Project Card Styles -->
<style>
    .modern-project-card:hover {
        border-color: #00d4ff !important;
        transform: translateY(-10px);
        box-shadow: 0 15px 50px rgba(0, 212, 255, 0.3);
    }

    .modern-project-card:hover .project-image-wrapper img {
        transform: scale(1.1);
    }

    .modern-project-card:hover .project-overlay {
        opacity: 1 !important;
    }

    .project-overlay a:hover {
        background: #00d4ff !important;
        color: #100028 !important;
        transform: scale(1.1);
    }

    .primary-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0, 212, 255, 0.6) !important;
    }

    @media (max-width: 768px) {
        .modern-project-card {
            margin-bottom: 20px;
        }
    }
</style>

<?php include('utilities/footer.php'); ?>