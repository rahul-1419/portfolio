<?php
include('utilities/header.php');
include('db_connect.php');
?>

<section class="all-blogs py-5" id="all-blogs">
    <div class="container" style="margin-top:120px">
        <div class="row mb-4">
            <div class="section-title">
                <h2>Blogs</h2>
            </div>
        </div>

        <div class="row g-4">
            <?php
            // Fetch all blogs
            $query = "SELECT * FROM blogs ORDER BY created_at DESC";
            $result = mysqli_query($conn, $query);

            while ($blog = mysqli_fetch_assoc($result)):
                $img_path = "uploads/blogs/" . $blog['image']; // Update image path
            ?>
                <div class="col-md-4">
                    <div class="blog-card shadow position-relative">
                        <?php if (!empty($blog['image']) && file_exists($img_path)): ?>
                            <img src="<?= $img_path ?>" alt="<?= htmlspecialchars($blog['title']) ?>" class="img-fluid rounded">
                        <?php else: ?>
                            <div class="no-image text-center py-5" style="background: #333; color: #aaa;">No Image</div>
                        <?php endif; ?>

                        <div class="blog-content p-3">
                            <h5 class="blog-title"><?= htmlspecialchars($blog['title']) ?></h5>
                            <p class="blog-desc"><?= htmlspecialchars($blog['description']) ?></p>

                            <?php if (!empty($blog['blog_link'])): ?>
                                <a href="<?= htmlspecialchars($blog['blog_link']) ?>" class="read-more-link" target="_blank">
                                    Read More &rarr;
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

    </div>
</section>

<?php include('utilities/footer.php'); ?>

<style>
    #all-blogs {
        background-color: #100028;
        padding-bottom: 50px;
        color: white;
    }

    .blog-card {
        border-radius: 10px;
        overflow: hidden;
        position: relative;
        color: white;
        transition: transform 0.3s, box-shadow 0.3s;
        background-color: #1a0d3e;
    }

    .blog-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .no-image {
        width: 100%;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .blog-content {
        padding: 15px;
        transition: background 0.3s;
    }

    .blog-card:hover .blog-content {
        background: rgba(0, 0, 0, 0.7);
    }

    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }

    .blog-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: aliceblue;
    }

    .blog-desc {
        font-size: 0.95rem;
        color: #ddd;
    }

    /* Read More link */
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

    @media (max-width: 767px) {

        .blog-card img,
        .no-image {
            height: 180px;
        }
    }
</style>