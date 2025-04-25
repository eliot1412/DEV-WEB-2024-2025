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
    /* Modifications pour le conteneur des résultats */
    .results-container {
        display: grid;
        grid-template-columns: repeat(5, 1fr); /* 5 colonnes égales */
        gap: 20px;
        padding: 20px;
        z-index: 2;
        position: relative;
        width: 95%;
        margin: 0 auto;
    }
    
    /* Ajustement des cartes de volcans */
    .volcano-card {
        background: rgba(109, 7, 26, 0.8);
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease;
        color: white;
        height: 100%; /* Uniformise la hauteur */
        display: flex;
        flex-direction: column;
    }
    
    /* Contenu des cartes */
    .volcano-info {
        padding: 15px;
        flex-grow: 1; /* Permet un alignement uniforme */
        display: flex;
        flex-direction: column;
    }
    
    /* Styles existants conservés mais adaptés */
    .volcano-image {
        width: 100%;
        height: 180px; /* Hauteur légèrement réduite */
        object-fit: cover;
    }
    
    .volcano-name {
        font-size: 1.2rem; /* Taille réduite pour s'adapter */
        margin-bottom: 8px;
        color: rgba(229, 197, 39, 0.903);
    }
    
    .volcano-description {
        font-size: 0.9rem; /* Taille réduite */
        margin-bottom: 15px;
        flex-grow: 1; /* Pousse le bouton vers le bas */
    }
    
    /* Adaptation pour les écrans plus petits */
    @media (max-width: 1600px) {
        .results-container {
            grid-template-columns: repeat(4, 1fr); /* 4 colonnes sur écrans moyens */
        }
    }
    
    @media (max-width: 1200px) {
        .results-container {
            grid-template-columns: repeat(3, 1fr); /* 3 colonnes sur tablettes */
        }
    }
    
    @media (max-width: 768px) {
        .results-container {
            grid-template-columns: repeat(2, 1fr); /* 2 colonnes sur mobiles */
        }
    }
    
    @media (max-width: 480px) {
        .results-container {
            grid-template-columns: 1fr; /* 1 colonne sur petits mobiles */
        }
    }

    /* Pour rendre toute la carte cliquable */
.volcano-link {
    text-decoration: none;
    color: inherit;
    display: block;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.volcano-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.volcano-link:hover .volcano-card {
    transform: translateY(-8px) scale(1.03);
    box-shadow: 0 8px 16px rgba(255, 220, 77, 0.4);
    background: rgba(150, 20, 40, 0.9);
    cursor: pointer;
}

/* Ajoute un effet subtil à l'image aussi */
.volcano-image {
    transition: transform 0.3s ease;
}

.volcano-link:hover .volcano-image {
    transform: scale(1.05);
}


</style>
    <meta charset="UTF-8">
</head>
<body>
    <div class="head">

        <ul>
            <a href="accueil.php">
                <img src="VolcanFly.jpg" alt="Accueil">
            </a>

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
            <img src="pp.jpg" alt="profile">
            </a>
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
    <a href="details.php?id=<?= $index ?>" class="volcano-link">
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
            </div>
        </div>
    </a>
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
