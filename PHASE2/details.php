<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$volcanoes = json_decode(file_get_contents('volcanoes.json'), true);
$volcano = $volcanoes[$id] ?? null;

if (!$volcano) {
    die("Volcan non trouvé.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails - <?= $volcano['name'] ?></title>
    <link rel="stylesheet" href="head.css">
    <link rel="stylesheet" href="choice.css">
    <style>
        body {
            background: #1b1b1b;
            color: white;
            font-family: Arial, sans-serif;
        }

        .details-container {
            max-width: 1000px;
            margin: 40px auto;
            background: rgba(109, 7, 26, 0.8);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.6);
        }

        .details-container img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
            max-height: 300px;
            object-fit: cover;
        }

        h2 {
            color: rgba(229, 197, 39, 0.903);
        }

        form label {
            display: block;
            margin: 15px 0 5px;
        }

        form select, form input {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: none;
            font-size: 1rem;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background: rgba(229, 197, 39, 0.903);
            border: none;
            color: #1b1b1b;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #f7de57;
        }

        .activities-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px 0;
        }

        .activities-grid label {
            flex: 1 1 calc(33.333% - 20px);
            background: rgba(255,255,255,0.05);
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
            cursor: pointer;
            padding: 10px;
            border: 2px solid transparent;
            transition: border 0.3s ease;
        }

        .activities-grid label:hover,
        .activities-grid input:checked + img {
            border-color: rgba(229, 197, 39, 0.903);
        }

        .activities-grid img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        .activities-grid span {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="details-container">
        <h2><?= $volcano['name'] ?></h2>
        <img src="<?= $volcano['image'] ?>" alt="<?= $volcano['name'] ?>">
        <p><?= $volcano['description'] ?></p>
        <p><strong>Localisation :</strong> <?= $volcano['location'] ?></p>
        <p><strong>Prix de base :</strong> <?= $volcano['price'] ?></p>

        <form action="recap.php" method="POST">
            <h3>Choisissez vos activités :</h3>
            <div class="activities-grid">
                <label>
                    <input type="checkbox" name="activities[]" value="randonnée">
                    <img src="activities/randonnee.jpg" alt="Randonnée sur volcan">
                    <span>Randonnée sur le volcan (+50€)</span>
                </label>
                <label>
                    <input type="checkbox" name="activities[]" value="visite-musee">
                    <img src="activities/musee.jpg" alt="Musée volcanologique">
                    <span>Visite musée volcanologique (+30€)</span>
                </label>
                <label>
                    <input type="checkbox" name="activities[]" value="spa">
                    <img src="activities/spa.jpg" alt="Spa géothermique">
                    <span>Spa géothermique (+70€)</span>
                </label>
            </div>

            <h3>Choisissez un restaurant partenaire :</h3>
            <div class="activities-grid">
                <label>
                    <input type="radio" name="restaurant" value="local">
                    <img src="resto/local.jpg" alt="Cuisine locale">
                    <span>Cuisine locale</span>
                </label>
                <label>
                    <input type="radio" name="restaurant" value="gastro">
                    <img src="resto/gastro.jpg" alt="Restaurant gastronomique">
                    <span>Restaurant gastronomique (+40€)</span>
                </label>
            </div>

            <h3>Location de voiture :</h3>
            <div class="activities-grid">
                <label>
                    <input type="radio" name="car" value="none" checked>
                    <img src="voitures/aucune.jpg" alt="Pas de voiture">
                    <span>Pas de location</span>
                </label>
                <label>
                    <input type="radio" name="car" value="citadine">
                    <img src="voitures/citadine.jpg" alt="Citadine">
                    <span>Citadine (+25€/jour)</span>
                </label>
                <label>
                    <input type="radio" name="car" value="suv">
                    <img src="voitures/suv.jpg" alt="SUV 4x4">
                    <span>SUV 4x4 (+45€/jour)</span>
                </label>
            </div>

            <input type="hidden" name="id" value="<?= $id ?>">

            <label for="transport">Transport :</label>
            <select name="transport" id="transport" required>
                <option value="">-- Choisissez un transport --</option>
                <option value="avion">Avion (+200€)</option>
                <option value="train">Train (+120€)</option>
                <option value="bus">Bus (+80€)</option>
                <option value="car">Car (+60€)</option>
            </select>

            <label for="hotel">Hébergement :</label>
            <select name="hotel" id="hotel" required>
                <option value="">-- Choisissez un hébergement --</option>
                <option value="standard">Standard (+50€/jour)</option>
                <option value="confort">Confort (+100€/jour)</option>
                <option value="luxe">Luxe (+180€/jour)</option>
            </select>

            <label for="jours">Nombre de jours :</label>
            <input type="number" name="jours" id="jours" min="1" max="30" value="3" required>

            
            <div style="display: flex; justify-content: space-between; margin-top: 30px;">
                <a href="results.php" style="text-decoration: none;">
                    <button type="button" style="background: rgba(255,255,255,0.1); color: white;">← Retour</button>
                </a>

                <button type="submit">Suivant →</button>
            </div>
        </form>
    </div>
</body>
</html>
