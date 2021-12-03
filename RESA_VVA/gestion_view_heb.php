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
                    <li><a class="nav-link scrollto " href="user_engagements.php">Nos Engagements</a></li>
                    <li><a class="nav-link scrollto" href="user_view_heb.php">Nos Hebergements</a></li>
                    <li><a class="nav-link scrollto " href="user_view_resa">Mes Réservations</a></li>
                    <?php include_once("component_gestion_dropdown.php"); ?>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
            </nav><!-- .navbar -->


            <?php
            include_once("./header/header_with_login.php");
            ?>
        </div>
    </header><!-- End Header -->
    <?php
    $parPage = 5;

    if (isset($_GET['p']) && $_GET['p'] != null) {
        $pageCourante = $_GET['p'];
    } else {
        $pageCourante = 1;
    }

    $nbHeb = getNbAllheb()['NbHeb'];

    $min = (($pageCourante - 1) * $parPage);
    $max = $parPage;
    $hebergement = getAllhebPagination($min, $max);
    $nbPage = ceil($nbHeb / $parPage);


    $aos = "left";
    if (isset($_GET['aos'])) {
        if ($_GET['aos'] == "r") {
            $aos = "right";
        }
    }
    ?>

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
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Voir les hebergements</h2>
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li>Voir les hebergements</li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- End Breadcrumbs -->


        <section class="inner-page">
            <div style="margin: 0 5em 0 5em;">
                <div id="pagination" style="background-color:white; width:15%; text-align:center;" class="p-3">
                    <h2>Page actuel <span class="text-warning"><br><?php echo $pageCourante ?></span></h2>
                    <form action="" method="get" class="form">
                        <button style="width:50%; height:4em" class="btn border" name="p" value="<?php if ($pageCourante - 1 > 0) {
                                                                                                        echo $pageCourante - 1;
                                                                                                    } else {
                                                                                                        echo $pageCourante;
                                                                                                    } ?>" onclick="previous()" title="Page Précédente">Previous <br><i class="fas fa-arrow-left"></i></button>
                        <button style="width:40%; height:4em" class="btn border" name="p" value="<?php if ($pageCourante + 1 <= $nbPage) {
                                                                                                        echo $pageCourante + 1;
                                                                                                    } else {
                                                                                                        echo $pageCourante;
                                                                                                    } ?>" onclick="this.form.submit()" title="Page Suivante">Next <br><i class="fas fa-arrow-right"></i></button>
                        <input id="aosId" name="aos" type="hidden" value="l">
                    </form>
                </div>

                <table id="table-heb" class="table table-bordered table-striped " style="background-color:white;" data-aos='fade-<?php echo $aos ?>' data-aos-duration='700'>
                    <thead>
                        <tr class="text-center ">
                            <td>Supprimé/Modifier</td>
                            <td>Numéro</td>
                            <td>Type</td>
                            <td>Nom</td>
                            <td>Nombre de Place</td>
                            <td>Surface</td>
                            <td>Internet</td>
                            <td>Année de la dernière rénovation</td>
                            <td>Secteur</td>
                            <td>Orientation</td>
                            <td>Etat</td>
                            <td>Description</td>
                            <td>Photo Hebergement</td>
                            <td>Tarif/Semaine</td>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        $bool = false;
                        if (!$hebergement) {
                            echo "<td colspan='14' style='color:red'>Il n'y a aucun hebergement ici</td>";
                            if (isset($_GET['p']) && $_GET['p'] > 1) { // si il n'y a pas d'hebermgent sur cette page alors retire 1 page
                                $p = $_GET['p'] - 1;
                                echo "<script type='text/javascript'>document.location.href='./gestion_view_heb.php?p=$p'</script>";
                            }
                            if (isset($_GET['p']) && $_GET['p'] == 0) { // si il n'y a pas d'hebermgent sur cette page alors retire 1 page
                                echo "<script type='text/javascript'>document.location.href='./gestion_view_heb.php'</script>";
                            }
                        } else {
                            foreach ($hebergement as $key => $value) {
                                $bool = true;
                                $NOHEB = $value['NOHEB'];
                                $CODETYPEHEB = $value['CODETYPEHEB'];
                                $NOMTYPE = getTypehebWherecode($CODETYPEHEB)['NOMTYPEHEB'];
                                $NOMHEB = $value['NOMHEB'];
                                $NBPLACEHEB = $value['NBPLACEHEB'];
                                $SURFACEHEB = $value['SURFACEHEB'];
                                $INTERNET = $value['INTERNET'];
                                if ($INTERNET == 1) {
                                    $INTERNET = "<span style='color:Green'> OUI </span>";
                                } else {
                                    $INTERNET = "<span style='color:Red'> NON </span>";
                                }

                                $ANNEEHEB = $value['ANNEEHEB'];
                                $SECTEURHEB = $value['SECTEURHEB'];
                                $ORIENTATIONHEB = $value['ORIENTATIONHEB'];
                                $ETATHEB = $value['ETATHEB'];
                                if ($ETATHEB == "Disponible") {
                                    $ETATHEB = "<span style='color:Green'> $ETATHEB </span>";
                                } else {
                                    $ETATHEB = "<span style='color:Blue'> $ETATHEB </span>";
                                }
                                $DESCRIHEB = $value['DESCRIHEB'];
                                $PHOTOHEB = $value['PHOTOHEB'];
                                $TARIFSEMHEB = $value['TARIFSEMHEB'];
                                if (isset($_GET['p'])) {
                                    $pageactuell = $_GET['p'];
                                } else {
                                    $pageactuell = 1;
                                }

                                echo "<td><button type='button' class='btn btn-danger btn-md' data-bs-toggle='modal' data-bs-target='#delete$NOHEB' ><i class='far fa-trash-alt'></i></button>
                                <a href='./gestion_edit_heb.php?id=$NOHEB&p=$pageactuell' class='btn btn-warning btn-md'><i class='fas fa-edit'></i></a></td>";
                                echo "<td>N°$NOHEB</td>";
                                echo "<td>$NOMTYPE</td>";
                                echo "<td>$NOMHEB</td>";
                                echo "<td>$NBPLACEHEB</td>";
                                echo "<td>$SURFACEHEB m²</td>";
                                echo "<td>$INTERNET</td>";
                                echo "<td>$ANNEEHEB</td>";
                                echo "<td>$SECTEURHEB</td>";
                                echo "<td>$ORIENTATIONHEB</td>";
                                echo "<td>$ETATHEB</td>";
                                echo "<td><button type='button' class='btn btn-secondary btn-md' data-bs-toggle='modal' data-bs-target='#Description$NOHEB' ><i class='fas fa-file-alt'></i></button></td>";
                                // echo "<td>$DESCRIHEB</td>";

                                echo "<td><button type='button' class='btn btn-secondary btn-md' data-bs-toggle='modal' data-bs-target='#photo$NOHEB' > <i class='fas fa-images'></i></button></td>";

                                echo "<td>$TARIFSEMHEB €</td></tr>";

                        ?>
                                <div class="modal fade" id="photo<?php echo $NOHEB; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Photo de l'hebegement N°<?php echo $NOHEB ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Début slide image -->
                                                <div id="carousel<?php echo $NOHEB; ?>" class="carousel carousel-dark slide" data-bs-ride="carousel" style="max-width:30em">
                                                    <div class="carousel-indicators">
                                                        <?php
                                                        $dossierphoto = $PHOTOHEB;
                                                        if ($handle = opendir($dossierphoto)) {
                                                            $compteur = 0;
                                                            while (($file = readdir($handle)) !== false) {
                                                                if (!in_array($file, array('.', '..')) && !is_dir($dossierphoto . $file)) {
                                                                    if ($compteur == 0) {
                                                                        $compteur++;
                                                                        echo "<button type='button' data-bs-target='#carousel$NOHEB' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide $compteur'></button>";
                                                                    } else {
                                                                        $compteur++;
                                                                        $slide_to = $compteur - 1;
                                                                        echo "<button type='button' data-bs-target='#carousel$NOHEB' data-bs-slide-to='$slide_to' aria-label='Slide  $compteur'></button>";
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
                                                                    echo "<img src='" . $dossierphoto . $file . "' class='d-block w-100 rounded ' class='img-fluid' height='300px'></div>";
                                                                }
                                                            }
                                                        }
                                                        ?>

                                                    </div>
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?php echo $NOHEB; ?>" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel<?php echo $NOHEB; ?>" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                </div>
                                                <!-- Fin slide image -->

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Revenir</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="Description<?php echo $NOHEB; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Description de l'hebegement N°<?php echo $NOHEB ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><?php echo $DESCRIHEB ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Revenir</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="delete<?php echo $NOHEB; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirmez vous la suppression ?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Suppression de l'hebergement: </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Non</button>
                                                <form action="" method="post">
                                                    <button type="submit" class="btn btn-success" name="btnDelete<?php echo $NOHEB ?>">Oui</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                                if (isset($_POST['btnDelete' . $NOHEB])) {             //      A FAIRE IL Y A KA FONCTION DANS LE FILE
                                    $sthh = DeleteHebWhereID($NOHEB);
                                    if ($sthh) {
                                        $value = "L'Hebergement N°$NOHEB a bien été Supprimé";
                                        echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";
                                        $redirection = explode("/", $_SERVER['REQUEST_URI']); // afin de rester sur la page actuel
                                        echo "<script type='text/javascript'>document.location.href='./" . end($redirection) . "'</script>";
                                    }
                                }
                            } // fin while
                            if (!$bool) {
                                echo "<td colspan='8' style='color:red'>Vous n'avez aucune réservation ici</td>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main><!-- End #main -->

    <script>
        function previous() {
            document.getElementById("aosId").value = "r";
            this.form.submit();
        }
    </script>
    <?php
    include_once("component_footer.php");
    include_once("component_message.php");
    ?>
</body>

</html>