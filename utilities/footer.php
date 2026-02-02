<!-- Footer Section Begin -->
<footer class="footer" id='con'>
    <div class="container">
        <div class="footer__top">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="footer__top__logo">
                        <a href="./index.php"><span class="DS">Portfolio</span></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="footer__top__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row" style='margin-top: 30px;'>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__option__item">
                        <h5>About Me</h5>
                        <p>
                            Hi! I'm <strong>Rahul Chaudhari</strong>, a passionate data science learner who loves turning raw data into meaningful insights.
                            I specialize in Python, Machine Learning, and Data Visualization.
                            My goal is to build intelligent systems that help make smarter decisions.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6" style='justify-items: center;'>
                    <div class="footer__option__item">
                        <h5>Our work</h5>
                        <ul>
                            <li><a href="project-page.php">Projects</a></li>
                            <li><a href="blog-page.php">Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__option__item">
                        <h5>Contact Me</h5>
                        <form action="mailto:rahul@example.com" method="post" enctype="text/plain" class="footer-contact-form">
                            <input type="text" name="name" placeholder="Your Name" required>
                            <input type="email" name="email" placeholder="Your Email" required>
                            <textarea name="message" rows="4" placeholder="Your Message" required></textarea>
                            <button type="submit">
                                <i class="fa fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="footer__copyright">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <p class="footer__copyright__text">Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        All rights reserved by Rahul Chaudhari
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="asset/js/jquery-3.3.1.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<script src="asset/js/jquery.magnific-popup.min.js"></script>
<script src="asset/js/mixitup.min.js"></script>
<script src="asset/js/masonry.pkgd.min.js"></script>
<script src="asset/js/jquery.slicknav.js"></script>
<script src="asset/js/owl.carousel.min.js"></script>
<script src="asset/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<!-- jQuery + Owl Carousel -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
    $(document).ready(function() {
        $(".blog-slider").owlCarousel({
            loop: true,
            margin: 20,
            nav: true, // prev/next buttons
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000, // 3 seconds auto-slide
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                }
            },
            navText: [
                '<i class="fas fa-chevron-left"></i>',
                '<i class="fas fa-chevron-right"></i>'
            ]
        });
    });
</script>
</body>

</html>