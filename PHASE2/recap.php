<?php
$volcanoData = json_decode(file_get_contents(__DIR__ . '/volcanoes.json'), true);
$selectionFile = __DIR__ . '/selections.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $transport = $_POST['transport'] ?? '';
    $hotel = $_POST['hotel'] ?? '';
    $jours = (int) ($_POST['jours'] ?? 1);
    $people = $_POST['people'] ?? 'one';
    $activities = $_POST['activities'] ?? [];
    $restaurant = $_POST['restaurant'] ?? '';
    $car = $_POST['car'] ?? 'none';

    if ($id !== null && isset($volcanoData[$id])) {
        $selectedVolcano = $volcanoData[$id];

        
        $prixBase = (int) $selectedVolcano['price'];

        $hotelPrices = [
            'standard' => 50,
            'confort' => 100,
            'luxe' => 180
        ];

        $transportPrices = [
            'avion' => 200,
            'train' => 120,
            'bus' => 80,
            'car' => 60
        ];

        $activityPrices = [
            'randonnée' => 50,
            'visite-musee' => 30,
            'spa' => 70
        ];

        $restaurantPrices = [
            'local' => 0,
            'gastro' => 40
        ];

        $carPricesPerDay = [
            'none' => 0,
            'citadine' => 25,
            'suv' => 45
        ];

        // Calcul du prix
        $total = $prixBase;
        $total += ($hotelPrices[$hotel] ?? 0) * $jours;
        $total += $transportPrices[$transport] ?? 0;
        $total += $restaurantPrices[$restaurant] ?? 0;
        $total += ($carPricesPerDay[$car] ?? 0) * $jours;

        foreach ($activities as $act) {
            $total += $activityPrices[$act] ?? 0;
        }

        
        $newSelection = [
            'volcano' => $selectedVolcano['name'],
            'transport' => $transport,
            'hotel' => $hotel,
            'jours' => $jours,
            'car' => $car,
            'restaurant' => $restaurant,
            'activities' => $activities,
            'total' => $total,
            'timestamp' => date('Y-m-d H:i:s')
        ];

        $allSelections = [];
        if (file_exists($selectionFile)) {
            $allSelections = json_decode(file_get_contents($selectionFile), true);
        }

        $allSelections[] = $newSelection;
        file_put_contents($selectionFile, json_encode($allSelections, JSON_PRETTY_PRINT));
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
            </ul>
        </div>
        <a href="profile.php"><img src="pp.jpg" alt="profile"></a>
    </div>

   <div class="recap-container">
    <h1>Récapitulatif de votre voyage</h1>
    <div class="recap-item"><strong>Volcan sélectionné :</strong> <?= $selectedVolcano['name'] ?></div>
    <div class="recap-item"><strong>Transport choisi :</strong> <?= $transport ?></div>
    <div class="recap-item"> <strong>Hébergement :</strong> <?= $hotel ?></div>
    <div class="recap-item"><strong>Durée :</strong> <?= $jours ?> jour(s)</div>
    <div class="recap-item"> <strong>Location de voiture :</strong> <?= $car ?></div>
    <div class="recap-item"> <strong>Restaurant :</strong> <?= $restaurant ?></div>

    <?php if (!empty($activities)): ?>
        <div class="recap-item">🎯 <strong>Activités sélectionnées :</strong>
            <ul>
                <?php foreach ($activities as $act): ?>
                    <li><?= $act ?> (<?= $activityPrices[$act] ?? 0 ?> €)</li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="recap-item"><strong>💰 Prix total estimé :</strong> <span style="color: gold; font-size: 1.3em;"><?= $total ?> €</span></div>
    <div class="recap-item">📌 Sauvegardé le : <?= date('d/m/Y à H:i') ?></div>
    <form action="clickjourney_cybank/paiement.php" method="POST">
        <input type="hidden" name="voyage_id" value="<?= $voyage['id'] ?>">
        <input type="hidden" name="montant" value="<?= $total ?>">
        <input type="submit" value="Procéder au paiement">
    </form>
</div>

</body>
</html>
