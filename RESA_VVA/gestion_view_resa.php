<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Voir les réservations</title>
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

    <!--Jquery date picker -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css">

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

    $NbResa = getNbAllResa()['NbResa'];

    $min = (($pageCourante - 1) * $parPage);
    $max = $parPage;
    $nbPage = ceil($NbResa / $parPage);


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
                    <h2>Voir les réservations</h2>
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li>Voir les réservations</li>
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
                            $filtreActuel = $filtreActuel . "Hebergement= N°$value[1],";
                        } elseif ($value[0] == "dateDEB" && !IsNullOrEmptyString($value[1])) {
                            $filtreActuel = $filtreActuel . "Date du début= $value[1],";
                        } else {
                            $filtreActuel = null;
                        }
                    }
                }
                if (isset($filtreActuel)) {
                    $filtreActuel = substr($filtreActuel, 0, -1);
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
                                    <label for="SelectHeb">Pour un Hebergement spécifique:</label>
                                    <select name="heb" id="SelectHeb" class="form-control ">
                                        <option value='' disabled selected hidden>Veuillez selectionné</option>
                                        <?php
                                        $AllHEB = getAllheb();
                                        if ($AllHEB) {
                                            echo "<option value='' selected>Pour tout les hebergements</option>";
                                            foreach ($AllHEB as $key => $value) {

                                                $name = utf8_encode($value['NOMHEB']);
                                                $NOHEB = $value['NOHEB'];
                                                if ($HEBSelected == $NOHEB) {
                                                    echo "<option value='$NOHEB' selected>N°$NOHEB - $name</option>";
                                                } else {
                                                    echo "<option value='$NOHEB'>N°$NOHEB - $name</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>


                            <div class="col m-3 ">
                                <div class='col p-4 border text-start'>
                                    <form action="" method="get">
                                        <label for="date1" class="form-label">Semaine du :</label>
                                        <input class="d-inline-block form-control" type="text" name="dateDEBUT" id="date1" onchange="date();" autocomplete="off" placeholder="Date de Début" value="" required>
                                    </form>
                                    <label for="date2" class="form-label">Au </label>
                                    <input class="d-inline-block form-control" type="text" name="dateFIN" id="date2" readonly placeholder="Date de Fin" value="">
                                    <button type='button' class='btn btn-danger mt-3' onclick="clearText()">Clear</button>
                                </div>

                            </div>

                            <br>
                            <div id="form-btn" class="d-flex justify-content-lg-around">
                                <form action="" method="get" name='filter'>
                                    <input type="hidden" name="filter" id="filter" value="">
                                    <input type="submit" onclick="Filter()" class="btn btn-success" value="Valider le filtre">
                                </form>

                                <a href="gestion_view_resa.php" class="btn btn-danger">Supprimé tout les filtres</a>
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


        <section class="inner-page">
            <?php
            // début de la vérification des filtre
            $reservations = null; // initialise a null les herbergment
            if (isset($_GET['filter']) && $_GET['filter'] != null) {  // si get filter et différent de null alors
                // fonction filter avec en paramètre le "tableua de filtre"
                $reservations = GetResaFilterPagination($_GET['filter'], $min, $max);
                if (!$reservations) {
                    $value = "Aucun hebergement n'est disponible avec ce filtre";
                    echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";
                    echo "<script type='text/javascript'>document.location.href='./gestion_view_resa.php?e=1'</script>";
                    // met en message l'erreur et pas en simple print
                    // echo "Aucun hebergement n'est disponible avec c'est filtre";
                }
            } else {
                $reservations = GetResaFilterPagination(null, $min, $max); // recupère tout les heberment
                if (!$reservations) {
                    $value = "Aucun hebergement n'est disponible";
                    echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";
                    echo "<script type='text/javascript'>document.location.href='./index.php?e=1'</script>";
                }
            }

            if (isset($_GET['filter']) && $_GET['filter'] == null) {
                $value = "Filtre Invalide";
                echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";
                echo "<script type='text/javascript'>document.location.href='./gestion_view_resa.php?e=1'</script>";
            }
            ?>

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
                            <td>Modifier l'état de la réservation</td>
                            <td>Numéro réservation</td>
                            <td>User</td>
                            <td>Semaine de réservation</td>
                            <td>Numéro hebergement</td>
                            <td>Etat reservation</td>
                            <td>Date Réservation</td>
                            <td>Date payer arrhes</td>
                            <td>montant arrhes</td>
                            <td>nombre occupant</td>
                            <td>Tarif Semaine</td>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        $bool = false;
                        if (!$reservations) {
                            echo "<td colspan='14' style='color:red'>Vous n'avez aucune réservation ici</td>";
                            if (isset($_GET['p']) && $_GET['p'] > 1) { // si il n'y a pas d'hebermgent sur cette page alors retire 1 page
                                $p = $_GET['p'] - 1;
                                echo "<script type='text/javascript'>document.location.href='./gestion_view_heb.php?p=$p'</script>";
                            }
                            if (isset($_GET['p']) && $_GET['p'] == 0) { // si il n'y a pas d'hebermgent sur cette page alors retire 1 page
                                echo "<script type='text/javascript'>document.location.href='./gestion_view_heb.php'</script>";
                            }
                        } else {
                            echo "<script type='text/javascript'>document.cookie = 'message= ; expires = Thu, 01 Jan 1970 00:00:00 GMT'</script>";
                            echo "<script type='text/javascript'>document.getElementById('message').style.display = 'none';</script>";

                            foreach ($reservations as $key => $value) {
                                $bool = true;
                                $NORESA = $value['NORESA'];
                                $USER = $value['USER'];
                                $DATEDEBSEM = $value['DATEDEBSEM'];
                                $timestamp = strtotime($DATEDEBSEM);
                                $DATEDEBSEM = date("d-m-Y", $timestamp);

                                $NOHEB = $value['NOHEB'];
                                $CODEETATRESA = $value['CODEETATRESA'];
                                $DATERESA = $value['DATERESA'];
                                $DATEARRHES = $value['DATEARRHES'];
                                $timestamp = strtotime($DATEARRHES);
                                $DATEARRHES = date("d-m-Y", $timestamp);

                                $MONTANTARRHES = $value['MONTANTARRHES'];
                                $NBOCCUPANT = $value['NBOCCUPANT'];
                                $TARIFSEMRESA = $value['TARIFSEMRESA'];
                                if (isset($_GET['p'])) {
                                    $pageactuell = $_GET['p'];
                                } else {
                                    $pageactuell = 1;
                                }

                                $DATEFINSEM = GetDatesENDWhereDATEdeb($value['DATEDEBSEM'])['DATEFINSEM'];
                                $timestamp = strtotime($DATEFINSEM);
                                $finSemaine = date("d-m-Y", $timestamp);
                                $ETAT = utf8_encode(GetNomEtatResa($NORESA)['NOMETATRESA']);
                                if (strtotime($DATEFINSEM) >= strtotime("-1 day")) {
                                    echo "<td><button type='button' class='btn btn-warning btn-md' data-bs-toggle='modal' data-bs-target='#update$NORESA' ><i class='fas fa-edit'></i></button></td>";
                                } else {
                                    echo "<td style='color:#EDB801'>Date dépassé</td>";
                                }


                                echo "<td>N°$NORESA</td>";
                                echo "<td>$USER</td>";
                                echo "<td>Du $DATEDEBSEM <br> Au $finSemaine</td>";
                                echo "<td>N°$NOHEB</td>";
                                echo "<td style='color:#EDB801'>$ETAT</td>";
                                echo "<td>$DATERESA</td>";
                                echo "<td>$DATEARRHES</td>";
                                echo "<td>$MONTANTARRHES €</td>";
                                echo "<td>$NBOCCUPANT</td>";
                                echo "<td>$TARIFSEMRESA €</td></tr>";

                        ?>
                                <div class="modal fade" id="update<?php echo $NORESA; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modification de l'état de la réservation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post">

                                                    <select name="EtatResa" id="" class="form-control">
                                                        <?php
                                                        $AlletatResa = GetALLEtatResa();
                                                        foreach ($AlletatResa as $kay => $value) {
                                                            $NomEtat = utf8_encode($value['NOMETATRESA']);
                                                            $CodeEtat =  $value['CODEETATRESA'];
                                                            if ($CodeEtat == $CODEETATRESA) {
                                                                echo "<option value='$CodeEtat' selected>$NomEtat</option>";
                                                            } else {
                                                                echo "<option value='$CodeEtat'>$NomEtat</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermé</button>
                                                <button type="submit" class="btn btn-success" name="btnUpdateEtat<?php echo $NORESA ?>">Validé</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                                if (isset($_POST['btnUpdateEtat' . $NORESA])) {             //      A FAIRE IL Y A KA FONCTION DANS LE FILE
                                    $codeEtat = $_POST['EtatResa'];
                                    $sthh = UpdateEtatResa($NORESA, $codeEtat);
                                    if ($sthh) {
                                        $value = "L'état de  la Réservation N°$NORESA a bien été Modifier";
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


    <?php
    $allDATE = GetALLDates();
    $arrayALLDATE = [];
    if (isset($allDATE)) {
        foreach ($allDATE as $key => $value) {
            array_push($arrayALLDATE, $value['DATEDEBSEM']);
        }
    }
    ?>

    <script>
        $(function() {
            dateRange = <?php echo json_encode($arrayALLDATE); ?>;
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

        function addDaysToDate(date, days) {
            var res = new Date(date);
            res.setDate(res.getDate() + days);
            return res;
        }

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();
            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;
            return [day, month, year].join('-');
        }

        function clearText() {
            document.getElementById('date1').value = '';
            document.getElementById('date2').value = '';
        }

        function date() {
            var input = document.getElementById("date1").value;
            const words = input.split('-');
            jour = parseInt(words[0]);
            mois = parseInt(words[1]) - 1;
            anne = parseInt(words[2]);
            var tmpDate = new Date(anne, mois, jour);
            dateF = addDaysToDate(tmpDate, 7);
            DateFin = formatDate(dateF);
            document.getElementById("date2").value = DateFin;
        }


        function valeur_select(id) { // retourne la valeur d'un select
            select = document.getElementById(id);
            choice = select.selectedIndex;
            valeur = select.options[choice].value;
            return valeur;
        }

        function Filter() { // retourne une  chaine string avec toute les valeur du formulaire a metre en get
            if (document.getElementById("SelectHEb") != "") {
                heb = valeur_select("SelectHeb");
            }

            dateDeb = document.getElementById("date1").value;
            filter = "heb=" + heb + ",dateDEB=" + dateDeb;
            //alert(filter);
            document.getElementById('filter').value = filter; // met la valeur d'an un input type hidden puis submit le formuaire
        }

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