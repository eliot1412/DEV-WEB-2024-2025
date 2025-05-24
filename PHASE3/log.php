<?php
session_start();
if (isset($_SESSION['email'])) {
    header('Location: accueil.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="head.css">
    <link rel="stylesheet" type="text/css" href="reglog.css">
    <script src="js/theme.js" defer></script>
    <script src="js/hide.js" defer></script>
    
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
                <li><a href="panier.php">Panier</a></li>

            </ul>



        </div>

        <a href="profile.php">
            <img src="pp.jpg" alt="profile">
            </a>
    </div>

<div class="Centre">
<div class="title">
    <h1>Connectez-vous pour profiter pleinement de VolcanFly</h1>
</div>

<div class="info" id="log">
    <form action="log.php" method="post">
        <div class="input-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email"/>
        
            
                <label for="password">Mot de passe :</label>
                <div class="password">
                <input type="password" name="password" id="password"/><img id="imgpassword" src="show.jpg" alt="Afficher ou cacher mdp" onclick="hide()">
                </div>
        </div>

        <div class="button-group">
            <button type="submit" name="submit">Envoyer</button>
        </div>

        <div class="changep">
            <p>Vous n'avez pas de compte?</p><a href="reg.php"><p>Inscrivez-vous</p></a>
        </div>
    </form>
    <?php
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $motdepasse = $_POST['password'];

    $fichier = 'utilisateurs.json';
    if (!file_exists($fichier)) {
        echo "<p style='color:red; text-align:center;'>Aucun utilisateur enregistré.</p>";
        exit();
    }

    $utilisateurs = json_decode(file_get_contents($fichier), true);
    $email_trouve = false;

    foreach ($utilisateurs as $u) {
        if ($u['email'] === $email) {
            $email_trouve = true;
            if ($u['password'] === $motdepasse) {
                $_SESSION['email'] = $email;
                header('Location: accueil.php');
                exit();
            } else {
                echo "<p style='color:red; text-align:center;'>Mot de passe incorrect.</p>";
                
            }
        }
    }

    if (!$email_trouve) {
        echo "<p style='color:red; text-align:center;'>Email introuvable.</p>";
    }
}
?>
</div>
</div>




<div class="tail">
    <a href="accueil.php">
        <p>Accueil</p>
    </a>
    <p>| Destinations | Offres spéciales | Contact | À propos</p>
</div>

</body>
</html>
