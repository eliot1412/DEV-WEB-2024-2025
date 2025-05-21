<?php
// paiement.php
session_start();
require('getapikey.php');

if (!isset($_POST['montant'])) {
    die("Erreur : montant non fourni");
}

$transaction = substr(md5(uniqid()), 0, 12);
$montant     = number_format((float)$_POST['montant'], 2, '.', '');
$vendeur     = 'MI-2_D';
$retour      = 'http://localhost/clickjourney_cybank/retour_paiement.php?session=' . session_id();

$api_key = getAPIKey($vendeur);
$control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Paiement</title>
  <link rel="stylesheet" href="../head.css">
  <link rel="stylesheet" href="paiement.css">

</head>
<body>
  <!-- Header -->
  <div class="head">
        <a href="../accueil.php"><img src="../VolcanFly.jpg" alt="Accueil"></a>
        <div class="headers">
            <ul>
                <li><a href="../accueil.php">Accueil</a></li>
                <li><a href="../reg.php">Inscription</a></li>
                <li><a href="../log.php">Connexion</a></li>
                <li><a href="../choice.php">Voyages</a></li>
                <li><a href="../aides.php">Aides</a></li>
            </ul>
        </div>
        <a href="../profile.php"><img src="../pp.jpg" alt="profile"></a>
    </div>


  <!-- Contenu principal -->
  <div class="Centre">

    <div class="titreVoyage">
      <p><?= $_POST['selectedVolcano'] ?></p>
    </div>
    
    <div class="infoVoyage">
      <p> Durée du voyage : <?=$_POST['dates'] ?> jours</p>
      <p> Montant du voyage : <?=$_POST['montant'] ?> €</p>
    </div>

    <form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
      <input type="hidden" name="transaction" value="<?= $transaction ?>">
      <input type="hidden" name="montant"     value="<?= $montant ?>">
      <input type="hidden" name="vendeur"     value="<?= $vendeur ?>">
      <input type="hidden" name="retour"      value="<?= $retour ?>">
      <input type="hidden" name="control"     value="<?= $control ?>">
      <input class="button" type="submit" value="Payer avec CYBank">
    </form>
  </div>

 
  <!-- Footer -->
  <div class="tail">
    <a href="../accueil.php">
        <p>Accueil</p>
    </a>
    <p>| Destinations | Offres spéciales | Contact | À propos</p>
</div>
</body>
</html>

<?php
