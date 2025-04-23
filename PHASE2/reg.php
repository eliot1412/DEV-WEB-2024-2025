<?php
session_start();
/*if (isset($_SESSION['email'])) {
    header('Location: accueil.php');
    exit();
}*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="head.css">
    <link rel="stylesheet" type="text/css" href="reglog.css">
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
                
            </ul>
        </div>
    </div>

<div class="Centre">
    <div class="title">
        <h1>Inscrivez-vous pour profiter du meilleur de VolcanFly</h1>
    </div>

    <div class="info">
        <form action="reg.php" method="post">
            <div class="input-group">
                <label for="fname">Nom :</label>
                <input type="text" id="fname" name="fname" required/>
            </div>
            <div class="input-group">
                <label for="lname">Prénom :</label>
                <input type="text" id="lname" name="lname" required/>
            </div>
            <div class="input-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required/>
            </div>
            <div class="input-group">
                <label for="date">Date de naissance :</label>
                <input type="date" id="date" name="date" required/>
            </div>
            <div class="input-group">
                <label for="password1">Mot de passe :</label>
                <input type="password" id="password1" name="password1" required/>
            </div>
            <div class="input-group">
                <label for="password2">Confirmer votre mot de passe :</label>
                <input type="password" id="password2" name="password2" required/>
            </div>

            <div class="button-group">
                <button type="submit" name="submit">Envoyer</button>
            </div>
        </form>

        <div class="changep">
            <p>Vous avez déjà un compte?</p><a href="log.php"><p>Connectez-vous</p></a>
        </div>
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

<?php
if (isset($_POST['submit'])) {
    $nom = htmlspecialchars($_POST['fname']);
    $prenom = htmlspecialchars($_POST['lname']);
    $email = htmlspecialchars($_POST['email']);
    $date_naissance = htmlspecialchars($_POST['date']);
    $motdepasse1 = $_POST['password1'];
    $motdepasse2 = $_POST['password2'];

    if ($motdepasse1 !== $motdepasse2) {
        echo "<p style='color:red; text-align:center;'>Les mots de passe ne correspondent pas.</p>";
    } else {
        if (!file_exists('users')) {
            mkdir('users');
        }

        if (file_exists('users/' . $email . '.txt')) {
            echo "<p style='color:red; text-align:center;'>Cet email est déjà utilisé.</p>";
        } else {
            $contenu = $nom . "\n" . $prenom . "\n" . $email . "\n" . $date_naissance . "\n" . $motdepasse1;
            file_put_contents('users/' . $email . '.txt', $contenu);

            $_SESSION['email'] = $email;
            header('Location: accueil.php');
            exit();
        }
    }
}
?>
