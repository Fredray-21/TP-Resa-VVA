<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Ajouter un hebergements</title>
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

<body id="page">
  <?php
  session_start();
  if (empty($_SESSION['type']) || $_SESSION['type'] == "VAC") { // si pas login ou pas admin/gestionnaire alors retour index
    echo "<script type='text/javascript'>document.location.href='./index.php'</script>";
  }
  ?>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><img src="./assets/img/favicon.png" alt=""> <a href="index.php">RESA<span>.</span></a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="user_engagements.php">Nos Engagements</a></li>
          <li><a class="nav-link scrollto" href="user_view_heb.php">Nos Hebergements</a></li>
          <li><a class="nav-link scrollto " href="user_view_resa.php">Mes Réservations</a></li>
          <?php include_once("component_gestion_dropdown.php"); ?>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->

      <?php
      include_once("./header/header_without_login.php");
      if (isset($_SESSION['post'])) {
        $ancienneVal = $_SESSION['post'];
      } else {
        $ancienneVal = null;
      }
      ?>
    </div>
  </header><!-- End Header -->


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
          <h2>Ajouter un hebergement</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Ajouter un hebergement</li>
          </ol>
        </div>
      </div>
    </section>
    <!-- End Breadcrumbs -->


    <section class="inner-page" data-aos="fade-up">
      <div class="container ">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="row justify-content-center">
            <div class="p-3 form-group col-md-4 bg-white">
              <label for='selecttypeheb' class="form-label">Type d'Hébergement</label>
              <select class="form-select" aria-label="select" id="selectheb" name='selecttypeheb' required>
                <option value='' disabled selected hidden>Sélectionné un type d'hébergement</option>
                <?php
                $allTypeheb = getAllTypeheb(); //recupère tout les type d'hebergement (appart, studio, chalet)

                foreach ($allTypeheb as $key => $value) {
                  $nomheb = $value['NOMTYPEHEB'];
                  $numheb = $value['CODETYPEHEB'];
                  if (isset($ancienneVal['selecttypeheb'])) {
                    if ($numheb == $ancienneVal['selecttypeheb']) {
                      echo "<option value='$numheb' selected>$nomheb</option>";
                    } else {
                      echo "<option value='$numheb'>$nomheb</option>";
                    }
                  } else {
                    echo "<option value='$numheb'>$nomheb</option>";
                  }
                }
                ?>
              </select>
            </div>

            <div class="p-3 form-group col-md-4 bg-white">
              <label for="nomheb" class="form-label">Nom Hébergement</label>
              <input class="form-control" value="<?php if (isset($ancienneVal['nomheb'])) echo $ancienneVal['nomheb'];  ?>" type="text" id="nomheb" name='nomheb' required maxlength="40" pattern="^[A-Za-z]{1}[A-Za-z1-9 ]{1,30}">
            </div>
          </div>

          <div class="row justify-content-center ">
            <div class="p-3 form-group col-md-2 bg-white">
              <label for="nombreplaceheb" class="form-label">Nombre de place</label>
              <input id="nombreplaceheb" value="<?php if (isset($ancienneVal['nombreplaceheb'])) echo $ancienneVal['nombreplaceheb']; ?>" name='nombreplaceheb' class="form-control" type="number" min="1" max="99" step="1" oninput="validity.valid||(value='');" required pattern="[1-9]">
            </div>

            <div class="p-3 form-group col-md-3 bg-white">
              <label for="surfaceheb" class="form-label">Surface de l'Hébergement en m²</label>
              <input id="surfaceheb" name='surfaceheb' value="<?php if (isset($ancienneVal['surfaceheb'])) echo $ancienneVal['surfaceheb']; ?>" class="form-control" type="number" required min="9" maxlength="10" required pattern="[1-9]">
            </div>

            <div class="p-3 form-group col-md-3 bg-white">
              <label for="anneheb" class="form-label">Année de l'hébergement</label>
              <!-- <input id="anneheb" name='anneheb' class="form-control" type="text" required> -->
              <select class="form-select" aria-label="select" id="anneheb" name='anneheb' required>
                <option value='' disabled selected hidden></option>
                <?php
                $d = date("Y");
                for ($i = 0; $i <= 30; $i++) {
                  $date = $d - $i;
                  if (isset($ancienneVal['anneheb'])) {
                    if ($ancienneVal['anneheb'] == $date) {
                      echo " <option value='$date' selected>$date</option>";
                    } else {
                      echo " <option value='$date'>$date</option>";
                    }
                  } else {
                    echo " <option value='$date'>$date</option>";
                  }
                }
                ?>
              </select>

            </div>
          </div>

          <div class="row justify-content-center">
            <div class="p-3 form-group col-md-4 bg-white">
              <label for="secteurheb" class="form-label">Secteur de l'hébergement</label>
              <select class="form-select" aria-label="select" id="secteurheb" name='secteurheb' required>
                <option value='' disabled selected hidden>Sélectionné un Secteur</option>

                <?php
                $tabSecteur = ["Siège", "Alpes", "Pyrénées", "Est", "DTOM", "Autres"];
                $counter = 0;
                foreach ($tabSecteur as $key => $Secteur) {
                  $counter++;
                  if (isset($ancienneVal['secteurheb'])) {
                    if ($Secteur == $ancienneVal['secteurheb']) {
                      echo "<option value='$Secteur' selected>$counter | $Secteur</option>";
                    } else {
                      echo "<option value='$Secteur'>$counter | $Secteur</option>";
                    }
                  } else {
                    echo "<option value='$Secteur'>$counter | $Secteur</option>";
                  }
                }
                ?>
              </select>
            </div>

            <div class="p-3 form-group col-md-4 bg-white">
              <label for='selectinternet' class="form-label">Présence d'internet?</label><br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="btnRadio" id="inlineRadio1" value="1" required <?php if (isset($ancienneVal['btnRadio']) && $ancienneVal['btnRadio'] == 1) echo "checked" ?>>
                <label class="form-check-label" for="inlineRadio1">OUI</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="btnRadio" id="inlineRadio2" value="0" <?php if (isset($ancienneVal['btnRadio']) && $ancienneVal['btnRadio'] == 0) echo "checked" ?>>
                <label class="form-check-label" for="inlineRadio2">NON</label>
              </div>

            </div>
          </div>
          <div class="row justify-content-center">

            <div class="p-3 form-group col-md-4 bg-white">
              <label for='selectorientation' class="form-label">Orientation de l'Hébergement</label>
              <select class="form-select" aria-label="select" id="selectorientation" name='selectorientation' required>
                <option value='' disabled selected hidden>Sélectionné une orientation</option>

                <?php
                $tabOrientation = ["NORD", "SUD", "EST", "OUEST"];
                foreach ($tabOrientation as $key => $Orientation) {
                  if (isset($ancienneVal['selectorientation'])) {
                    if ($Orientation == $ancienneVal['selectorientation']) {
                      echo "<option value='$Orientation' selected>$Orientation</option>";
                    } else {
                      echo "<option value='$Orientation'>$Orientation</option>";
                    }
                  } else {
                    echo "<option value='$Orientation'>$Orientation</option>";
                  }
                }
                ?>
              </select>
            </div>

            <div class="p-3 form-group col-md-4 bg-white">
              <label for='selectetat' class="form-label">Etat de l'Hébergement</label>
              <select class="form-select" aria-label="select" id="selectetat" name='selectetat' required>
                <option value='' disabled selected hidden>Sélectionné un etat</option>
                <?php
                $tabEtat = ["Disponible", "En-rénovation"];
                foreach ($tabEtat as $key => $Etat) {
                  if (isset($ancienneVal['selectetat'])) {
                    if ($Etat == $ancienneVal['selectetat']) {
                      echo "<option value='$Etat' selected>$Etat</option>";
                    } else {
                      echo "<option value='$Etat'>$Etat</option>";
                    }
                  } else {
                    echo "<option value='$Etat'>$Etat</option>";
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="p-3 form-group col-lg-8 bg-white">
              <label for="descriheb" class="form-label">Description de l'hébergement</label>
              <textarea id="descriheb" class="form-control" name='descriheb' aria-label="With textarea" rows="3" maxlength="190" required pattern="[a-z\s\éèëâäà]{1,189}"><?php if (isset($ancienneVal['descriheb'])) echo $ancienneVal['descriheb'] ?></textarea>
            </div>

          </div>
          <div class="row justify-content-center">
            <div class="p-3 form-group col-md-3 bg-white">
              <label for="tarifsem" class="form-label">Tarif par semaine de l'hébergement</label>
              <input id="tarifsem" name='tarifsem' class="form-control" type="number" step=".01" min="1" maxlength="10" required pattern="^\d*(\.\d{0,2})?$" value="<?php if (isset($ancienneVal['tarifsem'])) echo $ancienneVal['tarifsem'] ?>">
            </div>

            <div class="p-3 form-group col-md-3 bg-white">
              <input type="hidden" class="form-control" name="MAX_FILE_SIZE" value="100000">
              <label for="imageHeb" class="form-label">photo</label>
              <input type="file" class="form-control" id="imageHeb" name="imageHeb" required>
            </div>

            <div class="p-3 form-group col-2 bg-white d-flex align-items-center justify-content-center">
              <input class="btn btn-warning" type="submit" name='btnaddheb'>
            </div>
          </div>

        </form>
      </div>
    </section>
  </main><!-- End #main -->

  <?php //W.I.P gestion photo
  if (isset($_SESSION['post'])) unset($_SESSION['post']);
  if (isset($_POST['btnaddheb'])) {
    if (isset($_POST['selecttypeheb']) && isset($_POST['nomheb']) && isset($_POST['btnRadio']) && isset($_POST['nombreplaceheb']) && isset($_POST['anneheb']) && isset($_POST['secteurheb']) && isset($_POST['selectorientation']) && isset($_POST['selectetat']) && isset($_POST['descriheb']) && isset($_POST['descriheb']) && isset($_POST['tarifsem']) && isset($_FILES['imageHeb'])) {

      $selecttypeheb = $_POST['selecttypeheb'];
      $nomheb = $_POST['nomheb'];
      $nombreplaceheb = $_POST['nombreplaceheb'];
      $surfaceheb = $_POST['surfaceheb'];
      $internet = $_POST['btnRadio'];
      $anneheb = $_POST['anneheb'];
      $secteurheb = $_POST['secteurheb'];
      $selectorientation = $_POST['selectorientation'];
      $selectetat = $_POST['selectetat'];
      $descriheb = $_POST['descriheb'];
      $tarifsem = $_POST['tarifsem'];

      $dossier = 'upload/'; // debut image
      $fichier = basename($_FILES['imageHeb']['name']);
      $taille_maxi = 100000;
      $taille = filesize($_FILES['imageHeb']['tmp_name']);
      $extensions = array('.png', '.gif', '.jpg', '.jpeg');
      $extension = strrchr($_FILES['imageHeb']['name'], '.');

      //Début des vérifications de sécurité...
      if (empty($_FILES['imageHeb']['tmp_name'])) {
        $erreur = "Le fichier est incorrect...";
      }
      if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
      {

        $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, ...';
      }
      if ($taille > $taille_maxi) {

        $erreur = 'Le fichier est trop gros...';
      }

      if (!isset($erreur)) //S'il n'y a pas d'erreur, on upload
      {
        //On formate le nom du fichier ici...
        $fichier = strtr(
          $fichier,
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
        );
        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
        if (move_uploaded_file($_FILES['imageHeb']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
          // echo 'Upload effectué avec succès !';

          $sth = setHebergement($selecttypeheb, $nomheb, $nombreplaceheb, $surfaceheb, $internet, $anneheb, $secteurheb, $selectorientation, $selectetat, $descriheb,  $tarifsem);
          $idHEB = $sth['NOHEB'];

          mkdir($dossier . $idHEB, 0700); // cree un ficher pour l'hebergement
          rename($dossier . $fichier, $dossier . $idHEB . "/" . $idHEB . $extension); // deplace l'image dans le bon dossier

          $i = 0; // compte le nombre d'image dans le fichier
          $dir = $dossier . $idHEB . "/";
          if ($handle = opendir($dir)) {
            while (($file = readdir($handle)) !== false) {
              if (!in_array($file, array('.', '..')) && !is_dir($dir . $file)) {
                $i++;
              }
            }
          }

          rename($dir . $idHEB . $extension, $dir . $idHEB . "picture-" . $i . $extension);


          $photo = SetLinkPHOTO($idHEB, $dossier . $idHEB . "/");


          $value = "L'hébergement N°$idHEB a bien été ajouté ";
          echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";

          $nbheb = intval(getNbAllheb()['NbHeb']);
          $nbheb = ceil($nbheb / 5);
          echo "<script type='text/javascript'>document.location.href='./gestion_view_heb.php?p=$nbheb'</script>";
        } else //Sinon (la fonction renvoie FALSE).
        {
          $erreur = "Echec de l\'upload";
          $_SESSION['post'] = $_POST;
          echo "<script type='text/javascript'>document.cookie =\"message=$erreur\";</script>";
          echo "<script type='text/javascript'>document.location.href='./gestion_add_loc.php?e=1'</script>";
        }
      } else {
        $_SESSION['post'] = $_POST;

        echo "<script type='text/javascript'>document.cookie =\"message=$erreur\";</script>";
        echo "<script type='text/javascript'>document.location.href='./gestion_add_loc.php?e=1'</script>";
      }
    }
  } // FIN W.I.P gestion photo

  include_once("component_footer.php");
  include_once("component_message.php")
  ?>
</body>



</html>