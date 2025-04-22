<?php
session_start();
if (isset($_SESSION['email'])) {
    header('Location: main.php');
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
</head>
<body>

<div class="head">
    <a href="accueil.html">
        <img src="VolcanFly.jpg" alt="Accueil">
    </a>
    <div class="headers">
        <ul>
            <li><a href="accueil.html">Accueil</a></li>
            <li><a href="reg.php">Inscription</a></li>
            <li><a href="log.php">Connexion</a></li>
            <li><a href="choice.html">Voyages</a></li>
            <li><a href="aides.html">Aides</a></li>
        </ul>
    </div>
</div>

<div class="title">
    <h1>Connectez-vous pour profiter pleinement de VolcanFly</h1>
</div>

<div class="info" id="log">
    <form action="log.php" method="post">
        <div class="input-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required/>
        </div>

        <div class="input-group">
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" required/>
        </div>

        <div class="button-group">
            <button type="submit" name="submit">Envoyer</button>
        </div>

        <div class="changep">
            <p>Vous n'avez pas de compte?</p><a href="reg.php"><p>Inscrivez-vous</p></a>
        </div>
    </form>
</div>

<div class="tail">
    <a href="accueil.html">
        <p>Accueil</p>
    </a>
    <p>| Destinations | Offres spéciales | Contact | À propos</p>
</div>

</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $email = htmlspecialchars($_POST['email']);
    $motdepasse = $_POST['password'];

    if (file_exists('users/' . $email . '.txt')) {
        $infos = file('users/' . $email . '.txt');
        $hash_enregistre = trim($infos[4]);

        if (password_verify($motdepasse, $hash_enregistre)) {
            $_SESSION['email'] = $email;
            header('Location: accueil.html');
            exit();
        } else {
            echo "<p style='color:red; text-align:center;'>Mot de passe incorrect.</p>";
        }
    } else {
        echo "<p style='color:red; text-align:center;'>Email introuvable.</p>";
    }
}
?>
