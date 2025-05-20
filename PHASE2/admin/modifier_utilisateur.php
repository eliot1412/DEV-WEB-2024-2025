<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../accueil.php');
    exit();
}

$fichier = '../utilisateurs.json';
$utilisateurs = json_decode(file_get_contents($fichier), true);

// Vérifier les permissions admin
$isAdmin = false;
foreach ($utilisateurs as $user) {
    if ($user['email'] === $_SESSION['email'] && $user['admin'] == "1") {
        $isAdmin = true;
        break;
    }
}

if (!$isAdmin || !isset($_POST['id'])) {
    header('Location: users_info.php');
    exit();
}

$userId = $_POST['id'];
$user = $utilisateurs[$userId];

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $utilisateurs[$userId]['prenom'] = $_POST['prenom'];
    $utilisateurs[$userId]['nom'] = $_POST['nom'];
    $utilisateurs[$userId]['email'] = $_POST['email'];
    $utilisateurs[$userId]['date_naissance'] = $_POST['date_naissance'];
    $utilisateurs[$userId]['admin'] = $_POST['admin'];
    $utilisateurs[$userId]['vip'] = isset($_POST['vip']) ? "1" : "0";
    $utilisateurs[$userId]['banni'] = isset($_POST['banni']) ? "1" : "0";

    file_put_contents($fichier, json_encode($utilisateurs, JSON_PRETTY_PRINT));
    $_SESSION['flash_message'] = "Utilisateur modifié avec succès!";
    header('Location: users_info.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Utilisateur</title>
    <link rel="stylesheet" href="../head.css">
    <style>
        .edit-form { max-width: 500px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; }
        .checkbox-group { margin: 10px 0; }
    </style>
</head>
<body>
    <div class="head">
        <!-- Votre header existant -->
    </div>

    <div class="edit-form">
        <h1>Modifier <?= $user['prenom'] ?> <?= $user['nom'] ?></h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $userId ?>">
            
            <div class="form-group">
                <label>Prénom:</label>
                <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>
            </div>

            <div class="form-group">
                <label>Nom:</label>
                <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>

            <div class="form-group">
                <label>Date de naissance:</label>
                <input type="date" name="date_naissance" value="<?= htmlspecialchars($user['date_naissance']) ?>">
            </div>

            <div class="form-group">
                <label>Rôle:</label>
                <select name="admin">
                    <option value="0" <?= $user['admin'] == "0" ? 'selected' : '' ?>>Utilisateur normal</option>
                    <option value="1" <?= $user['admin'] == "1" ? 'selected' : '' ?>>Administrateur</option>
                </select>
            </div>

            <div class="checkbox-group">
                <label>
                    <input type="checkbox" name="vip" <?= isset($user['vip']) && $user['vip'] == "1" ? 'checked' : '' ?>>
                    Client VIP
                </label>
            </div>

            <div class="checkbox-group">
                <label>
                    <input type="checkbox" name="banni" <?= isset($user['banni']) && $user['banni'] == "1" ? 'checked' : '' ?>>
                    Bannir cet utilisateur
                </label>
            </div>

            <button type="submit" name="save">Enregistrer</button>
            <button type="button" onclick="window.location.href='users_info.php'">Annuler</button>
        </form>
    </div>
</body>
</html>