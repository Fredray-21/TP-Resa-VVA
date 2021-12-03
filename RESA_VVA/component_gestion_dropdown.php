<?php 
if (isset($_SESSION['type'])) {
  if ($_SESSION['type'] == "ADM" || $_SESSION['type'] == "LOC") { ?>
    <li class="dropdown"><a href="#"><span style="color:cyan">Espace Gestion</span> <i class="bi bi-chevron-down"></i></a>
      <ul>
        <li><a href="./gestion_view_resa.php">Voir les Réservation</a></li>
        <li><a href="./gestion_view_heb.php">Voir les hebergements</a></li>
        <li><a href="./gestion_add_loc.php">Ajouter un hebergement</a></li>

      </ul>
    </li>
<?php };
} ?>