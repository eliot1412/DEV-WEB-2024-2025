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
    <link rel="stylesheet" type="text/css" href="details.css">
    <script src="js/price.js" defer></script>

</head>
<body>
    <div class="details-container">
        <h2><?= $volcano['name'] ?></h2>
        <img src="<?= $volcano['image'] ?>" alt="<?= $volcano['name'] ?>">
        <p><?= $volcano['description'] ?></p>
        <p><strong>Localisation :</strong> <?= $volcano['location'] ?></p>
        <p><strong>Prix de base:</strong> <?= $volcano['price'] ?></p>
        <?php $basePrice = (int) filter_var($volcano['price'], FILTER_SANITIZE_NUMBER_INT); ?>
<p id="price-total" data-base-price="<?= $basePrice ?>">
    <strong>Prix estimé :</strong> <?= $basePrice ?> €
</p>

        <form action="recap.php" method="GET">
            <h3>Choisissez vos activités :</h3>
            <div class="activities-grid">
                <label>
                <input type="checkbox" name="activities[]" value="randonnée" data-price="50">

                    <img src="activities/randonnee.jpg" alt="Randonnée sur volcan">
                    <span>Randonnée sur le volcan (+50€)</span>
                </label>
                <label>
                <input type="checkbox" name="activities[]" value="visite-musee" data-price="30">
                    <img src="activities/musee.jpg" alt="Musée volcanologique">
                    <span>Visite musée volcanologique (+30€)</span>
                </label>
                <label>
                <input type="checkbox" name="activities[]" value="spa" data-price="70">
                <img src="activities/spa.jpg" alt="Spa géothermique">
                    <span>Spa géothermique (+70€)</span>
                </label>
            </div>

            <h3>Choisissez un restaurant partenaire :</h3>
            <div class="activities-grid">
                <label>
                <input type="radio" name="restaurant" value="local" data-price="0">
                    <img src="resto/local.jpg" alt="Cuisine locale">
                    <span>Cuisine locale</span>
                </label>
                <label>
                <input type="radio" name="restaurant" value="gastro" data-price="40">
                    <img src="resto/gastro.jpg" alt="Restaurant gastronomique">
                    <span>Restaurant gastronomique (+40€)</span>
                </label>
            </div>

            <h3>Location de voiture :</h3>
            <div class="activities-grid">
                <label>
                <input type="radio" name="car" value="none" checked data-price="0">
                    <img src="voitures/aucune.jpg" alt="Pas de voiture">
                    <span>Pas de location</span>
                </label>
                <label>
                <input type="radio" name="car" value="citadine" data-price="25">
                <img src="voitures/citadine.jpg" alt="Citadine">
                    <span>Citadine (+25€/jour)</span>
                </label>
                <label>
                <input type="radio" name="car" value="suv" data-price="45">
                <img src="voitures/suv.jpg" alt="SUV 4x4">
                    <span>SUV 4x4 (+45€/jour)</span>
                </label>
            </div>

            <input type="hidden" name="id" value="<?= $id ?>">

            <label for="transport">Transport :</label>
            <select name="transport" id="transport" required>
                <option value="">-- Choisissez un transport --</option>
                <option value="avion" data-price="200">Avion (+200€)</option>
<option value="train" data-price="120">Train (+120€)</option>
<option value="bus" data-price="80">Bus (+80€)</option>
<option value="car" data-price="60">Car (+60€)</option>option value="car">Car (+60€)</option>
            </select>

            <label for="hotel">Hébergement :</label>
            <select name="hotel" id="hotel" required>
                <option value="">-- Choisissez un hébergement --</option>
                <option value="standard" data-price="50">Standard (+50€/jour)</option>
<option value="confort" data-price="100">Confort (+100€/jour)</option>
<option value="luxe" data-price="180">Luxe (+180€/jour)</option>
            </select>

            <label for="jours">Nombre de jours :</label>
            <input type="number" name="jours" id="jours" min="1" max="30" value="3" required>

            <!-- Boutons Retour et Suivant -->
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
