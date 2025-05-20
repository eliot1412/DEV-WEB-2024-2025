<?php
session_start();
require('getapikey.php');

$transaction = $_GET['transaction'] ?? '';
$montant = $_GET['montant'] ?? '';
$vendeur = $_GET['vendeur'] ?? '';
$statut = $_GET['status'] ?? '';
$control_recu = $_GET['control'] ?? '';

$api_key = getAPIKey($vendeur);
$control_attendu = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $statut . "#");

if ($control_attendu !== $control_recu) {
    echo "❌ Erreur de validation de la réponse CYBank";
    exit;
}

if ($statut === "accepted") {
    echo "<h2>Paiement accepté ✅</h2>";

    $data = [
        "user" => $_SESSION['user'] ?? "anonyme",
        "transaction" => $transaction,
        "montant" => $montant,
        "vendeur" => $vendeur,
        "date" => date("Y-m-d H:i:s"),
        "voyage" => $_SESSION['voyage'] ?? "non spécifié"
    ];


    $transactionFile = "../data/transactions.json";
    $transactions = [];

    if (file_exists($transactionFile)) {
        $transactions = json_decode(file_get_contents($transactionFile), true) ?? [];
    }

    $transactions[] = $data;
    file_put_contents($transactionFile, json_encode($transactions, JSON_PRETTY_PRINT));

    echo '<p>Transaction enregistrée avec succès.</p>';
    echo '<a href="../profile.php">Voir mes voyages</a>';

    $selectionFile ='../selections.json';
    $newSelection=json_decode($_SESSION['jNewSelection']);

    $allSelections = [];
    if (file_exists($selectionFile)) {
    $allSelections = json_decode(file_get_contents($selectionFile), true);
    }

    $allSelections[] = $newSelection;
    file_put_contents($selectionFile, json_encode($allSelections, JSON_PRETTY_PRINT));



} else {
    echo "<h2>Paiement refusé ❌</h2>";
    echo '<a href="javascript:history.go(-2)">Retour à la page paiement</a>';
}
?>
