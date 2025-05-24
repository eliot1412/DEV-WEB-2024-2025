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
$currentEmail = $_SESSION['email'];
foreach ($utilisateurs as $user) {
    if ($user['email'] === $currentEmail && $user['admin'] == "1") {
        $isAdmin = true;
        break;
    }
}

if (!$isAdmin || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
    header('Location: users_info.php');
    exit();
}

$userId = $_POST['id'];

// Empêcher de se supprimer soi-même
if ($utilisateurs[$userId]['email'] !== $currentEmail) {
    array_splice($utilisateurs, $userId, 1);
    file_put_contents($fichier, json_encode($utilisateurs, JSON_PRETTY_PRINT));
    $_SESSION['flash_message'] = "Utilisateur supprimé avec succès!";
} else {
    $_SESSION['flash_error'] = "Vous ne pouvez pas supprimer votre propre compte!";
}

header('Location: users_info.php');
exit();
?>