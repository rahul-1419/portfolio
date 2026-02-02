<?php include('db_connect.php'); ?>

<section class="blog" style="padding: 80px 0; background: #100028;" id="blog-dir">
    <div class="container">
        <!-- Section Header -->
        <div class="row">
            <div class="col-12">
                <div style="color: #00d4ff; font-size: 12px; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 15px; font-weight: 600;">
                    INSIGHTS & ARTICLES
                </div>
                <div class="section-title">
                    <h2 style="color: #ffffff; font-size: 42px; font-weight: 700; margin-bottom: 20px;">Latest Blogs</h2>
                </div>
            </div>
        </div>

        <!-- Blog Slider -->
        <div class="owl-carousel blog-slider">
            <?php
            $query = "SELECT * FROM blogs ORDER BY created_at DESC LIMIT 6";
            $result = mysqli_query($conn, $query);

            while ($blog = mysqli_fetch_assoc($result)):
            ?>
                <div class="modern-blog-card" style="background: rgba(255, 255, 255, 0.03); border: 2px solid rgba(0, 212, 255, 0.3); border-radius: 20px; overflow: hidden; transition: all 0.3s ease; margin: 10px;">
                    <!-- Blog Image Container -->
                    <div class="blog-image-wrapper" style="position: relative; overflow: hidden; height: 250px;">
                        <img src="uploads/blogs/<?= $blog['image'] ?>"
                            alt="<?= htmlspecialchars($blog['title']) ?>"
                            style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                    </div>

                    <!-- Blog Content -->
                    <div class="blog-content" style="padding: 25px;">
                        <h5 class="blog-title" style="color: #ffffff; font-size: 20px; font-weight: 600; margin-bottom: 12px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            <?= htmlspecialchars($blog['title']) ?>
                        </h5>
                        <p class="blog-desc" style="color: #b8b8d1; font-size: 14px; line-height: 1.6; margin-bottom: 15px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            <?= htmlspecialchars($blog['description']) ?>
                        </p>

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
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- View All Button -->
        <div class="text-center mt-5">
            <a href="blog-page.php"
                class="primary-btn">View All Blogs
            </a>
        </div>
    </div>
</section>

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

    .primary-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0, 212, 255, 0.6) !important;
    }

    /* Owl Carousel Overrides */
    .blog-slider {
        overflow: hidden;
    }

    .owl-carousel {
        overflow: hidden !important;
    }

    .owl-stage-outer {
        overflow: hidden !important;
    }

    .owl-nav button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        background: rgba(0, 212, 255, 0.2) !important;
        border: 2px solid #00d4ff !important;
        border-radius: 50%;
        color: #00d4ff !important;
        font-size: 24px;
        transition: all 0.3s ease;
    }

    .owl-nav button:hover {
        background: #00d4ff !important;
        color: #100028 !important;
    }

    .owl-nav button.owl-prev {
        left: -60px;
    }

    .owl-nav button.owl-next {
        right: -60px;
    }

    .owl-dots {
        text-align: center;
        margin-top: 30px;
    }

    .owl-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(0, 212, 255, 0.3) !important;
        margin: 0 5px;
        transition: all 0.3s ease;
    }

    .owl-dot.active {
        background: #00d4ff !important;
        width: 30px;
        border-radius: 6px;
    }

    @media (max-width: 768px) {
        .owl-nav button.owl-prev {
            left: 10px;
        }

        .owl-nav button.owl-next {
            right: 10px;
        }
    }
</style>