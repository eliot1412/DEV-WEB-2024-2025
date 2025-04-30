<?php
session_start();
require('getapikey.php');

$transaction = uniqid();
$montant = $_POST['montant'];
$vendeur = 'MI-1_A'; // À adapter à votre groupe
$retour = "http://localhost/retour_paiement.php?session=" . session_id();

$api_key = getAPIKey($vendeur);
$control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");

$_SESSION['cybank'] = [
    'transaction' => $transaction,
    'montant' => $montant,
    'vendeur' => $vendeur,
    'retour' => $retour,
    'control' => $control,
];
?>

<form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
  <input type="hidden" name="transaction" value="<?= $transaction ?>">
  <input type="hidden" name="montant" value="<?= $montant ?>">
  <input type="hidden" name="vendeur" value="<?= $vendeur ?>">
  <input type="hidden" name="retour" value="<?= $retour ?>">
  <input type="hidden" name="control" value="<?= $control ?>">
  <input type="submit" value="Valider et payer sur CYBank">
</form>
