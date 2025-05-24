<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: log.php');
    exit();
}

// Charger les données des volcans
$volcanoData = json_decode(file_get_contents(__DIR__ . '/volcanoes.json'), true);

// Supprimer un voyage du panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
    $index = $_POST['index'];
    if (isset($_SESSION['panier'][$index])) {
        unset($_SESSION['panier'][$index]);
        $_SESSION['panier'] = array_values($_SESSION['panier']); // Réindexer le tableau
    }
    header('Location: panier.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre Panier</title>
    <link rel="stylesheet" href="head.css">
    <link rel="stylesheet" href="panier.css">
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
            </ul>
        </div>
        <a href="profile.php"><img src="pp.jpg" alt="profile"></a>
    </div>

    <div class="panier-container">
        <h1>Votre Panier</h1>
        
        <?php if (empty($_SESSION['panier'])): ?>
            <p>Votre panier est vide. <a href="choice.php">Découvrez nos voyages</a> !</p>
        <?php else: ?>
            <?php $totalGeneral = 0; ?>
            <?php foreach ($_SESSION['panier'] as $index => $voyage): ?>
                <div class="voyage-item">
                    <h2><?= htmlspecialchars($voyage['volcano']) ?></h2>
                    <p><strong>Transport :</strong> <?= htmlspecialchars($voyage['transport']) ?></p>
                    <p><strong>Hébergement :</strong> <?= htmlspecialchars($voyage['hotel']) ?> (<?= $voyage['jours'] ?> jour(s))</p>
                    <p><strong>Activités :</strong> <?= implode(', ', $voyage['activities']) ?></p>
                    <p><strong>Prix :</strong> <span class="prix"><?= $voyage['total'] ?> €</span></p>
                    
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="index" value="<?= $index ?>">
                        <button type="submit" name="supprimer" class="btn-supprimer">Supprimer</button>
                    </form>
                </div>
                <?php $totalGeneral += $voyage['total']; ?>
            <?php endforeach; ?>

            <div class="total">
                <h3>Total à payer : <span class="prix-total"><?= $totalGeneral ?> €</span></h3>
                <form action="clickjourney_cybank/paiement.php" method="POST">
                    <input type="hidden" name="montant" value="<?= $totalGeneral ?>">
                    <button type="submit" class="btn-payer">Payer tout le panier</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>