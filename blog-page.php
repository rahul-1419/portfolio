<?php
include('utilities/header.php');
include('db_connect.php');
?>

<section class="all-blogs" style="padding: 150px 0 0px 0px; background: #100028;" id="all-blogs">
    <div class="container">
        <!-- Section Header -->
        <div class="row">
            <div class="col-12">
                <div style="color: #00d4ff; font-size: 12px; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 15px; font-weight: 600;">
                    INSIGHTS & ARTICLES
                </div>
                <div class="section-title">
                    <h2 style="color: #ffffff; font-size: 42px; font-weight: 700; margin-bottom: 20px;">All Blogs</h2>
                </div>
            </div>
        </div>

        <!-- Blogs Grid -->
        <div class="row g-4">
            <?php
            // Fetch all blogs
            $query = "SELECT * FROM blogs ORDER BY created_at DESC";
            $result = mysqli_query($conn, $query);

            while ($blog = mysqli_fetch_assoc($result)):
                $img_path = "uploads/blogs/" . $blog['image'];
            ?>
                <div class="col-lg-4 col-md-6 col-sm-12" style='margin-bottom:30px;'>
                    <div class="modern-blog-card" style="background: rgba(255, 255, 255, 0.03); border: 2px solid rgba(0, 212, 255, 0.3); border-radius: 20px; overflow: hidden; transition: all 0.3s ease; height: 100%; display: flex; flex-direction: column;">
                        <!-- Blog Image Container -->
                        <div class="blog-image-wrapper" style="position: relative; overflow: hidden; height: 250px; flex-shrink: 0;">
                            <?php if (!empty($blog['image']) && file_exists($img_path)): ?>
                                <img src="<?= $img_path ?>"
                                    alt="<?= htmlspecialchars($blog['title']) ?>"
                                    style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                            <?php else: ?>
                                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, rgba(0, 212, 255, 0.2), rgba(0, 102, 255, 0.2)); display: flex; align-items: center; justify-content: center; flex-direction: column; color: #00d4ff;">
                                    <i class="fa fa-image" style="font-size: 48px; margin-bottom: 15px; opacity: 0.5;"></i>
                                    <span style="font-size: 14px; font-weight: 500;">No Image Available</span>
                                </div>
                            <?php endif; ?>

                        </div>

                        <!-- Blog Content -->
                        <div class="blog-content" style="padding: 25px; flex-grow: 1; display: flex; flex-direction: column;">
                            <h5 class="blog-title" style="color: #ffffff; font-size: 20px; font-weight: 600; margin-bottom: 12px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 56px;">
                                <?= htmlspecialchars($blog['title']) ?>
                            </h5>
                            <p class="blog-desc" style="color: #b8b8d1; font-size: 14px; line-height: 1.6; margin-bottom: 20px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; flex-grow: 1;">
                                <?= htmlspecialchars($blog['description']) ?>
                            </p>

                            <!-- Divider -->
                            <div style="height: 1px; background: rgba(0, 212, 255, 0.2); margin-bottom: 15px;"></div>

                            <!-- Bottom Section -->
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <?php if (!empty($blog['blog_link'])): ?>
                                    <a href="<?= htmlspecialchars($blog['blog_link']) ?>"
                                        class="read-more-link"
                                        target="_blank"
                                        style="display: inline-flex; align-items: center; gap: 8px; color: #00d4ff; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.3s ease;">
                                        Read Full Article
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="transition: transform 0.3s ease;">
                                            <path d="M1 8H15M15 8L8 1M15 8L8 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                <?php endif; ?>

                                <!-- Share Icon -->
                                <div style="width: 35px; height: 35px; background: rgba(0, 212, 255, 0.1); border: 1px solid rgba(0, 212, 255, 0.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00d4ff; cursor: pointer; transition: all 0.3s ease;">
                                    <i class="fa fa-share-alt" style="font-size: 14px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Empty State (if no blogs) -->
        <?php
        mysqli_data_seek($result, 0);
        if (mysqli_num_rows($result) == 0):
        ?>
            <div class="row">
                <div class="col-12">
                    <div style="text-align: center; padding: 80px 20px;">
                        <i class="fa fa-newspaper-o" style="font-size: 64px; color: rgba(0, 212, 255, 0.3); margin-bottom: 20px;"></i>
                        <h3 style="color: #ffffff; margin-bottom: 10px;">No Blogs Yet</h3>
                        <p style="color: #b8b8d1; font-size: 16px;">Check back soon for new articles and insights!</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include('utilities/footer.php'); ?>

<style>
    /* Modern Blog Card Styles */
    .modern-blog-card:hover {
        border-color: #00d4ff !important;
        transform: translateY(-10px);
        box-shadow: 0 15px 50px rgba(0, 212, 255, 0.3);
    }

    .modern-blog-card:hover .blog-image-wrapper img {
        transform: scale(1.1);
    }

    .read-more-link:hover {
        gap: 12px !important;
    }

    .read-more-link:hover svg {
        transform: translateX(4px);
    }

    /* Share Button Hover */
    .modern-blog-card .blog-content>div>div:hover {
        background: rgba(0, 212, 255, 0.2) !important;
        border-color: #00d4ff !important;
        transform: scale(1.1);
    }

    /* Smooth Transitions */
    * {
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .modern-blog-card {
            margin-bottom: 20px;
        }

        .blog-image-wrapper {
            height: 220px !important;
        }

        .section-title h2 {
            font-size: 32px !important;
        }

        .section-title p {
            font-size: 14px !important;
        }
    }

    @media (max-width: 576px) {
        .blog-image-wrapper {
            height: 200px !important;
        }
    }

    /* Loading Animation (Optional) */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modern-blog-card {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Stagger animation for multiple cards */
    .modern-blog-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .modern-blog-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .modern-blog-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .modern-blog-card:nth-child(4) {
        animation-delay: 0.1s;
    }

    .modern-blog-card:nth-child(5) {
        animation-delay: 0.2s;
    }

    .modern-blog-card:nth-child(6) {
        animation-delay: 0.3s;
    }
</style>