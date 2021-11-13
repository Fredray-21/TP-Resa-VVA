<!-- ======= Footer ======= -->
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row d-flex justify-content-around">
        <div class="col-lg-3 col-md-6">
          <div class="footer-info">
            <h3>RESA<span>.</span></h3>
            <p>
              Lycée Parc de Vilgenis <br>
              80 Rue de Versailles BP112<br> 91305, Massy<br><br>
              <strong>Phone:</strong> 01 69 53 74 00<br>
              <strong>Email:</strong> ce.0910727w@ac-versailles.fr<br>
            </p>
            <div class="social-links mt-3">
              <a title="Mail" href="mailto:ce.0910727w@ac-versailles.fr" class="mail"><i class="bx bx-mail-send"></i></a>
              <a title="Google Map" href="https://www.google.com/maps/place/Lyc%C3%A9e+Parc+de+Vilgenis/@48.7311578,2.2502799,17z/data=!3m1!4b1!4m5!3m4!1s0x47e677a226d26443:0x169ed3e42bc6b239!8m2!3d48.7310628!4d2.2524677" target="_blank" class="google-map"><i class="bx bx-map"></i></a>
              <a title="Site Internet" href="http://www.lyc-vilgenis-massy.ac-versailles.fr/" target="_blank" class="google"><i class="bx bxl-google"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4 class="text-warning">Liens</h4>
          <ul>
          <li><i class="bx bx-chevron-right"></i> <a href="index.php">Home</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="user_engagements.php">Nos Engagements</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="user_view_heb.php">Nos Hebergementss</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="user_view_resa.php">Mes Réservations</a></li>

          </ul>
        </div>

        <?php
        if (isset($_SESSION['type'])) {
          if ($_SESSION['type'] == "ADM" || $_SESSION['type'] == "LOC") { ?>

            <div class="col-lg-3 col-md-6  footer-links">
              <h4 class="text-info">Espace Gestion</h4>
              <ul>
                <li><i class="bx bx-chevron-right text-info"></i> <a href="gestion_view_resa.php">Voir les réservations</a></li>
                <li><i class="bx bx-chevron-right text-info"></i> <a href="view_heb_gestion.php">Voir les hebergements</a></li>
                <li><i class="bx bx-chevron-right text-info"></i> <a href="gestion_add_loc.php">Ajouter un hebergements</a></li>
              </ul>
            </div>

        <?php
          }
        }
        ?>



      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong><span>RESA</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <span style="color: #ffc451;">Frédéric Dabadie</span>
    </div>
  </div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/purecounter/purecounter.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>