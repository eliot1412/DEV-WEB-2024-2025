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
    <title>Détails - <?= htmlspecialchars($volcano['name']) ?></title>
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
    </style>
</head>
<body>
    <div class="details-container">
        <h2><?= htmlspecialchars($volcano['name']) ?></h2>
        <img src="<?= htmlspecialchars($volcano['image']) ?>" alt="<?= htmlspecialchars($volcano['name']) ?>">
        <p><?= htmlspecialchars($volcano['description']) ?></p>
        <p><strong>Localisation :</strong> <?= htmlspecialchars($volcano['location']) ?></p>
        <p><strong>Prix de base :</strong> <?= htmlspecialchars($volcano['price']) ?></p>

        <form action="recap.php" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">

            <label for="transport">Type de transport :</label>
            <select name="transport" id="transport">
                <option value="avion">Avion</option>
                <option value="train">Train</option>
                <option value="bus">Bus</option>
            </select>

            <label for="hotel">Type d'hébergement :</label>
            <select name="hotel" id="hotel">
                <option value="standard">Standard</option>
                <option value="confort">Confort</option>
                <option value="luxe">Luxe</option>
            </select>

            <label for="jours">Nombre de jours :</label>
            <input type="number" name="jours" id="jours" value="3" min="1">

            <button type="submit">Valider mes choix</button>
        </form>
    </div>
</body>
</html>
