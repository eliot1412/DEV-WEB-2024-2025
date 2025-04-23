<?php
// 1. Chemin vers le fichier JSON
$jsonFile = __DIR__ . '/volcanoes.json';

// 2. Initialisation des données
$volcanoData = [];

// 3. Chargement du fichier JSON
if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);
    $volcanoData = json_decode($jsonContent, true);
    
    // Vérification des erreurs JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        die("Erreur dans le fichier JSON : " . json_last_error_msg());
    }
}

// 4. Si le fichier est vide ou n'existe pas, on utilise des données par défaut
if (empty($volcanoData)) {
    $volcanoData = [
        [
            "name" => "Volcan par défaut",
            "location" => "Localisation inconnue",
            "image" => "default.jpg",
            "rating" => 4,
            "price" => "€99",
            "description" => "Description par défaut",
            "region" => "europe"
        ]
    ];
}
?>

<!DOCTYPE html>
<html lang="fr">
<title>Résultats de Recherche - Voyages Volcaniques</title>
<head>
    <link rel="stylesheet" type="text/css" href="head.css">
    <link rel="stylesheet" type="text/css" href="choice.css">
    <style>
        /* Styles spécifiques à la page de résultats */
        .results-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
            z-index: 2;
            position: relative;
        }
        
        .volcano-card {
            background: rgba(109, 7, 26, 0.8);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
            color: white;
        }
        
        .volcano-card:hover {
            transform: translateY(-5px);
        }
        
        .volcano-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .volcano-info {
            padding: 15px;
        }
        
        .volcano-name {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: rgba(229, 197, 39, 0.903);
        }
        
        .volcano-location {
            margin-bottom: 10px;
            font-style: italic;
        }
        
        .volcano-rating {
            color: gold;
            margin-bottom: 10px;
        }
        
        .volcano-price {
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        
        .volcano-description {
            margin-bottom: 15px;
        }
        
        .filter-section {
            background: rgba(109, 7, 26, 0.8);
            padding: 15px;
            border-radius: 10px;
            margin: 20px;
            z-index: 2;
            position: relative;
        }
        
        .filter-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .filter-btn {
            background: #1a1a1a;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .filter-btn:hover {
            background: #c40d3b;
        }
        
        /* Animation pour l'apparition des cartes */
        .volcano-card {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <meta charset="UTF-8">
</head>
<body>
    <div class="head">
        <a href="accueil.html">
            <img src="VolcanFly.jpg" alt="Accueil">
        </a>
        <div class="headers">
            <ul>
                <li><a href="accueil.html">Accueil</a></li>
                <li><a href="reg.html">Inscription</a></li>
                <li><a href="log.html">Connexion</a></li>
                <li><a href="choice.php">Voyages</a></li>
                <li><a href="aides.html">Aides</a></li>
            </ul>
        </div>
    </div>
    
    <div class="contenu">
        <h1>Résultats de Recherche</h1>
        
        <div class="filter-section">
            <h3>Filtrer par :</h3>
            <div class="filter-options">
                <button class="filter-btn" data-filter="all">Tous</button>
                <button class="filter-btn" data-filter="europe">Europe</button>
                <button class="filter-btn" data-filter="amerique">Amérique</button>
                <button class="filter-btn" data-filter="asie">Asie</button>
                <button class="filter-btn" data-filter="oceanie">Océanie</button>
            </div>
        </div>
        
        <div class="results-container" id="results-container">
            <?php foreach ($volcanoData as $index => $volcano): ?>
                <div class="volcano-card" data-region="<?= htmlspecialchars($volcano['region'] ?? '') ?>" style="animation-delay: <?= $index * 0.1 ?>s">
                    <img src="<?= htmlspecialchars($volcano['image'] ?? 'default.jpg') ?>"
                         alt="<?= htmlspecialchars($volcano['name'] ?? '') ?>"
                         class="volcano-image">
                    <div class="volcano-info">
                        <h3 class="volcano-name"><?= htmlspecialchars($volcano['name'] ?? '') ?></h3>
                        <p class="volcano-location"><?= htmlspecialchars($volcano['location'] ?? '') ?></p>
                        <div class="volcano-rating"><?= str_repeat('★', (int)($volcano['rating'] ?? 0)) ?></div>
                        <p class="volcano-price">À partir de <?= htmlspecialchars($volcano['price'] ?? '') ?></p>
                        <p class="volcano-description"><?= htmlspecialchars($volcano['description'] ?? '') ?></p>
                        <a href="#" class="aides a">Voir détails</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div class="tail">
        <a href="accueil.html">
            <p>Acceuil</p>
        </a>
        <p>|S.A.V|...</p>
    </div>
    
</body>
</html>

