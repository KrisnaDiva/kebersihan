<?php
require_once __DIR__ . '/../../middleware.php';
require_once __DIR__ . '/../../koneksi.php';
auth();
user();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>  <?= $title; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../../landing/assets/img/favicon.png" rel="icon">
    <link href="../../landing/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../landing/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../landing/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../landing/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../../landing/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../landing/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="../../landing/assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

<header id="header" class="header sticky-top">
    <div class="branding d-flex align-items-cente">
        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <!-- <img src="../../landing/assets/img/logo.png" alt=""> -->
                <h1 class="sitename">Layanan Kebersihan</h1>
            </a>
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#contact">Info Pemesanan</a></li>
                    <li><a href="../../proses/logout.php">Logout</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </div>
</header>

<main class="main">
    <?= $content; ?>
</main>

<footer id="footer" class="footer">
    <div class="footer-newsletter"></div>
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="index.php" class="d-flex align-items-center">
                    <span class="sitename">BizLand</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>A108 Adam Street</p>
                    <p>New York, NY 535022</p>
                    <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                    <p><strong>Email:</strong> <span>info@example.com</span></p>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Our Services</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-12">
                <h4>Follow Us</h4>
                <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                <div class="social-links d-flex">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">BizLand</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer>

<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i>
</a>

<div id="preloader">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>

<!-- Vendor JS Files -->
<script src="../../landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../landing/assets/vendor/php-email-form/validate.js"></script>
<script src="../../landing/assets/vendor/aos/aos.js"></script>
<script src="../../landing/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../../landing/assets/vendor/waypoints/noframework.waypoints.js"></script>
<script src="../../landing/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../../landing/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../../landing/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="../../landing/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

<!-- Main JS File -->
<script src="../../landing/assets/js/main.js"></script>

</body>
</html>