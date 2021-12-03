<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><img src="./assets/img/favicon.png" alt=""> <a href="index.php">RESA<span>.</span></a> </h1>
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#">Home</a></li>
          <li><a class="nav-link scrollto" href="user_engagements.php">Nos Engagements</a></li>
          <li><a class="nav-link scrollto" href="user_view_heb.php">Nos Hebergements</a></li>
          <li><a class="nav-link scrollto " href="user_view_resa.php">Mes Réservations</a></li>
          <?php include_once("component_gestion_dropdown.php"); ?>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->

      <?php
      session_start();
      include_once("./header/header_with_login.php");
      ?>
    </div>
  </header>
  <!-- End Header -->

  <!-- modal login-->
  <div class="modal fade" id="modalLog">
    <div class="modal-dialog">
      <div class="modal-content" style="background:black;">
        <div class="modal-header" style="border-color:#ffbb38;">
          <h5 class="modal-title" style="color: #ffbb38"><b>LOGIN<b></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <input type="text" placeholder="Email / Username" name="email" required class="get-started-btn scrollto">
            <input type="password" placeholder="Password" name="password" required class="get-started-btn scrollto">
        </div>
        <div class="modal-footer" style="border:none">
          <button type="button" class="get-started-btn" style="background: #ffbb38;color: #343a40;" data-bs-dismiss="modal">Close</button>
          <input type="submit" value="LOGIN" name="btnconnexion" class="get-started-btn">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end modal login -->

  <!-- modal disconnect-->
  <div class="modal fade" id="modalout">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color:black;">
        <div class="modal-header" style="border-color:#ffbb38;">
          <h5 class="modal-title" style="color: #ffbb38"><b>SIGN OUT<b></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="color: red;">
          Êtes-vous sûr de vouloir vous Déconnecter ?
        </div>
        <div class="modal-footer" style="border:none">
          <form action="" method="post">
            <button type="button" class="get-started-btn" style="background: #ffbb38;color: #343a40;" data-bs-dismiss="modal">Close</button>
            <input type='submit' value='SIGN OUT' name='btndeconnexion' class='get-started-btn'>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end modal disconnect -->


  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
        <div class="col-xl-8 col-lg-6">
          <h1>Réserver vos Vacances dès Maintenant<span>.</span></h1>
          <h2>Trouvez la location de vacances idéale<span>.</span></h2>
        </div>
      </div>

    </div>
  </section><!-- End Hero -->


  </main><!-- End #main -->

  <?php
  include_once("component_footer.php");
  include_once("component_message.php");

  ?>

</body>

</html>