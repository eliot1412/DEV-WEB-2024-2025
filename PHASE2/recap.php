<?php
$volcanoes = json_decode(file_get_contents('volcanoes.json'), true);
$id = (int)($_POST['id'] ?? 0);
$volcano = $volcanoes[$id] ?? null;

if (!$volcano) {
    die("Volcan non trouvé.");
}

$transport = $_POST['transport'];
$hotel = $_POST['hotel'];
$jours = (int)$_POST['jours'];

$basePrice = (int) filter_var($volcano['price'], FILTER_SANITIZE_NUMBER_INT);
$transportPrice = ($transport === 'avion') ? 100 : (($transport === 'train') ? 70 : 40);
$hotelPrice = ($hotel === 'luxe') ? 150 : (($hotel === 'confort') ? 100 : 60);
$total = $basePrice + $transportPrice + $hotelPrice + ($jours * 20);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Récapitulatif</title>
    <link rel="stylesheet" href="head.css">
    <style>
        body {
            background-color: #1b1b1b;
            color: white;
            font-family: Arial, sans-serif;
        }

        .recap-container {
            max-width: 800px;
            margin: 50px auto;
            background: rgba(109, 7, 26, 0.8);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.6);
        }

        h1 {
            color: rgba(229, 197, 39, 0.903);
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 15px 0;
            font-size: 1.1rem;
        }

        .total {
            font-weight: bold;
            color: #f7de57;
        }
    </style>
</head>
<body>
    <div class="recap-container">
        <h1>Récapitulatif de votre voyage</h1>
        <ul>
            <li><strong>Volcan :</strong> <?= htmlspecialchars($volcano['name']) ?></li>
            <li><strong>Lieu :</strong> <?= htmlspecialchars($volcano['location']) ?></li>
            <li><strong>Transport :</strong> <?= htmlspecialchars($transport) ?> (<?= $transportPrice ?>€)</li>
            <li><strong>Hébergement :</strong> <?= htmlspecialchars($hotel) ?> (<?= $hotelPrice ?>€)</li>
            <li><strong>Durée :</strong> <?= $jours ?> jours (<?= $jours * 20 ?>€)</li>
            <li class="total"><strong>Total estimé :</strong> <?= $total ?>€</li>
        </ul>
    </div>
</body>
</html>
