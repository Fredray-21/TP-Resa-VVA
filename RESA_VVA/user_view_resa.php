<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Mes Réservations</title>
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
                    <h2>Mes Réservations</h2>
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li>Mes Réservations</li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- End Breadcrumbs -->

        <?php
        // var_dump($_SESSION);
        if (isset($_SESSION['USER'])) {
            $USER = $_SESSION['USER'];
            $reservation = GetRESAwhereUSER($USER);
        } else {
            $reservation = false;
        }

        ?>

        <section class="inner-page" style="margin-bottom: 12%; ">
            <div class="container ">
                <table class="table table-bordered table-striped  " style="background-color:white;" data-aos='fade-right' data-aos-duration='700'>
                    <thead>
                        <td class="text-left" colspan='8'><span> Réservations <span style="color:green; font-size:1.3em;">Actifs</span> </span></td>
                        <tr class="text-center">
                            <td>Annulée</td>
                            <td>Numéro</td>
                            <td>Etat</td>
                            <td>Semaine</td>
                            <td>Nombre d'occupant</td>
                            <td>Etat des ARRHES</td>
                            <td>Montant ARRHES (20%)</td>
                            <td>Tarif/Semaine</td>
                            <!-- <td align="right"><b>Total</b></td> -->
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        if (!$reservation) {
                            echo "<td colspan='8' style='color:red'>Vous n'avez aucune réservation ici</td>";
                        } else {
                            $bool = false;
                            foreach ($reservation as $key => $value) {
                                if ($value['CODEETATRESA'] !=  5 and $value['CODEETATRESA'] != 6) {
                                    $bool = true;
                                    $id = $value['NORESA'];
                                    $NOHEB = $value['NOHEB'];
                                    $tsamp = strtotime($value['DATEDEBSEM']);
                                    $dateDebSEM = date("d-m-Y", $tsamp);

                                    $sth = GetDatesENDWhereDATEdeb($value['DATEDEBSEM']);
                                    $tsamp = strtotime($sth['DATEFINSEM']);
                                    $dateFinSEM = date("d-m-Y", $tsamp);

                                    $NbOccupant = $value['NBOCCUPANT'];
                                    $codeEtatResa = $value['CODEETATRESA'];

                                    $montantARRHES = $value['MONTANTARRHES'];
                                    $tarifSEM = $value['TARIFSEMRESA'];
                                    $nomETAT = utf8_encode(GetNomEtatResa($id)['NOMETATRESA']);

                                    echo "<td><button type='button' class='btn btn-danger btn-md' data-bs-toggle='modal' data-bs-target='#delete$id' ><i class='far fa-trash-alt'></i></button></td>";
                                    echo "<td>N°$id</td>";
                                    echo "<td>$nomETAT</td>";
                                    echo "<td>Du $dateDebSEM <br> Au $dateFinSEM</td>";
                                    echo "<td >$NbOccupant</td>";

                                    if ($codeEtatResa > 1) {
                                        $EtatARRHES = "Payée";
                                        echo "<td style='color:Green'>$EtatARRHES</td>";
                                    } else {
                                        $EtatARRHES = "Non Payée";
                                        echo "<td style='color:Red'>$EtatARRHES ";
                                        echo " <button type='button' class='btn btn-sm btn-secondary' data-bs-toggle='modal' data-bs-target='#payer$id' >Payer maintenant</button></td>";
                                    }
                                    echo "<td>$montantARRHES €</td>";
                                    echo "<td>$tarifSEM €</td><tr>";
                        ?>
                                    <div class="modal fade" id="payer<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirmez vous le paiement des ARRHES ?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>D'un montant de <b><?php echo $montantARRHES ?> €</b></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Non</button>
                                                    <form action="" method="post">
                                                        <button type="submit" class="btn btn-success" name="btnPayerARRHES<?php echo $id ?>">Oui</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirmez vous l'annulation ?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Annulation de l'hebergement: </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Non</button>
                                                    <form action="" method="post">
                                                        <button type="submit" class="btn btn-success" name="btnDelete<?php echo $id ?>">Oui</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                    if (isset($_POST['btnPayerARRHES' . $id])) {             //      A FAIRE IL Y A KA FONCTION DANS LE FILE

                                        $date = $value['DATEDEBSEM'];
                                        SetPAYEMENT($date, $USER, $NOHEB);
                                        $value = "Les ARRHES ont bien été payée";
                                        echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";
                                        echo "<script type='text/javascript'>document.location.href='./user_view_resa.php'</script>";
                                    }
                                    if (isset($_POST['btnDelete' . $id])) {             //      A FAIRE IL Y A KA FONCTION DANS LE FILE

                                        $sthh = AnnuleRESA($id);
                                        if ($sthh) {
                                            $value = "La réservation N°$id a bien été Annulée";
                                            echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";
                                            echo "<script type='text/javascript'>document.location.href='./user_view_resa.php'</script>";
                                        }
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


                <table class="table table-bordered table-striped mt-5 mb-5" style="background-color:white;" data-aos='fade-left' data-aos-duration='700'>
                    <thead>
                        <td class="text-left" colspan='7'><span> Réservations <span style="font-size:1.3em;"><span style="color:Blue;">Terminé</span>/<span style="color:Red;">Annulé</span> </span></td>
                        <tr class="text-center">

                            <td>Numéro</td>
                            <td>Etat</td>
                            <td>Semaine</td>
                            <td>Nombre d'occupant</td>
                            <td>Etat des ARRHES</td>
                            <td>Montant ARRHES</td>
                            <td>Tarif/Semaine</td>
                            <!-- <td align="right"><b>Total</b></td> -->
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        if (!$reservation) {
                            echo "<td colspan='8' style='color:red'>Vous n'avez aucune réservation ici</td>";
                        } else {
                            $bool2 = false;
                            foreach ($reservation as $key => $value) {
                                if ($value['CODEETATRESA'] ==  5 or $value['CODEETATRESA'] == 6) {
                                    $bool2 = true;
                                    $id = $value['NORESA'];
                                    $NOHEB = $value['NOHEB'];
                                    $tsamp = strtotime($value['DATEDEBSEM']);
                                    $dateDebSEM = date("d-m-Y", $tsamp);

                                    $sth = GetDatesENDWhereDATEdeb($value['DATEDEBSEM']);
                                    $tsamp = strtotime($sth['DATEFINSEM']);
                                    $dateFinSEM = date("d-m-Y", $tsamp);

                                    $NbOccupant = $value['NBOCCUPANT'];
                                    $codeEtatResa = $value['CODEETATRESA'];

                                    $montantARRHES = $value['MONTANTARRHES'];
                                    $tarifSEM = $value['TARIFSEMRESA'];
                                    $nomETAT = utf8_encode(GetNomEtatResa($id)['NOMETATRESA']);

                                    $dateARRHES = $value['DATEARRHES'];

                                    echo "<td>N°$id</td>";
                                    if ($nomETAT === "Annulée") {
                                        echo "<td><span style='color:Red;'>$nomETAT</span></td>";
                                    } else {
                                        echo "<td><span style='color:Blue;'>$nomETAT</span></td>";
                                    }
                                    echo "<td>Du $dateDebSEM <br>Au $dateFinSEM</td>";
                                    echo "<td >$NbOccupant</td>";

                                    if ($dateARRHES) {
                                        $EtatARRHES = "Payée";
                                        echo "<td style='color:Green'>$EtatARRHES</td>";
                                    } else {
                                        $EtatARRHES = "Non Payée";
                                        echo "<td style='color:Red'>$EtatARRHES ";
                                    }
                                    echo "<td>$montantARRHES €</td>";
                                    echo "<td>$tarifSEM €</td><tr>";
                                }
                            } // fin while
                            if (!$bool2) {
                                echo "<td colspan='7' style='color:red'>Vous n'avez aucune réservation ici</td>";
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </section>
    </main><!-- End #main -->
    <?php
    include_once("component_footer.php");
    include_once("component_message.php");
    ?>
</body>

</html>