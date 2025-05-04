<?php
session_start();
require('getapikey.php');

if (!isset($_POST['montant'])) {
    die("Erreur : montant non fourni");
}

$transaction = substr(md5(uniqid()), 0, 12); 
$montant = number_format((float)$_POST['montant'], 2, '.', '');

$vendeur = 'MI-2_D'; 
$retour = 'http://localhost/clickjourney_cybank/retour_paiement.php?session='.session_id();


$api_key = getAPIKey($vendeur);
if ($api_key === 'zzzz') {
    die("Erreur : vendeur invalide");
}


$control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");

?>

<form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
  <input type="hidden" name="transaction" value="<?= $transaction ?>">
  <input type="hidden" name="montant" value="<?= $montant ?>">
  <input type="hidden" name="vendeur" value="<?= $vendeur ?>">
  <input type="hidden" name="retour" value="<?= $retour ?>">
  <input type="hidden" name="control" value="<?= $control ?>">
  <input type="submit" value="Payer avec CYBank">
</form>

