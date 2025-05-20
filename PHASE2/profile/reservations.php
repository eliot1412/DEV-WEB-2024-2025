<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: ../log.php');
    exit();
}

$selectionFile = __DIR__ . '/../selections.json';
$selections = [];

// Charge toutes les réservations
if (file_exists($selectionFile)) {
    $allSelections = json_decode(file_get_contents($selectionFile), true);
    
    foreach ($allSelections as $reservation) {
        if (isset($reservation['user_email']) && $reservation['user_email'] === $_SESSION['email']) {
            $selections[] = $reservation;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Réservations</title>
    <link rel="stylesheet" href="../head.css">
    <link rel="stylesheet" href="../profile.css">
</head>
<body>

<div class="head">
    <ul><a href="../accueil.php"><img src="../VolcanFly.jpg" alt="Accueil"></a></ul>
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

<div class="table">
    <div class="side">
        <button onclick="window.location.href='../profile.php'" style="background-color: #d1d1d1;">Mes infos</button>
        <button style="background-color: #bdbdbd7e;">Mes réservations</button>
    </div>

    <div class="Principal" style="padding: 20px;">
        <h1>Mes réservations</h1>

        <?php if (!empty($selections)): ?>
            <?php foreach ($selections as $index => $reservation): ?>
                <div class="reservation" style="background-color: white; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                    <h2 style="color: #6d071a;">Voyage #<?= $index + 1 ?> - <?= $reservation['volcano'] ?></h2>
                    <ul>
                        <li>Transport : <?= $reservation['transport'] ?></li>
                        <li>Hôtel : <?= $reservation['hotel'] ?></li>
                        <li>Jours : <?= $reservation['jours'] ?></li>
                        <li>Voiture : <?= $reservation['car'] ?></li>
                        <li>Restaurant : <?= $reservation['restaurant'] ?></li>
                        <?php if (!empty($reservation['activities'])): ?>
                            <li>Activités :
                                <ul>
                                    <?php foreach ($reservation['activities'] as $act): ?>
                                        <li><?= $act ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li>Total : <?= $reservation['total'] ?> €</li>
                        <li>Date de réservation : <?= $reservation['timestamp'] ?></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune réservation trouvée.</p>
        <?php endif; ?>
    </div>
</div>

<div class="tail">
    <a href="../accueil.php"><p>Accueil</p></a>
    <p>| Destinations | Offres spéciales | Contact | À propos</p>
</div>

</body>
</html>