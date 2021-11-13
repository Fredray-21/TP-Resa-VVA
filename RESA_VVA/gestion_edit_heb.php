<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Modifier un hebergements</title>
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
    <?php
    if (isset($_GET['id'])) {
        $noheb = $_GET['id'];
    } else {
        header('Location: user_view_heb.php');
    }

    ?>



    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top header-inner-pages">
        <div class="container d-flex align-items-center justify-content-lg-between">

            <h1 class="logo me-auto me-lg-0"><img src="./assets/img/favicon.png" alt=""> <a href="index.php">RESA<span>.</span></a></h1>

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto" href="index.php">Home</a></li>
                    <li><a class="nav-link scrollto " href="user_engagements.php">Nos Engagements</a></li>
                    <li><a class="nav-link scrollto" href="user_view_heb.php">Nos Hebergements</a></li>
                    <li><a class="nav-link scrollto active" href="#">Mes Réservations</a></li>
                    <?php include_once("component_gestion_dropdown.php"); ?>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
            </nav><!-- .navbar -->

            <?php
            include_once("./header/header_without_login.php");
            //verification des droit

            ?>

        </div>
    </header><!-- End Header -->

    <?php
    if (empty($_SESSION['type']) || $_SESSION['type'] == "VAC") { // si pas login ou pas admin/gestionnaire alors retour index
        echo "<script type='text/javascript'>document.location.href='./index.php'</script>";
    }
    ?>
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
                    <h2>Modifier un hebergement</h2>
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li>Modifier un hebergement</li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- End Breadcrumbs -->

        <?php
        $hebergement = getHebWhereID($noheb); // recupération de tout l'hebergement 
        ?>
        <section class="inner-page">
            <div class="container ">
                <form action="" method="post" data-aos='fade-up' data-aos-duration='700'>
                    <div class="row justify-content-center">
                        <div class="p-3 form-group col-md-4 bg-white">
                            <label for='selecttypeheb' class="form-label">Type d'Hébergement</label>
                            <select class="form-select" aria-label="select" id="selectheb" name='selecttypeheb' required>
                                <!-- <option value='' disabled selected hidden>Sélectionné un type d'hébergement</option> -->
                                <?php
                                $allTypeheb = getAllTypeheb();
                                foreach ($allTypeheb as $key => $value) {
                                    $nomheb = $value['NOMTYPEHEB'];
                                    $numheb = $value['CODETYPEHEB'];
                                    if ($numheb == $hebergement['CODETYPEHEB']) {
                                        echo "<option value='$numheb' selected>$nomheb</option>";
                                    } else {
                                        echo "<option value='$numheb'>$nomheb</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="p-3 form-group col-md-4 bg-white">
                            <label for="nomheb" class="form-label ">Nom Hébergement</label>
                            <input class="form-control" type="text" id="nomheb" name='nomheb' value="<?php echo $hebergement['NOMHEB'] ?>" required maxlength="40" pattern="^[A-Za-z]{1}[A-Za-z1-9 ]{1,30}">
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <div class="p-3 form-group col-md-2 bg-white">
                            <label for="nombreplaceheb" class="form-label">Nombre de place</label>
                            <input value="<?php echo $hebergement['NBPLACEHEB'] ?>" id="nombreplaceheb" name='nombreplaceheb' class="form-control" type="number" min="1" max="99" step="1" oninput="validity.valid||(value='');" required pattern="[1-9]">
                        </div>

                        <div class="p-3 form-group col-md-3 bg-white">
                            <label for="surfaceheb" class="form-label">Surface de l'Hébergement</label>
                            <input value="<?php echo $hebergement['SURFACEHEB'] ?>" id="surfaceheb" name='surfaceheb' class="form-control" type="number" required min="9" maxlength="10" required pattern="[1-9]"">
                        </div>

                        <div class=" p-3 form-group col-md-3 bg-white">
                            <label for="anneheb" class="form-label">Année de l'hébergement</label>
                            <!-- <input value="<?php echo $hebergement['ANNEEHEB'] ?>" id="anneheb" name='anneheb' class="form-control" type="text" required> -->


                            <select class="form-select" aria-label="select" id="anneheb" name='anneheb' required>
                                <?php
                                $d = date("Y");
                                for ($i = 0; $i <= 100; $i++) {
                                    $date = $d - $i;
                                    if ($date == $hebergement['ANNEEHEB']) {
                                        echo " <option value='$date' selected>$date</option>";
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
                            <input value="<?php echo $hebergement['SECTEURHEB'] ?>" id="secteurheb" name='secteurheb' class="form-control" type="text" maxlength="20" required pattern="[A-Za-z\éèëâäà]{1,20}">
                        </div>


                        <div class="p-3 form-group col-md-4 bg-white">
                            <label for='selectinternet' class="form-label">Présence d'internet?</label><br>
                            <div class="form-check form-check-inline">
                                <?php if ($hebergement['INTERNET'] == 1) {
                                    echo "<input class='form-check-input' type='radio' name='btnRadio' id='inlineRadio1' value='1' required checked>";
                                } else {
                                    echo "<input class='form-check-input' type='radio' name='btnRadio' id='inlineRadio1' value='1' required >";
                                }
                                ?>

                                <label class="form-check-label" for="inlineRadio1">OUI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <?php if ($hebergement['INTERNET'] == 0) {
                                    echo "<input class='form-check-input' type='radio' name='btnRadio' id='inlineRadio2' value='0' required checked>";
                                } else {
                                    echo "<input class='form-check-input' type='radio' name='btnRadio' id='inlineRadio2' value='0' required >";
                                }
                                ?>
                                <label class="form-check-label" for="inlineRadio2">NON</label>
                            </div>

                        </div>

                    </div>
                    <div class="row justify-content-center">
                        <div class="p-3 form-group col-md-4 bg-white">
                            <label for='selectorientation' class="form-label">Orientation de l'Hébergement</label>
                            <select class="form-select" aria-label="select" id="selectorientation" name='selectorientation' required>
                                <!-- <option value='' disabled selected hidden>Sélectionné une orientation</option> -->
                                <?php
                                $tabOrientation = ['NORD', 'SUD', 'EST', 'OUEST']; // tab et foreach afin de selectionné la bonne orientation
                                foreach ($tabOrientation as $key => $value) {
                                    if ($value == $hebergement['ORIENTATIONHEB']) {
                                        echo "<option value='$value' selected>$value</option>";
                                    } else {
                                        echo "<option value='$value'>$value</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="p-3 form-group col-md-4 bg-white">
                            <label for='selectetat' class="form-label">Etat de l'Hébergement</label>
                            <select class="form-select" aria-label="select" id="selectetat" name='selectetat' required>
                                <!-- <option value='' disabled selected hidden>Sélectionné un etat</option> -->
                                <?php
                                if ($hebergement['ETATHEB'] == 'Disponible') {
                                    echo "<option value='Disponible' selected >Disponible</option>";
                                    echo "<option value='En-rénovation'>En Rénovation</option>";
                                } else {
                                    echo "<option value='Disponible'  >Disponible</option>";
                                    echo "<option value='En-rénovation' selected>En Rénovation</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="p-3 form-group col-lg-8 bg-white">
                            <label for="descriheb" class="form-label">Description de l'hébergement</label>
                            <textarea id="descriheb" class="form-control" name='descriheb' aria-label="With textarea" rows="3" maxlength="190" required pattern="[a-z\s\éèëâäà]{1,189}"><?php echo $hebergement['DESCRIHEB'] ?></textarea>
                        </div>

                    </div>
                    <div class="row justify-content-center">
                        <div class="p-3 form-group col-md-3 bg-white">
                            <label for="tarifsem" class="form-label">Tarif par semaine de l'hébergement</label>
                            <input value='<?php echo $hebergement['TARIFSEMHEB'] ?>' id="tarifsem" name='tarifsem' class="form-control" type="text" required pattern="^\d*(\.\d{0,2})?$">
                        </div>

                        <div class="p-3 form-group col-5 bg-white d-flex align-items-center justify-content-center">
                            <input class="btn btn-warning" type="submit" name='btnaddheb'>
                        </div>
                    </div>
                </form>

                <br>
                <br>
                <div class="row justify-content-center" data-aos="fade-down">
                    <div class="p-3 form-group col-8 bg-white">
                        <div class="row">

                            <div class="col">
                                <p>Photos actuelles:</p>
                                <?php $dossierphoto = $hebergement['PHOTOHEB']; ?>
                                <!-- Début slide image -->
                                <div id="carousel" class="carousel carousel-dark slide" data-bs-ride="carousel" style="max-width:30em">
                                    <div class="carousel-indicators">
                                        <?php if ($handle = opendir($dossierphoto)) {
                                            $compteur = 0;
                                            while (($file = readdir($handle)) !== false) {
                                                if (!in_array($file, array('.', '..')) && !is_dir($dossierphoto . $file)) {
                                                    if ($compteur == 0) {
                                                        $compteur++;
                                                        echo "<button type='button' data-bs-target='#carousel' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide $compteur'></button>";
                                                    } else {
                                                        $compteur++;
                                                        $slide_to = $compteur - 1;
                                                        echo "<button type='button' data-bs-target='#carousel' data-bs-slide-to='$slide_to' aria-label='Slide  $compteur'></button>";
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
                                                    echo "<a href='" . $dossierphoto . $file . "' data-gallery='portfolioGallery' class='portfolio-lightbox'>";
                                                    echo "<img src='" . $dossierphoto . $file . "' class='d-block w-100 rounded ' class='img-fluid' height='300px'></a>";


                                                    echo "<a style='z-index:500; position:absolute; top: 5px; left:5px;' class='btn btn-danger' href='component_delete_photo.php?id=" . $_GET['id'] . "&p=" . $_GET['p'] . "&photo=$dossierphoto" . "&f=" . "$file' ><i class='far fa-trash-alt'></i></a></div>";
                                                }
                                            }
                                        }
                                        ?>

                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                <!-- Fin slide image -->

                            </div>
                            <div class="col">
                                <p>Ajouté une photo:</p>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" class="form-control" name="MAX_FILE_SIZE" value="100000">
                                    <input type="file" class="form-control " id="imageHeb" name="imageHeb" required><br>
                                    <input class="btn btn-warning " type="submit" name='btnAddPHOTO'>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->



    <?php
    if (isset($_POST['btnAddPHOTO'])) {
        $idHEB = $_GET['id'];

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
                rename($dossier . $fichier, $dossier . $idHEB . "/" . $idHEB . $extension); // deplace l'image dans le bon dossier

                $i = 0; // compte le nombre d'image dans le fichier
                $dir = $dossier . $idHEB . "/";

                if ($handle = opendir($dir)) {
                    while (($file = readdir($handle)) !== false) {
                        if (!in_array($file, array('.', '..')) && !is_dir($dir . $file)) {
                            if ($file != $idHEB . $extension) {
                                $fichierexplose = explode("-", $file);
                                if (intval($fichierexplose[1]) > $i) {
                                    $i = intval($fichierexplose[1]);
                                }
                            }
                        }
                    }
                }
                $i++;
                rename($dir . $idHEB . $extension, $dir . $idHEB . "picture-" . $i . $extension);


                $value = "La photo a bien été ajouté a l'hébergement";
                echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";


                $redirection = "gestion_edit_heb.php?id=" . $_GET['id'] . "&p=" . $_GET['p'] . "";

                echo "<script type='text/javascript'>document.location.href='./" . $redirection . "'</script>";
            } else //Sinon (la fonction renvoie FALSE).
            {
                echo 'Echec de l\'upload !';
            }
        }
    }

    if (isset($_POST['btnaddheb'])) {
        if (isset($_POST['selecttypeheb']) && isset($_POST['nomheb']) && isset($_POST['nombreplaceheb']) && isset($_POST['btnRadio']) && isset($_POST['anneheb']) && isset($_POST['secteurheb']) && isset($_POST['selectorientation']) && isset($_POST['selectetat']) && isset($_POST['descriheb']) && isset($_POST['descriheb']) && isset($_POST['tarifsem'])) {

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

            $sth = UpdateHebergement($selecttypeheb, $nomheb, $nombreplaceheb, $surfaceheb, $internet, $anneheb, $secteurheb, $selectorientation, $selectetat, $descriheb,  $tarifsem, $noheb);

            if ($sth) {
                $value = "L'hébergement N°$noheb a bien été Modifier";
                echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";

                if (isset($_GET['p'])) {
                    $page = $_GET['p'];
                } else {
                    $page = 1;
                }
                echo "<script type='text/javascript'>document.location.href='./view_heb_gestion.php?p=$page'</script>";
            }
        }
    }

    include_once("component_footer.php");
    include_once("component_message.php");

    ?>
</body>

<script>
    /**
     * Initiate portfolio lightbox 
     */
    const portfolioLightbox = GLightbox({
        selector: '.portfolio-lightbox'
    });
</script>

</html>