<?php
// 1. Chemin vers le fichier JSON
$jsonFile = __DIR__ . '/volcanoes.json';

// 2. Initialisation des données
$volcanoData = [];

// 3. Chargement du fichier JSON
if (file_exists($jsonFile)) {
    $jsonContent  = file_get_contents($jsonFile);
    $volcanoData  = json_decode($jsonContent, true);

    // Vérification des erreurs JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        die("Erreur dans le fichier JSON : " . json_last_error_msg());
    }
}

if (empty($volcanoData)) {
    $volcanoData = [
        [
            "name"        => "Volcan par défaut",
            "location"    => "Localisation inconnue",
            "image"       => "default.jpg",
            "rating"      => 4,
            "price"       => "€99",
            "description" => "Description par défaut",
            "region"      => "europe"
        ]
    ];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats de Recherche - Voyages Volcaniques</title>
    <link rel="stylesheet" href="head.css" type="text/css">
    <link rel="stylesheet" href="results.css" type="text/css">
    <link rel="stylesheet" href="choice.css" type="text/css">
    <script src="results.js" defer></script>
</head>
<body>
    <div class="head">
        <ul>
            <li>
                <a href="accueil.php">
                    <img src="VolcanFly.jpg" alt="Accueil">
                </a>
            </li>
        </ul>
        <div class="headers">
            <ul>
                <li><a href="accueil.php">Accueil</a></li>
                <li><a href="reg.php">Inscription</a></li>
                <li><a href="log.php">Connexion</a></li>
                <li><a href="choice.php">Voyages</a></li>
                <li><a href="aides.php">Aides</a></li>
            </ul>
        </div>
        <a href="profile.php">
            <img src="pp.jpg" alt="Profil">
        </a>
    </div>

    <div class="contenu">
        <h1>Résultats de Recherche</h1>

        <div class="results-container" id="results-container">
            <?php foreach ($volcanoData as $index => $volcano): ?>
                <?php
                    // calculs pour le tri
                    $startTs   = strtotime($volcano['start_date'] ?? '');
                    $endTs     = strtotime($volcano['end_date']   ?? '');
                    $duration  = ($startTs && $endTs) ? round(($endTs - $startTs) / 86400) : 0;
                    $priceNum  = floatval(str_replace(['€',' '], '', $volcano['price'] ?? '0'));
                    $ratingNum = (int)($volcano['rating'] ?? 0);
                ?>
                <a
                    href="details.php?id=<?= $index ?>"
                    class="volcano-link result-item"
                    data-date="<?= $volcano['start_date'] ?? '' ?>"
                    data-price="<?= $priceNum ?>"
                    data-duration="<?= $duration ?>"
                    data-rating="<?= $ratingNum ?>"
                >
                    <div
                        class="volcano-card"
                        data-region="<?= $volcano['region'] ?? '' ?>"
                        style="animation-delay: <?= $index * 0.1 ?>s"
                    >
                        <img
                            src="<?= $volcano['image'] ?? 'default.jpg' ?>"
                            alt="<?= $volcano['name']  ?? '' ?>"
                            class="volcano-image"
                        >
                        <div
                            class="volcano-info"
                            data-start-date="<?= $volcano['start_date'] ?? '' ?>"
                            data-end-date="<?= $volcano['end_date']   ?? '' ?>"
                        >
                            <h3 class="volcano-name">
                                <?= $volcano['name'] ?? '' ?>
                            </h3>
                            <p class="volcano-location">
                                <?= $volcano['location'] ?? '' ?>
                            </p>
                            <div class="volcano-rating">
                                <?= str_repeat('★', $ratingNum) ?>
                            </div>
                            <p class="volcano-price">
                                À partir de <?= $volcano['price'] ?? '' ?>
                            </p>
                            <p class="volcano-description">
                                <?= $volcano['description'] ?? '' ?>
                            </p>
                            <p class="volcano-period">
                                <strong>Période :</strong>
                                du <?= date('d/m/Y', strtotime($volcano['start_date'] ?? '')) ?>
                                au <?= date('d/m/Y', strtotime($volcano['end_date']   ?? '')) ?>
                            </p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="tail">
        <a href="accueil.html">
            <p>Accueil</p>
        </a>
        <p>| S.A.V | ...</p>
    </div>
</body>
</html>
