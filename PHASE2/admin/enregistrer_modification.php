<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../accueil.php');
    exit();
}

$fichier = '../utilisateurs.json';
if (!file_exists($fichier)) {
    die("Fichier utilisateurs non trouvé");
}

$utilisateurs = json_decode(file_get_contents($fichier), true);

// Vérifier si l'utilisateur est admin
$isAdmin = false;
foreach ($utilisateurs as $user) {
    if ($user['email'] === $_SESSION['email'] && isset($user['admin']) && $user['admin'] == 1) {
        $isAdmin = true;
        break;
    }
}

if (!$isAdmin || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
    header('Location: users_info.php');
    exit();
}

$userId = $_POST['id'];
$userKey = array_search($userId, array_column($utilisateurs, 'id'));

if ($userKey !== false) {
    // Mettre à jour les informations
    $utilisateurs[$userKey]['prenom'] = $_POST['prenom'];
    $utilisateurs[$userKey]['nom'] = $_POST['nom'];
    $utilisateurs[$userKey]['email'] = $_POST['email'];
    $utilisateurs[$userKey]['age'] = $_POST['age'];
    $utilisateurs[$userKey]['admin'] = (int)$_POST['admin'];
    
    // Enregistrer les modifications
    file_put_contents($fichier, json_encode($utilisateurs, JSON_PRETTY_PRINT));
}

header('Location: users_info.php');
exit();
?>