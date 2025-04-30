<?php
session_start();
require('getapikey.php');

$transaction = $_GET['transaction'];
$montant = $_GET['montant'];
$vendeur = $_GET['vendeur'];
$statut = $_GET['status'];
$control_recu = $_GET['control'];

$api_key = getAPIKey($vendeur);
$control_attendu = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $statut . "#");

if ($control_attendu !== $control_recu) {
    echo "Erreur de validation. ❌";
    exit;
}

if ($statut === "accepted") {
    echo "<h2>Paiement accepté ✅</h2>";
    // Ici, enregistrement de la transaction dans un fichier
    $data = [
        "user" => $_SESSION['user'] ?? "unknown",
        "transaction" => $transaction,
        "montant" => $montant,
        "date" => date("Y-m-d H:i:s")
    ];
    file_put_contents(__DIR__ . "/data/transactions.json", json_encode($data, JSON_PRETTY_PRINT));
} else {
    echo "<h2>Paiement refusé ❌</h2>";
    echo '<a href="recap.php">Retour au récapitulatif</a>';
}
?>
