<?php
// Récupère l’ID du volcan depuis l’URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : -1;

// Charge les données JSON
$jsonFile = __DIR__ . '/volcanoes.json';
$volcanoData = [];

if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);
    $volcanoData = json_decode($jsonContent, true);
}

$volcano = $volcanoData[$id] ?? null;
if (!$volcano) {
    die("Volcan non trouvé !");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails - <?= htmlspecialchars($volcano['name']) ?></title>
    <link rel="stylesheet" type="text/css" href="head.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2b1a1a;
            color: white;
            padding: 40px;
        }
        .volcano-details {
            max-width: 1000px;
            margin: auto;
            background: rgba(109, 7, 26, 0.9);
            border-radius: 15px;
            overflow: hidden;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
        }
        .volcano-details img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }
        h1 {
            color: #e5c527;
        }
        .options {
            margin-top: 25px;
        }
        .option-block {
            background-color: rgba(255,255,255,0.05);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .option-block h3 {
            color: #ffcc00;
        }
        a.back {
            color: #ffcc00;
            text-decoration: underline;
            margin-top: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="volcano-details">
    <img src="<?= htmlspecialchars($volcano['image']) ?>" alt="<?= htmlspecialchars($volcano['name']) ?>">
    <h1><?= htmlspecialchars($volcano['name']) ?></h1>
    <p><strong>Localisation :</strong> <?= htmlspecialchars($volcano['location']) ?></p>
    <p><strong>Région :</strong> <?= htmlspecialchars($volcano['region']) ?></p>
    <p><strong>Note :</strong> <?= str_repeat('★', (int)$volcano['rating']) ?></p>
    <p><strong>Prix de base :</strong> <?= htmlspecialchars($volcano['price']) ?></p>
    <p><?= htmlspecialchars($volcano['description']) ?></p>

    <div class="options">
        <div class="option-block">
            <h3>Transport</h3>
            <p>Vol aller-retour inclus depuis Paris. Transferts locaux en 4x4 ou navette selon la destination.</p>
        </div>
        <div class="option-block">
            <h3>Hébergement</h3>
            <p>Hôtels 3 à 4 étoiles, petit déjeuner inclus. Options de logement en lodge selon les lieux.</p>
        </div>
        <div class="option-block">
            <h3>Excursions & Activités</h3>
            <p>Randonnées guidées, observation du volcan, visites culturelles locales selon le programme.</p>
        </div>
        <div class="option-block">
            <h3>Options supplémentaires</h3>
            <p>Assurance voyage, guide privé, survol en hélicoptère (dans certains cas), extension séjour.</p>
        </div>
    </div>

    <a href="result.php" class="back">← Retour aux résultats</a>
</div>

</body>
</html>
