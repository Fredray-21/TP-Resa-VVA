<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Réserver un hebergement</title>
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

    <!--Jquery date picker -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css">
</head>

<body id="page">
    <?php
    session_start();
    //verification des droit
    if (empty($_SESSION['type'])) { // si pas login alors retour index
        header('location: ./index.php');
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
                    <h2>Réserver un hebergement</h2>
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li>Réserver un hebergement</li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container ">
                <div class="row">
                    <div class="col ">
                        <?php
                        if (isset($_GET['id']) && $_GET['id'] != null) {
                            $noheb = $_GET['id'];
                        } else {
                            echo "<script type='text/javascript'>document.location.href='./user_view_heb.php'</script>";
                        }
                        $hebergement =  getHebWhereID($noheb);

                        //var_dump($value);

                        echo "<div class='col-9 p-3 border bg-white'>"; //declaration de la division global de chaque hebergement
                        $ID = $hebergement['NOHEB'];
                        // echo "➤ " . $hebergement['ETATHEB'] . "<br>";
                        echo "➤ " . ucfirst($hebergement['NOMHEB']) . " | ";
                        echo "" . $hebergement['SURFACEHEB'] . "m² | ";
                        echo "" . $hebergement['NBPLACEHEB'] . "👤 | ";
                        if ($hebergement['INTERNET'] == 1) {
                            echo "Wifi: OUI <br>";
                        } else {
                            echo "Wifi: NON <br>";
                        }
                        echo "Dernière rénovation:  " . $hebergement['ANNEEHEB'] . "<br>";
                        echo "Secteur: " . $hebergement['SECTEURHEB'] . " | ";
                        echo "Orientation " . $hebergement['ORIENTATIONHEB'] . "<br>";
                        echo "<br>Prix/semaine : <h4 class='d-inline-block'>" . $hebergement['TARIFSEMHEB'] . " €</h4>";


                        if (isset($_GET['dateDEBUT'])) {
                            //var_dump($_POST);
                            $dateDEBUT = $_GET['dateDEBUT'];

                            $timestamp = strtotime($dateDEBUT);
                            $dateDEB = date("Y-m-d", $timestamp);

                            $sth = GetDatesENDWhereDATEdeb($dateDEB);
                            if (!$sth) { // si la date existe pas dans la base (donc est changer dans l'url) alors remet a 0
                                echo "<script type='text/javascript'>document.location.href='./user_reserve_heb.php?id=$noheb'</script>";
                            }
                            $dateFIN = $sth['DATEFINSEM'];

                            $timestamp = strtotime($dateFIN);
                            $dateFIN = date("d-m-Y", $timestamp);
                        }
                        ?>
                        <!-- Début slide image -->
                        <div id="carousel<?php echo $ID; ?>" class="carousel carousel-dark slide" data-bs-ride="carousel" style="max-width:30em">
                            <div class="carousel-indicators">
                                <?php
                                $dossierphoto = $hebergement['PHOTOHEB'];
                                if ($handle = opendir($dossierphoto)) {
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
                                            echo "<img src='" . $dossierphoto . $file . "' class='d-block w-100 rounded ' class='img-fluid' height='300px'></div>";
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
                        //  echo "Id " . $value['NOHEB'] . "<br>";
                        echo "Description: <br> " . $hebergement['DESCRIHEB'] . "<br>";
                        echo "</div>";

                        $tarifSEM = $hebergement['TARIFSEMHEB'];
                        $montantARRHES = cacul_pourcentage($tarifSEM, 100, 20); // acompte de 20% du prix total
                        ?>
                    </div>
                    <div class="col">


                        <div class='col-9 p-4 border text-end bg-white'>
                            <form action="" method="get">
                                <input type='hidden' name='id' value='<?php echo $noheb ?>' />
                                <label for="date1" class="form-label">Semaine du :</label>
                                <input class="d-inline-block w-50 form-control" type="text" name="dateDEBUT" id="date1" onchange="handler(event);" autocomplete="off" placeholder="Date de Début" value="<?php if (isset($dateDEBUT)) {
                                                                                                                                                                                                                echo $dateDEBUT;
                                                                                                                                                                                                            } ?>" required>
                            </form>
                            <label for="date2" class="form-label">Au </label>
                            <input class="d-inline-block w-50 form-control" type="text" name="dateFIN" id="date2" readonly placeholder="Date de Fin" value="<?php if (isset($dateFIN)) {
                                                                                                                                                                echo $dateFIN;
                                                                                                                                                            } ?>">
                            <form action="" method="post">
                                <br>
                                <br>
                                <label for="NombreOCCUPANT" class="form-label">Nombre d'occupant:</label>
                                <input class="d-inline-block w-50 form-control form-control col-2" id="NombreOCCUPANT" name='NombreOCCUPANT' type="number" min="1" max="<?php echo $hebergement['NBPLACEHEB'] ?>" step="1" oninput="validity.valid||(value='');" required>
                                <br>
                                <p class="text-start mt-5" id="message-attention-date">⚠️ Veuillez choisir une semaine de réservation ⚠️</p>

                        </div>
                        <?php if (isset($_GET['dateDEBUT']) && $_GET['dateDEBUT'] != null) {
                            echo "<script type='text/javascript'>document.getElementById('message-attention-date').style.display = 'none'; </script>";

                        ?>
                            <div class='col-7 p-4 mt-5  text-center bg-white' data-aos="fade-up">
                                <p>Le montant des Arrhes(20%) est de : <br> <span class="h1 p-2 text-center"> <?php echo $montantARRHES ?>€</span></p>
                                <p>Payer maintement ? <input name="checkpayer" class="form-check-input" type="checkbox" value=""> </p>

                            </div>

                            <div class='col-7  mt-3  text-center' data-aos="fade-up">
                                <input type="submit" name="btreserve" class="btn form-control btn-warning" id="" value="Valider">
                            </div>
                        <?php } ?>

                        </form>

                    </div>
                </div>
        </section>

        <?php

        $dateACTIF = [];
        $dateACTIF = GetDatesACTIF($noheb); // tableau de toute les date de la table semaine - les date de réservation

        if (isset($_POST['btreserve'])) {
            //var_dump($_POST);
            if (isset($_GET['dateDEBUT']) && isset($_POST['NombreOCCUPANT'])  && isset($_SESSION['USER'])) {

                $dateDEBUT = date('Y-m-d', strtotime($_GET['dateDEBUT']));
                // $dateFIN = date('Y-m-d', strtotime($_POST['dateFIN']));


                $nbOCCUP = $_POST['NombreOCCUPANT'];
                $USER = $_SESSION['USER'];
                $noheb = $_GET['id'];
                if (isset($_POST['checkpayer'])) {
                    $chekPayer = $_POST['checkpayer'];
                } else {
                    $chekPayer = NULL;
                }
                $codeEtatResa = 1;
                $dateRESA = date("Y-m-d");
                $dateARRHES =  NULL;

                if (isset($_POST['checkpayer'])) {
                    $codeEtatResa = 2;
                    $dateARRHES =   date("Y-m-d");;
                }

                $sth =  SetRESERVATION($USER, $dateDEBUT, $noheb, $codeEtatResa, $dateRESA, $dateARRHES, $montantARRHES, $nbOCCUP, $tarifSEM);
                if ($sth) {
                    $lastID = LastIDinsertRESA()['NORESA'];

                    $value = "L'hébergement a bien été Réservé N°$lastID";
                    echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";
                    echo "<script type='text/javascript'>document.location.href='./user_view_resa.php'</script>";
                }
            }
        }

        ?>

        <script>
            datemax = new Date().toISOString().split("T")[0];

            $(function() {
                dateRange = <?php echo json_encode($dateACTIF); ?>; // met en disponible toute les date - les date deja réservé 
                $('#date1').datepicker({
                    dateFormat: 'dd-mm-yy',
                    beforeShowDay: function(date) {
                        var dateString = jQuery.datepicker.formatDate('yy-mm-dd', date);
                        var day = date.getDay();
                        if (dateRange.indexOf(dateString) != -1) {
                            return [true, "busy"]
                        } else {
                            return [false, "free"]
                        }
                    }
                });
            });

            $('#date1').change(function() {
                this.form.submit();
            });

            $("#date1").keydown(function(e) {
                e.preventDefault();
            }); // permet de mettre en readonly tout en laissant le required


            function submitdate() {
                $('#date1').form.submit();
            }
        </script>
    </main><!-- End #main -->


    <?php
    include_once("component_footer.php");
    include_once("component_message.php");
    ?>
</body>

</html>