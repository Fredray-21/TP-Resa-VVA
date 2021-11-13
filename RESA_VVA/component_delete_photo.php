<?php
$dossierphoto = $_GET['photo'];
$fileGET = $_GET['f'];
$ID = $_GET['id'];
$page = $_GET['p'];

$i = 0;
if ($handle = opendir($dossierphoto)) {
    while (($file = readdir($handle)) !== false) {
        if (!in_array($file, array('.', '..')) && !is_dir($dossierphoto . $file)) {
            $i++;
        }
    }
}


if ($i != 1) {
    $photo = $dossierphoto.$fileGET;
    array_map('unlink', glob($photo));

    $value = "la photo à bien été supprimé";
    echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";

    $redirection = "gestion_edit_heb.php?id=" . $_GET['id'] . "&p=" . $_GET['p'] . "";
    echo "<script type='text/javascript'>document.location.href='./" . $redirection . "'</script>";
} else {
    $value = "Suppression impossible, Il doit y avoir au minimum une photo";
    echo "<script type='text/javascript'>document.cookie =\"message=$value\";</script>";

    $redirection = "gestion_edit_heb.php?id=" . $_GET['id'] . "&p=" . $_GET['p'] . "&e=1";
    echo "<script type='text/javascript'>document.location.href='./" . $redirection . "'</script>";

}
