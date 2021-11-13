<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Nos Engagements</title>
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

  <script src="https://kit.fontawesome.com/5e99020fac.js" crossorigin="anonymous"></script>

</head>

<body id="page">
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><img src="./assets/img/favicon.png" alt=""> <a href="index.php">RESA<span>.</span></a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto active" href="user_engagements.php">Nos Engagements</a></li>
          <li><a class="nav-link scrollto" href="user_view_heb.php">Nos Hebergements</a></li>
          <li><a class="nav-link scrollto " href="user_view_resa.php">Mes Réservations</a></li>
          <?php include_once("component_gestion_dropdown.php"); ?>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->


      <?php
      include_once("./header/header_with_login.php");
      ?>
    </div>
  </header><!-- End Header -->

  <!-- modal login-->
  <div class="modal fade" id="modalLog">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color:black;">
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

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs" data-aos="fade-down">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Nos Engagements</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Nos Engagements</li>
          </ol>
        </div>
      </div>
    </section>
    <!-- End Breadcrumbs -->

    <section class="inner-page">

      <div class="container bg-white">
        <div class="row  text-center p-3">
          <h1>Les Engagements de VVA</h1>
        </div>
        <div class="row">
          <div class="col text-center border p-4">
            <h3>L'histoire</h3>
            <h1 style="color:#48C9B0" data-aos="flip-left" data-aos-duration="2000"><i class="fas fa-book"></i></h1>
            <div class="text-start">
              <p>➤ Installer des villages exclusivement en France, dans des territoires naturels préservés, ou à proximité de grands sites touristiques en basse, moyenne ou haute montagne.</p>
              <p>➤ Préférer toujours des villages à taille humaine et un excellent rapport qualité-prix pour des vacances de qualité accessibles au plus grand nombre.</p>
              <p>➤ Respecter toutes les diversités, toutes les différences, au niveau des salariés comme au niveau des villageois et travailler main dans la main avec les communes d'accueil.</p>
            </div>
          </div>

          <div class="col text-center border p-4">
            <h3>Le Sourire</h3>
            <h1 style="color:#F0B27A" data-aos="flip-right" data-aos-duration="2000"><i class="fas fa-smile-beam"></i></h1>
            <div class="text-start">
              <p>➤ Constituer dans chaque village une équipe compétente et accueillante, qui permette de passer des vacances en toute sérénité et garantir un accueil chaleureux et personnalisé.</p>
              <p>➤ Offrir au quotidien et à tous les niveaux une excellente qualité de service.</p>
            </div>
          </div>
        </div>

        <div class="row ">
          <div class="col text-center border p-4">
            <h3>Le Plaisir</h3>
            <h1 style="color:#1E8449" data-aos="flip-left" data-aos-duration="2000"><i class="fas fa-tree"></i></h1>
            <div class="text-start">
              <p>➤ Proposer une diversité d'animations, avec des animateurs pour qui plaisir rime avec rire.</p>
              <p>➤ Offrir un grand choix d'activités sportives ou culturelles, encadrées par des passionnés de leur discipline et permettre de vivre sa passion lors de séjours thématiques.</p>
              <p>➤ Faire découvrir la nature par des randonnées hors des sentiers battus.</p>
            </div>
          </div>

          <div class="col text-center border p-4">
            <h3>Les Enfants</h3>
            <h1 style="color:#F1948A" data-aos="flip-right" data-aos-duration="2000"><i class="fas fa-child"></i></h1>
            <div class="text-start">
              <p>➤ Proposer des équipements spécialement adaptés aux bébés de 3 à 36 mois.</p>
              <p>➤ Inscrire les enfants dans un projet pédagogique épanouissant, ouvert sur les autres et sur le monde et les sensibiliser au développement durable et à la préservation de la planète.</p>
            </div>
          </div>
        </div>

        <div class="row ">
          <div class="col text-center border p-4">
            <h3>Le Confort</h3>
            <h1 style="color:#D7BDE2" data-aos="flip-left" data-aos-duration="2000"><i class="fas fa-shield-alt"></i></h1>
            <div class="text-start">
              <p>➤ Rénover sans cesse nos villages, dans le cadre d'un plan de modernisation considérable.</p>
              <p>➤ Assurer la sécurité au quotidien par des audits d'hygiène en restauration, des analyses systématiques de tous les points d'eau, des contrôles réguliers des aires de jeux et des espaces sportifs. Prendre en compte les handicaps, dans des villages labellisés Tourisme et Handicap.</p>
            </div>
          </div>

          <div class="col text-center border p-4">
            <h3>Le Goût</h3>
            <h1 style="color:#F4D03F" data-aos="flip-right" data-aos-duration="2000"><i class="fas fa-utensils"></i></h1>
            <div class="text-start">
              <p>➤ Permettre d'être vraiment en vacances avec la pension complète et proposer de nouveaux menus, originaux et créatifs.</p>
              <p>➤ Garantir une cuisine familiale et une bonne qualité des ingrédients avec un service personnalisé, attentionné et convivial et faire goûter les spécialités régionales.</p>
            </div>
          </div>
        </div>

        <div class="row ">
          <div class="col text-center border p-4">
            <h3>Le Pouvoir d'Achat</h3>
            <h1 style="color:#3498DB" data-aos="flip-left" data-aos-duration="2000"><i class="fas fa-money-check-alt"></i></h1>
            <div class="text-start">
              <p>➤ Rénover sans cesse nos villages, dans le cadre d'un plan de modernisation considérable.</p>
              <p>➤ Assurer la sécurité au quotidien par des audits d'hygiène en restauration, des analyses systématiques de tous les points d'eau, des contrôles réguliers des aires de jeux et des espaces sportifs. Prendre en compte les handicaps, dans des villages labellisés Tourisme et Handicap.</p>
            </div>
          </div>

          <div class="col text-center border p-4">
            <h3>Le Développement Local</h3>
            <h1 style="color:#E74C3C" data-aos="flip-right" data-aos-duration="2000"><i class="fas fa-home"></i></h1>
            <div class="text-start">
              <p>➤ Assumer, une mission fondamentale d'acteur de l'économie sociale et solidaire et jouer, un rôle moteur dans l'aménagement et le développement du territoire de proximité.</p>
              <p>➤ Échanger régulièrement avec les voisins, les riverains, les habitants de la commune.</p>
              <p>➤ Privilégier le recours à l'emploi local, en recrutant des saisonniers originaires de la région et les circuits courts de distribution, en achetant aux producteurs locaux.</p>
            </div>
          </div>
        </div>

        <div class="row ">
          <div class="col text-center border p-4">
            <h3>L'Emploi</h3>
            <h1 style="color:#000" data-aos="flip-left" data-aos-duration="2000"><i class="fas fa-user-tie"></i></h1>
            <div class="text-start">
              <p>➤ Agir en employeur responsable, pour développer la motivation, l'implication et les compétences des équipes et garantir aux 1300 salariés de VVA de bonnes conditions de travail.</p>
              <p>➤ Rejeter toute forme de discrimination à l'embauche, en favorisant en particulier l'accueil des salariés handicapés et être attentif à la parité et à l'égalité de salaire entre hommes et femmes.</p>
            </div>
          </div>

          <div class="col text-center border p-4">
            <h3>La Formation</h3>
            <h1 style="color:#CA6F1E" data-aos="flip-right" data-aos-duration="2000"><i class="fas fa-users"></i></h1>
            <div class="text-start">
              <p>➤ Professionnaliser les métiers de VVA l'accueil, l'hébergement, l'animation, la restauration, la maintenance et les espaces verts.</p>
              <p>➤ Développer les contrats en alternance et les contrats d'apprentissage et veiller à l'accueil de stagiaires pour leur transmettre nos savoirs.</p>
            </div>
          </div>
        </div>

        <div class="row ">
          <div class="col text-center border p-4">
            <h3>La Développement Solidaire</h3>
            <h1 style="color:#8E44AD" data-aos="flip-left" data-aos-duration="2000"><i class="fas fa-handshake"></i></h1>
            <div class="text-start">
              <p>➤ Être une entreprise responsable dans tous les domaines et choisir des fournisseurs en fonction de leur politique salariale et de leur engagement durable.</p>
              <p>➤ Respecter au maximum l'environnement de chaque village et ne pas construire n'importe où, n'importe comment.</p>
              <p>➤ Être au plus près des enjeux écologiques en étudiant toutes les alternatives en termes de matériaux de construction ou d'appareils électroménagers.</p>
              <p>➤ Recenser et diffuser les bonnes pratiques des villages et sensibiliser à ces pratiques tous nos partenaires en informant également nos villageois.</p>
            </div>
          </div>

          <div class="col text-center border p-4">
            <h3>La Planète</h3>
            <h1 style="color:#2E86C1" data-aos="flip-right" data-aos-duration="2000"><i class="fas fa-globe-africa"></i></h1>
            <div class="text-start">
              <p>➤ Sensibiliser parents et enfants aux déplacements à pied et à vélo, dans et autour des villages.</p>
              <p>➤ Organiser sur des sites sensibles des animations "faune et flore" avec des organismes de défense de l'environnement (par exemple la LPO, Ligue de Protection des Oiseaux).</p>
              <p>➤ Récupérer l'eau de pluie, installer des composteurs sur tous les sites, installer des économiseurs d'eau, mettre en place des ampoules basse consommation, équiper les villages de voiturettes électriques, utiliser des matériaux de récupération pour les activités manuelles et donner l'exemple au siège de VVA, en économisant l'eau, en récupérant le papier brouillon, etc.</p>
            </div>
          </div>
        </div>

      </div>
    </section>


  </main><!-- End #main -->


  <?php
  include_once("component_footer.php");
  include_once("component_message.php");
  ?>
</body>



</html>