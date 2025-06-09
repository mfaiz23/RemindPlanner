<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Remind Planner</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link rel="icon" href="<?= base_url('/favicon.png') ?>" type="image/png">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/landing.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">Remind Planner</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <?php if (session()->get('logged_in')): ?>
  <a class="btn-getstarted" href="<?= base_url('/user/dashboard')?>">Dashboard</a>
<?php else: ?>
  <a class="btn-getstarted" href="/login">Login</a>
<?php endif; ?>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-lg-last hero-img" data-aos="zoom-in" data-aos-delay="100">
            <img src="assets/images/landing/Hero3.jpg" class="img-fluid animated w-60" alt="">
          </div>
          <div class="col-lg-6  d-flex flex-column justify-content-center text-center text-md-start" data-aos="fade-in">
            <h2>Aplikasi Remind Planner</h2>
            <p>Solusi untuk mengelola tugas anda dengan mudah, dimana pun dan kapan pun...</p>
            <div class="d-flex mt-4 justify-content-center justify-content-md-start">
              <?php if (session()->get('logged_in')): ?>
                <a href="<?= base_url('/user/dashboard')?>" class="download-btn"> <span>Mulai Rencana</span></a>
              <?php else: ?>
                <a href="/login" class="download-btn"> <span>Mulai Rencana</span></a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About Us</h2>
      
      </div><!-- End Section Title -->

      <div class="container">
        <!--Profil kelompok -->
        <div class="row gy-4">
          <div class="col-md-3 text-center">
            
            <h5>Fajar Fathurrozak</h5>
            <p>2250081123</p>
          </div>
          <div class="col-md-3 text-center">
          
            <h5>M. Faiz Nur Ramadhan</h5>
            <p>2250081137</p>
          </div>
          <div class="col-md-3 text-center">
          
            <h5>Paskal Firdaus I</h5>
            <p>2250081143</p>
          </div>
          <div class="col-md-3 text-center">

            <h5>Tubagus Mochamad Kariza</h5>
            <p>2250081129</p>
          </div>

        </div>

      </div>

    </section>

  </main>

  <footer id="footer" class="footer">


    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <span class="sitename">Remind Planner</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jl Jenderal Soedirman</p>
            <p>Cimahi, Jawa Barat</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+628986552324</span></p>
            <p><strong>Email:</strong> <span>cvremindplanner@gmail.com</span></p>
          </div>
        </div>





      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Remind Planner</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by Kelompok 1</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/landing.js"></script>

</body>

</html>