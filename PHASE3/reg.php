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
    <title>Inscription</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="head.css">
    <link rel="stylesheet" type="text/css" href="reglog.css">
    <script src="js/theme.js" defer></script>
    
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
        

            <div class="changep">
                <p>Vous avez déjà un compte?</p><a href="log.php"><p>Connectez-vous</p></a>
            </div>
        </form>
        <?php
if (isset($_POST['submit'])) {
    $nom = $_POST['fname'];
    $prenom = $_POST['lname'];
    $email = $_POST['email'];
    $date_naissance = $_POST['date'];
    $motdepasse1 = $_POST['password1'];
    $motdepasse2 = $_POST['password2'];

    if ($motdepasse1 !== $motdepasse2) {
        echo "<p style='color:red; text-align:center;'>Les mots de passe ne correspondent pas.</p>";
    } else {

        $fichier_utilisateurs = 'utilisateurs.json';
        $utilisateurs = file_exists($fichier_utilisateurs) ? json_decode(file_get_contents($fichier_utilisateurs), true) : [];

        $emailExiste = false;
        foreach ($utilisateurs as $u) {
            if ($u['email'] === $email) {
                echo "<p style='color:red; text-align:center;'>Cet email est déjà utilisé.</p>";
                $emailExiste = true;
            }
            break;
        }   

        if(!$emailExiste){
            $nouvel_utilisateur = array(
            'nom' => $nom,
            'prenom' => $prenom,
            'sexe' => ' ',
            'email' => $email,
            'date_naissance' => $date_naissance,
            'password' => $motdepasse1,
            'admin' => "0",
            'credit' => "0000 0000 0000 0000",
            'adresse'=> "00;Nom de rue;Ville;Adresse postale;Pays"
        );

        $utilisateurs[] = $nouvel_utilisateur;

        file_put_contents($fichier_utilisateurs, json_encode($utilisateurs, JSON_PRETTY_PRINT));

        $_SESSION['email'] = $email;
        header('Location: accueil.php');
        exit();
        }
        
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
