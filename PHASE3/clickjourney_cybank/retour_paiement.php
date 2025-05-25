<?php
session_start();
require('getapikey.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Paiement</title>
  <link rel="stylesheet" href="../head.css">
  <link rel="stylesheet" href="paiement.css">
  <script src="../js/theme.js" defer=""></script>
</head>
<body>

  <!-- HEADER -->
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

  <!-- CONTENU CENTRE -->
  <div class="Centre">
    <?php
    $transaction = $_GET['transaction'] ?? '';
    $montant = $_GET['montant'] ?? '';
    $vendeur = $_GET['vendeur'] ?? '';
    $statut = $_GET['status'] ?? '';
    $control_recu = $_GET['control'] ?? '';

    $api_key = getAPIKey($vendeur);
    $control_attendu = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $statut . "#");

    if ($control_attendu !== $control_recu) {
        echo "<h2>❌ Erreur de validation de la réponse CYBank</h2>";
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
        echo '<a class="bouton-retour" href="../profile.php">Voir mes voyages</a>';

        $selectionFile = '../selections.json';
        $newSelection = json_decode($_SESSION['jNewSelection']);

        $allSelections = [];
        if (file_exists($selectionFile)) {
            $allSelections = json_decode(file_get_contents($selectionFile), true);
        }

        $allSelections[] = $newSelection;
        file_put_contents($selectionFile, json_encode($allSelections, JSON_PRETTY_PRINT));
    } else {
        echo "<h2>Paiement refusé ❌</h2>";
        echo '<a class="bouton-retour" href="javascript:history.go(-2)">Retour à la page paiement</a>';
    }
    ?>
  </div>

  <!-- FOOTER -->
  <div class="tail">
    <a href="../accueil.php"><p>Accueil</p></a>
    <p>| Destinations | Offres spéciales | Contact | À propos</p>
  </div>

</body>
</html>
