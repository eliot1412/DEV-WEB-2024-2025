<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: log.php');
    exit();
}

// Chargement des données des volcans
$volcanoData = json_decode(file_get_contents(__DIR__ . '/volcanoes.json'), true);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Récupération des paramètres
    $id         = $_GET['id']         ?? null;
    $transport  = $_GET['transport']  ?? '';
    $hotel      = $_GET['hotel']      ?? '';
    $jours      = (int)($_GET['jours'] ?? 1);
    $people     = $_GET['people']     ?? 'one';
    $activities = $_GET['activities'] ?? [];
    $restaurant = $_GET['restaurant'] ?? '';
    $car        = $_GET['car']        ?? 'none';

    // Normalisation du tableau d'activités
    if (!is_array($activities) && $activities !== '') {
        $activities = explode(',', $activities);
    } elseif ($activities === '') {
        $activities = [];
    }

    // Vérification du volcan sélectionné
    if ($id !== null && isset($volcanoData[$id])) {
        $selectedVolcano = $volcanoData[$id];

        // Prix de base
        $prixBase = (int) filter_var($selectedVolcano['price'], FILTER_SANITIZE_NUMBER_INT);

        // Tarifs (identiques à price.js)
        $hotelPrices      = ['standard' => 50, 'confort' => 100, 'luxe' => 180];
        $transportPrices  = ['avion' => 200, 'train' => 120, 'bus' => 80, 'car' => 60];
        $activityPrices   = ['randonnée' => 50, 'visite-musee' => 30, 'spa' => 70];
        $restaurantPrices = ['local' => 0, 'gastro' => 40];
        $carPricesPerDay  = ['none' => 0, 'citadine' => 25, 'suv' => 45];

        // Calcul du total
        $total = $prixBase;
        $total += ($hotelPrices[$hotel]       ?? 0) * $jours;
        $total += ($transportPrices[$transport] ?? 0);
        $total += ($restaurantPrices[$restaurant] ?? 0);
        $total += ($carPricesPerDay[$car]     ?? 0) * $jours;
        foreach ($activities as $act) {
            $total += $activityPrices[$act] ?? 0;
        }

        // Préparation de l'enregistrement en session
        $newSelection = [
            'user_email' => $_SESSION['email'],
            'volcano'    => $selectedVolcano['name'],
            'transport'  => $transport,
            'hotel'      => $hotel,
            'jours'      => $jours,
            'car'        => $car,
            'restaurant' => $restaurant,
            'activities' => $activities,
            'total'      => $total,
            'timestamp'  => date('Y-m-d H:i:s')
        ];
    } else {
        die("Erreur : volcan non trouvé ou ID manquant.");
    }
} else {
    die("Méthode non autorisée.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Récapitulatif de votre voyage</title>
    <link rel="stylesheet" href="head.css">
    <link rel="stylesheet" href="choice.css">
    <link rel="stylesheet" href="recap.css">
    <script src="js/theme.js" defer></script>
</head>
<body>
    <div class="head">
        <ul><a href="accueil.php"><img src="VolcanFly.jpg" alt="Accueil"></a></ul>
        <div class="headers">
            <ul>
                <li><a href="accueil.php">Accueil</a></li>
                <li><a href="reg.php">Inscription</a></li>
                <li><a href="log.php">Connexion</a></li>
                <li><a href="choice.php">Voyages</a></li>
                <li><a href="aides.php">Aides</a></li>
                <li><a href="panier.php">Panier</a></li>
            </ul>
        </div>
        <a href="profile.php"><img src="pp.jpg" alt="profile"></a>
    </div>

   <div class="recap-container">
    <h1>Récapitulatif de votre voyage</h1>
    <div class="recap-item"><strong>Volcan sélectionné :</strong> <?= htmlspecialchars($selectedVolcano['name']) ?></div>
    <div class="recap-item"><strong>Transport choisi :</strong> <?= htmlspecialchars($transport) ?></div>
    <div class="recap-item"><strong>Hébergement :</strong> <?= htmlspecialchars($hotel) ?></div>
    <div class="recap-item"><strong>Durée :</strong> <?= $jours ?> jour(s)</div>
    <div class="recap-item"><strong>Location de voiture :</strong> <?= htmlspecialchars($car) ?></div>
    <div class="recap-item"><strong>Restaurant :</strong> <?= htmlspecialchars($restaurant) ?></div>

    <?php if (!empty($activities)): ?>
        <div class="recap-item">
            <strong>🎯 Activités sélectionnées :</strong>
            <ul>
                <?php foreach ($activities as $act): ?>
                    <li><?= htmlspecialchars($act) ?> (<?= $activityPrices[$act] ?? 0 ?> €)</li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="recap-item">
        <strong>💰 Prix total estimé :</strong>
        <span style="color: gold; font-size: 1.3em;"><?= $total ?> €</span>
    </div>

    <div class="recap-item">📌 Sauvegardé le : <?= date('d/m/Y à H:i') ?></div>
    <div style="display: flex; justify-content: space-between; margin-top: 30px;">
        <a href="javascript:history.go(-1)" style="text-decoration: none;">
            <button type="button">← Retour</button>
        </a>
        <form action="clickjourney_cybank/paiement.php" method="POST">
            <input type="hidden" name="selectedVolcano" value="<?= htmlspecialchars($selectedVolcano['name']) ?>">
            <input type="hidden" name="dates" value="<?= $jours ?>">
            <input type="hidden" name="voyage_id" value="<?= $id ?>">
            <input type="hidden" name="montant" value="<?= $total ?>">
            <input type="submit" value="Procéder au paiement">
        </form>
    </div>

</div>

<?php
// Sauvegarde en session du panier
$_SESSION['jNewSelection'] = json_encode($newSelection);
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}
$_SESSION['panier'][] = $newSelection;
?>

</body>
</html>
