<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Voir les hebergements</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- ajax -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
  <script src="https://kit.fontawesome.com/5e99020fac.js" crossorigin="anonymous"></script>

</head>

<body id="page">
<?php
session_start();
?>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-lg-between">
      <h1 class="logo me-auto me-lg-0"><img src="./assets/img/favicon.png" alt=""> <a href="index.php">RESA<span>.</span></a></h1>
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="user_engagements.php">Nos Engagements</a></li>
          <li><a class="nav-link scrollto active" href="user_view_heb.php">Nos Hebergements</a></li>
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
  <!-- tout ce qu'il est au deçu gère le bandeau noir avec connexion et déconnexion sauf (ajouté un hebergement(car ici pas besoin de login)) -->



  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs" data-aos="fade-down">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Voir Nos Hebergements</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Voir Nos Hebergements</li>
          </ol>
        </div>
      </div>
    </section>
    <!-- End Breadcrumbs -->


    <!-- début filter -->
    <section class="p-0">
      <?php
      if (isset($_GET['filter']) && $_GET['filter'] != null) {
        $getfilter = $_GET['filter'];
        $getfilter = explode(",", $getfilter);

        $filtreActuel = null;
        foreach ($getfilter as $key => $value) {
          $value = explode("=", $value);
          if (!IsNullOrEmptyString($value[1])) {

            if ($value[0] == "heb" && is_numeric($value[1])) {
              $filtreActuel = $filtreActuel . "Hebergement=" . getTypehebWherecode($value[1])['NOMTYPEHEB'] . " , ";
            } elseif ($value[0] == "wifi" && is_numeric($value[1])) {
              if ($value[1] == 0) {
                $wifi = "NON";
              } else {
                $wifi = "OUI";
              }
              $filtreActuel = $filtreActuel . "Wifi=$wifi, ";
            } elseif ($value[0] == "or" && ($value[1] == "NORD" or $value[1] == "SUD" or $value[1] == "EST" or $value[1] == "OUEST")) {
              $filtreActuel = $filtreActuel . "Orientation=$value[1], ";
            } elseif ($value[0] == "surfMin" && is_numeric($value[1])) {
              $filtreActuel = $filtreActuel . "Surface Minimun=$value[1], ";
            } elseif ($value[0] == "place" && is_numeric($value[1])) {
              $filtreActuel = $filtreActuel . "Nombre de place Minimun=$value[1], ";
            } elseif ($value[0] == "dispo" && $value[1] == "Disponible") {
              $filtreActuel = $filtreActuel . "Disponibilité=$value[1], ";
            } elseif ($value[0] == "secteur" && ($value[1] == "Siège" or $value[1] == "Alpes" or $value[1] == "Pyrénées" or $value[1] == "Est" or $value[1] == "DTOM" or $value[1] == "Autres")) {
              $filtreActuel = $filtreActuel . "Secteur=$value[1], ";
            } else {
              $filtreActuel = null;
            }
          }
        }
        if (isset($filtreActuel)) {
          $filtreActuel = substr($filtreActuel, 0, -2);
        }
      }
      ?>


      <button id="btn-filtre" class="btn btn-info " type="button" data-aos="fade-left" data-aos-duration="700" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span style="font-size: 1.5em; "><i class="fas fa-bars"></i><br> Filtre <br><i class="fas fa-filter "></i></span>
      </button>

      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Filtre de Recherche</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <!-- début formulaire filtre -->
          <section class="p-0 ">
            <div class="container ">
              <div class="col m-2">
                <div>
                  <input class="form-check-input" name="chkdisponible" value="Disponible" type="checkbox" id="dispo">
                  <label class="form-check-label" for="dispo">
                    Affiché que les Disponible
                  </label>
                </div>
              </div>

              <div class="col m-2">
                <select class="form-select" aria-label="select" id="selectheb" name='t'>
                  <option value='' disabled selected hidden>Sélectionné un type d'hébergement</option>

                  <?php
                  $allTypeheb = getAllTypeheb();
                  foreach ($allTypeheb as $key => $value) {
                    $nomheb = $value['NOMTYPEHEB'];
                    $numheb = $value['CODETYPEHEB'];

                    echo "<option value='$numheb'>$nomheb</option>";
                  }
                  ?>
                </select>
              </div>

              <div class="col m-2">
                <label class="form-label">Présence d'internet?</label><br>
                <div class="form-check form-check-inline" id="wifiradiobtn">
                  <input class="form-check-input" type="radio" name="w" id="inlineRadio1" value="1">
                  <label class="form-check-label" for="inlineRadio1">
                    OUI
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="w" id="inlineRadio2" value="0">
                  <label class="form-check-label" for="inlineRadio2">
                    NON
                  </label>
                </div>
              </div>


              <div class="col m-2">
                <select class="form-select" aria-label="select" id="selectorientation" name='selectorientation' required>
                  <option value='' disabled selected hidden>Sélectionné une orientation</option>
                  <?php
                  $tabOrientation = ['NORD', 'SUD', 'EST', 'OUEST']; // tab et foreach afin de selectionné la bonne orientation
                  foreach ($tabOrientation as $key => $value) {
                    echo "<option value='$value'>$value</option>";
                  }
                  ?>
                </select>
              </div>

              <div class="col m-2">
                <label for="secteurheb" class="form-label">Secteur de l'hébergement</label>
                <select class="form-select" aria-label="select" id="secteurheb" name='secteurheb' required>
                  <option value='' disabled selected hidden>Sélectionné un Secteur</option>
                  <option value='Siège'>1| Siège </option>
                  <option value='Alpes'>2| Alpes </option>
                  <option value='Pyrénées'>3| Pyrénées </option>
                  <option value='Est'>4| Est </option>
                  <option value='DTOM'>5| DTOM </option>
                  <option value='Autres'>6| Autres </option>
                </select>
              </div>

              <div class="col m-3 ">
                <label for="rangeNBplace">Nombre de place Minimun</label><br>
                <input id="rangeNBplace" type="range" value="1" min="1" max="<?php echo getMaxPlaceHeb()['MaxPlace'] ?>" oninput="this.nextElementSibling.value = this.value">
                <output>1</output> <i class='fas fa-user'></i>
              </div>

              <div class="col m-3 ">
                <label for="rangeSurfaceMin">Surface Minimun</label><br>
                <input id="rangeSurfaceMin" type="range" value="9" min="9" max="<?php echo getMaxSurffaceHeb()['MaxSurface']?>" oninput="this.nextElementSibling.value = this.value">
                <output>9</output>m²
              </div>

              <br>
              <div id="form-btn" class="d-flex justify-content-lg-around">
                <form action="" method="get" name='filter'>
                  <input type="hidden" name="filter" id="filter" value="">
                  <input type="submit" onclick="Filter()" class="btn btn-success" value="Valider le filtre">
                </form>

                <a href="user_view_heb.php" class="btn btn-danger">Supprimé tout les filtres</a>
              </div>
            </div>
          </section>
          <!-- fin formulaire filtre -->

          <br>
          <br>
          <?php
          if (isset($filtreActuel) && !IsNullOrEmptyString($filtreActuel)) {
            $filtreActuel = explode(",", $filtreActuel);
            echo "<h3>Filtre Actuel :</h3>";
            foreach ($filtreActuel as $cle => $valeur) {
              $valeur = explode("=", $valeur);
              if (!IsNullOrEmptyString($valeur[1])) {
                if (trim($valeur[0]) == "Surface Minimun") {
                  echo "<p class='m-0'>$valeur[0]: $valeur[1]m²</p>";
                } elseif (trim($valeur[0]) == "Nombre de place Minimun") {
                  echo "<p class='m-0'>$valeur[0]: $valeur[1] <i class='fas fa-user'></i></p>";
                } else {
                  echo "<p class='m-0'>$valeur[0]: $valeur[1]</p>";
                }
              }
            }
          }
          ?>

        </div>
      </div>
    </section>
    <!-- fin Filter -->


    <?php
    // début de la vérification des filtre
    $allheb = null; // initialise a null les herbergment
    if (isset($_GET['filter']) && $_GET['filter'] != null) {  // si get filter et différent de null alors
      $allheb = GetHebFilter($_GET['filter']); // fonction filter avec en paramètre le "tableua de filtre"
      if (!$allheb) {
        $value = "Aucun hebergement n'est disponible avec ce filtre";
        echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";
        echo "<script type='text/javascript'>document.location.href='./user_view_heb.php?e=1'</script>";
        // met en message l'erreur et pas en simple print
        // echo "Aucun hebergement n'est disponible avec c'est filtre";
      }
    } else {
      $allheb = getAllheb(); // recupère tout les heberment
      if (!$allheb) {
        $value = "Aucun hebergement n'est disponible";
        echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";
        echo "<script type='text/javascript'>document.location.href='./index.php?e=1'</script>";
      }
    }

    if (isset($_GET['filter']) && $_GET['filter'] == null) {
      $value = "Filtre Invalide";
      echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";
      echo "<script type='text/javascript'>document.location.href='./user_view_heb.php?e=1'</script>";
    }
    ?>

    <!-- ici affiche les hebergement -->
    <section id='page-engagement' class="inner-page">
      <div class="row" id="box-heb">
        <?php

        if ($allheb) { // suprime le message de filtre incorecte
          echo "<script type='text/javascript'>document.cookie = 'message= ; expires = Thu, 01 Jan 1970 00:00:00 GMT'</script>";
          echo "<script type='text/javascript'>document.getElementById('message').style.display = 'none';</script>";

          $count = 0; // met un compteur a 0
          foreach ($allheb as $key => $value) {
            $count++;
            if ($count == 1) {
              $aos = "data-aos='fade-up-right'";
            } elseif ($count == 2) {
              $aos = "data-aos='fade-up'";
            } else {
              $count = 0;
              $aos = "data-aos='fade-up-left'";
            }

            echo "<div style='background-color:white; width:30em;' class='col-3 m-3 p-3 border'   $aos  data-aos-duration='700'> "; //declaration de la division global de chaque hebergement
            $ID = $value['NOHEB'];
            $ETATHEB = $value['ETATHEB'];
            if ($ETATHEB === "Disponible") {
              $ETATHEB = "<span style='color:green'> $ETATHEB</span>";
            } else {
              $ETATHEB = "<span style='color:Red'> $ETATHEB</span>";
            }


            if ($value['ETATHEB'] == "Disponible") { // si disponile alors affiche le btn
              if (isset($_SESSION['USER']) && ($_SESSION['type'] == "ADM"  || $_SESSION['type'] == "LOC" || $_SESSION['type'] == "VAC")) {
                echo "<a href='./user_reserve_heb.php?id=$ID' class='btn btn-warning' title='Réservé'>Réserver</a><br>"; // si connecter alors lien vers page
              } else {
                echo "<form action='' method='get'>";
                $message = "Vous n&#8217;êtes pas connecté, veuillez vous connecter"; // si pas connecter alors cookie + message + get e=1
                echo "<button onclick='this.form.submit(); document.cookie =\"message=$message \";' class='btn btn-warning' name='e' value='1'  title='Réservé'>Réserver</button><br>";
                echo "</form>";
              }
            }


            echo "➤ $ETATHEB | <span style='color:blue'>" . getTypehebWherecode($value['CODETYPEHEB'])['NOMTYPEHEB'] . "</span><br>";
            echo "" . ucfirst($value['NOMHEB']) . " | ";
            echo "" . $value['SURFACEHEB'] . " m² | ";
            echo "" . $value['NBPLACEHEB'] . " <i class='fas fa-user'></i> | ";
            if ($value['INTERNET'] == 1) {
              echo "Wifi: <span style='color:green'>OUI</span> <br>";
            } else {
              echo "Wifi: <span style='color:red'>NON</span> <br>";
            }
            echo "Dernière rénovation:  " . $value['ANNEEHEB'] . "<br>";
            echo "Secteur: " . $value['SECTEURHEB'] . " | ";
            echo "Orientation " . $value['ORIENTATIONHEB'] . "<br>";
            echo "Prix/semaine : <h4 class='d-inline-block'>" . $value['TARIFSEMHEB'] . " €</h4>";

            $dossierphoto = $value['PHOTOHEB'];
        ?>
            <!-- Début slide image -->
            <div id="carousel<?php echo $ID; ?>" class="carousel carousel-dark slide" data-bs-ride="carousel" style="max-width:30em">
              <div class="carousel-indicators">
                <?php if ($handle = opendir($dossierphoto)) {
                  $compteur = 0;
                  while (($file = readdir($handle)) !== false) {
                    if (!in_array($file, array('.', '..')) && !is_dir($dossierphoto . $file)) {
                      if ($compteur == 0) {
                        $compteur++;
                        echo "<button type='button' data-bs-target='#carousel$ID' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide $compteur'></button>";
                      } else {
                        $compteur++;
                        $slide_to = $compteur - 1;
                        echo "<button type='button' data-bs-target='#carousel$ID' data-bs-slide-to='$slide_to' aria-label='Slide  $compteur'></button>";
                      }
                    }
                  }
                }
                ?>
              </div>
              <div class="carousel-inner img-thumbnail">
                <?php
                if ($handle = opendir($dossierphoto)) {
                  $premier = true;
                  while (($file = readdir($handle)) !== false) {
                    if (!in_array($file, array('.', '..')) && !is_dir($dossierphoto . $file)) {
                      if ($premier) {
                        echo "<div class='carousel-item active'>";
                        $premier = false;
                      } else {
                        echo "<div class='carousel-item'>";
                      }
                      echo "<a href='" . $dossierphoto . $file . "' data-gallery='portfolioGallery' class='portfolio-lightbox$ID'>";
                      echo "<img src='" . $dossierphoto . $file . "' class='d-block w-100 rounded ' class='img-fluid' height='300px'></a></div>";
                    }
                  }
                }
                ?>

              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?php echo $ID; ?>" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carousel<?php echo $ID; ?>" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            <!-- Fin slide image -->


        <?php

            echo "Description: <br><p> " . $value['DESCRIHEB'] . "</p><br>";
            echo "</div>";
            if ($count == 3) {
              echo "<div class='w-100 '></div>";
            }
          }
        }
        ?>
      </div>
    </section>

  </main><!-- End #main -->
  <?php
  include_once("component_footer.php");
  include_once("component_message.php");

  ?>
