<?php include('db_connect.php'); ?>

<section class="blog" style="padding-bottom: 50px;" id="blog-dir">
    <div class="container">
        <div class="row mb-4">
            <div class="section-title">
                <h2 style="margin-left: 16px;">Latest Blogs</h2>
            </div>
        </div>

        <!-- Blog Slider -->
        <div class="owl-carousel blog-slider">
            <?php
            $query = "SELECT * FROM blogs ORDER BY created_at DESC LIMIT 6";
            $result = mysqli_query($conn, $query);

            while ($blog = mysqli_fetch_assoc($result)):
            ?>
                <div class="blog-card position-relative">
                    <img src="uploads/blogs/<?= $blog['image'] ?>" alt="<?= htmlspecialchars($blog['title']) ?>" class="img-fluid">
                    <div class="blog-content p-3">
                        <h5 class="blog-title" style="color:aliceblue;"><?= htmlspecialchars($blog['title']) ?></h5>
                        <p class="blog-desc"><?= htmlspecialchars($blog['description']) ?></p>
                        <?php if (!empty($blog['blog_link'])): ?>
                            <a href="<?= htmlspecialchars($blog['blog_link']) ?>" class="read-more-link" target="_blank">
                                Read More &rarr;
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="text-center mt-5">
            <a href="blog-page.php" class="primary-btn px-4 py-2">View All</a>
        </div>
    </div>
</section>

<style>
    .blog-card {
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }

    .blog-card img {
        width: 100%;
        height: auto;
    }

    .blog-content {
        color: white;
        transition: 0.3s;
    }

    .blog-card:hover .blog-content {
        background: rgba(0, 0, 0, 0.8);
    }

    /* Read More link style */
    .read-more-link {
        display: inline-block;
        margin-top: 10px;
        color: #00bfff;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }

    .read-more-link:hover {
        color: aliceblue;
        text-decoration: underline;
    }
</style>