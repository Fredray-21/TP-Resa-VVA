<?php
require_once('component_functions.php');
$link = connectDB();

if (isset($_POST['btndeconnexion'])) { // permet de suprimé toute les session sauf la session message
  session_unset();
  $value = "Vous avez bien été déconnecter";
  echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";
  echo "<script type='text/javascript'>document.location.href='./index.php'</script>";

}



if ($_SESSION['type'] == "ADM") { // si un admin est register
  echo "<span style='color:#fff; text-decoration: underline; text-decoration-color:#ffc451' class='nav-link'> ADMINISTRATEUR </span>";
} elseif ($_SESSION['type'] == "LOC") { // si un gestionnaire est register
  echo "<span style='color:#fff; text-decoration: underline; text-decoration-color:#ffc451 ' class='nav-link'> SERVICE LOCATION </span>";
} else { // si un vacencier est register
  echo "<span style='color:#fff; text-decoration: underline; text-decoration-color:#ffc451' class='nav-link'>" . utf8_encode(strtoupper($_SESSION['PRENOMCPTE'])) . " " . utf8_encode(strtoupper($_SESSION['NOMCPTE'])) . "</span>";
}
echo "<form action='' method='post'>";
echo "<button type='button' class='get-started-btn' data-bs-toggle='modal' data-bs-target='#modalout'>SIGN OUT</button>";
echo "</form>";