</body>


<?php // début boucle pour pouvoir open les image en grand mais pas toute la page seulement l'hebergement en cour
foreach ($allheb as $key => $value) {
  $noheb = $value['NOHEB'];
?>
  <script>
    /**
     * Initiate portfolio lightbox 
     */
    const portfolioLightbox<?php echo $noheb ?> = GLightbox({
      selector: '.portfolio-lightbox<?php echo $noheb ?>'
    });
  </script>
<?php
} // fin boucle open image 
?>


<script>
  function valeur_select(id) { // retourne la valeur d'un select
    select = document.getElementById(id);
    choice = select.selectedIndex;
    valeur = select.options[choice].value;
    return valeur;
  }

  function Filter() { // retourne une  chaine string avec toute les valeur du formulaire a metre en get
    if (document.querySelector('input[name="w"]:checked') == null) {
      radio = "";
    } else {
      radio = document.querySelector('input[name="w"]:checked').value
    }
    heb = valeur_select("selectheb");
    orientation = valeur_select("selectorientation");
    surfaceMin = document.getElementById("rangeSurfaceMin").value;
    NbPlace = document.getElementById("rangeNBplace").value;
    secteur = valeur_select("secteurheb");

    if (document.querySelector('input[name="chkdisponible"]:checked') == null) {
      dispo = ""
    } else {
      dispo = document.querySelector('input[name="chkdisponible"]:checked').value;
    }

    filter = "heb=" + heb + ",wifi=" + radio + ",or=" + orientation + ",surfMin=" + surfaceMin + ",place=" + NbPlace + ",dispo=" + dispo + ",secteur=" + secteur + "";
    //alert(filter);
    document.getElementById('filter').value = filter; // met la valeur d'an un input type hidden puis submit le formuaire
  }
</script>



</html>