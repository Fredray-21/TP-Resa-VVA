<?php
require_once('component_functions.php');
$link = connectDB();

if (isset($_POST['btndeconnexion'])) {
  session_unset();
  $value = "Vous avez bien été déconnecter";
  echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";
  echo "<script type='text/javascript'>document.location.href='./index.php'</script>";
}

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['btnconnexion'])) {
  $email =  $_POST['email'];
  $user =  $_POST['email'];
  $password =  $_POST['password'];
  //$password = hash("sha256", $password.$email); a faire a la fin des test 

  $req = "SELECT * FROM compte WHERE (ADRMAILCPTE = ? OR USER = ?) and MDP = ?";
  $sth = $link->prepare($req);
  $sth->execute([$email, $user, $password]);
  if (!$sth) {
    echo $link->errorInfo();
    return null;
  } else {
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    if ($row) { // si je trouve un user alors met le type et l'user en session 

      $_SESSION['type'] = $row['TYPECOMPTE'];
      $_SESSION['USER'] = $row['USER'];

      if ($row['TYPECOMPTE'] == "VAC") {  // si l'user est un simple vancier met en session son nom et prénom pour l'affichage
        $_SESSION['PRENOMCPTE'] = $row['PRENOMCPTE'];
        $_SESSION['NOMCPTE'] = $row['NOMCPTE'];
      }


      $idUSER = $_SESSION['USER']; // afin de faire mon ficher log-connexion
      $tabuser = GetNameWhereUser($idUSER);  // same
      Log_connexion($idUSER, $tabuser);


      header('Location:index.php');
    } else { // si aucune correspondance trouver alors

      $value = " L'identifiant et/ou le mot de passe est incorrect.";
      setcookie("message", $value);
      header('Location:index.php?e=1');
    }
  }
}


if (empty($_SESSION['USER'])) { // si aucun user trouver alors ecrit error dans le paragraphe et remet le boutton de connexion
?>
  <button type="button" class="get-started-btn" data-bs-toggle="modal" data-bs-target="#modalLog">
    SIGN IN
  </button>
<?php
} else { // sinon
  if ($_SESSION['type'] == "ADM") { // si admin  ecrit Administrateur

    echo "<span style='color:#fff;  text-decoration: underline; text-decoration-color:#ffc451;' class='nav-link'> ADMINISTRATEUR </span>";
  } elseif ($_SESSION['type'] == "LOC") { // si gestionnaire écrit service gestion
    echo "<span style='color:#fff; text-decoration: underline; text-decoration-color:#ffc451' class='nav-link'> SERVICE LOCATION </span>";
  } else { // si simple vacancier alors écrit son nom et prénom
    echo "<span style='color:#fff; text-decoration: underline; text-decoration-color:#ffc451' class='nav-link'>" . mb_strtoupper(utf8_encode($_SESSION['PRENOMCPTE'])) . " " . mb_strtoupper(utf8_encode($_SESSION['NOMCPTE'])) . "</span>";
  }
  echo "<form action='' method='post'>"; // puis affiche le boutton de déconnexion
  echo "<button type='button' class='get-started-btn' data-bs-toggle='modal' data-bs-target='#modalout'>SIGN OUT</button>";
  echo "</form>";
}



?>