<!DOCTYPE html>
<?php 
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: reg.php');
    exit();
}

$fichier = 'utilisateurs.json';
if (!file_exists($fichier)) {
    echo "<p style='color:red; text-align:center;'>Aucun utilisateur enregistré.</p>";
    exit();
}

$utilisateurs = json_decode(file_get_contents($fichier), true);
$email_trouve = false;

foreach ($utilisateurs as $u) {
    if ($u['email'] === $_SESSION['email']) {
        $email_trouve = true;
        $nom = $u['nom'];
        $prenom = $u['prenom'];
        $sexe = $u['sexe'];
        $email = $u['email'];
        $date_naissance = $u['date_naissance'];
        $password = $u['password'];
        $adresse_parts = explode(';', $u['adresse']);
        $credit = explode(' ', $u['credit']);
    }
}

if (!$email_trouve) {
    echo "<p style='color:red; text-align:center;'>Email introuvable.</p>";
}
?>
<html lang="fr">
<head>
    <title>Modifier vos informations</title>
    <link rel="stylesheet" type="text/css" href="head.css">
    <link rel="stylesheet" type="text/css" href="editprofile.css">
    <script src="js/theme.js" defer></script>
    <meta charset="UTF-8">
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

    <div class="table">
        <div class="side">
            <p>&nbsp;</p></div>

        <div class="Principal">

            <form action="" method="post">

                <div class="profile">
                    <div class="pp"><img src="pp.jpg" alt="Photo de profil"></div>
                    <h1><b><?= $nom . ' ' . $prenom ?></b></h1>
                </div>

                <div class="personal_data">
                    <ul>
                        <h1>Données personnelles :</h1>

                        <p>Nom : <input type="text" name="lastname" value="<?= $nom ?>"></p>
                        <p>Prénom : <input type="text" name="firstname" value="<?= $prenom ?>"></p>

                        <p>Sexe :
                            <input type="radio" name="sexe" value="Homme" <?= $sexe == 'Homme' ? 'checked' : '' ?>> Homme
                            <input type="radio" name="sexe" value="Femme" <?= $sexe == 'Femme' ? 'checked' : '' ?>> Femme
                            <input type="radio" name="sexe" value="Autre" <?= $sexe == 'Autre' ? 'checked' : '' ?>> Autre
                        </p>

                        <p>Date de naissance :
                            <input type="date" name="date_naissance" value="<?= $date_naissance ?>">
                        </p>

                        <p>Adresse email :
                            <input type="email" name="email" value="<?= $email ?>">
                        </p>

                        <p>Mot de passe :
                            <input type="number" name="password" value="<?= $password ?>">
                        </p>
                    </ul>
                </div>

                <div class="pay_data">
                    <ul>
                        <h1>Informations de paiement :</h1>
                        <p>
                            Adresse : 
                            <input style="width:35px" type="number" name="adresse1" value="<?= $adresse_parts[0] ?>"> 
                            <input type="text" name="adresse2" value="<?= $adresse_parts[1] ?>"> 
                            <input type="text" name="adresse3" value="<?= $adresse_parts[2] ?>">  
                            <input type="text" name="adresse4" value="<?= $adresse_parts[3] ?>"> 
                            <input type="text" name="adresse5" value="<?= $adresse_parts[4] ?>"> 
                        </p>
                        <p>
                            Numéro de carte de crédit :
                            <input style="width:45px" type="number" name="credit1" value="<?= $credit[0] ?>"> 
                            <input style="width:45px" type="number" name="credit2" value="<?= $credit[1] ?>"> 
                            <input style="width:45px" type="number" name="credit3" value="<?= $credit[2] ?>"> 
                            <input style="width:45px" type="number" name="credit4" value="<?= $credit[3] ?>"> 
                        </p>
                    </ul>
                </div>
            

            <div class="save-container">
            
            <a href="profile.php" class="dontsave-btn">Annuler</a>
            <button type="submit" class="save-btn">Enregistrer</button>
            </div>

            </form>
        </div>
    </div>

    <div class="tail">
        <a href="accueil.php"><p>Accueil</p></a>
        <p>| Destinations | Offres spéciales | Contact | À propos</p>
    </div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fichier = 'utilisateurs.json';
    $utilisateurs = json_decode(file_get_contents($fichier), true);
    $email_session = $_SESSION['email'];

    foreach ($utilisateurs as &$u) {
        if ($u['email'] === $email_session) {

            // Récupération des champs modifiés
            $u['nom'] = $_POST['lastname'] ?? $u['nom'];
            $u['prenom'] = $_POST['firstname'] ?? $u['prenom'];
            $u['sexe'] = $_POST['sexe'] ?? $u['sexe'];
            $u['date_naissance'] = $_POST['date_naissance'] ?? $u['date_naissance'];
            $u['email'] = $_POST['email'] ?? $u['email'];
            $u['password'] = $_POST['password'] ?? $u['password'];

            // Adresse recomposée
            $adresse = implode(";", [
                $_POST['adresse1'] ?? $adresse_parts[0],
                $_POST['adresse2'] ?? $adresse_parts[1],
                $_POST['adresse3'] ?? $adresse_parts[2],
                $_POST['adresse4'] ?? $adresse_parts[3],
                $_POST['adresse5'] ?? $adresse_parts[4]
            ]);
            $u['adresse'] = $adresse;
            // CB recomposée
            $credit = implode(" ", [
                $_POST['credit1'] ?? $credit[0],
                $_POST['credit2'] ?? $credit[1],
                $_POST['credit3'] ?? $credit[2],
                $_POST['credit4'] ?? $credit[3],
            ]);
            $u['credit'] = $credit;

            // Changer l'email dans sessions si email changé
            $_SESSION['email'] = $u['email'];

            break;
        }
    }

    // Sauvegarde dans le fichier JSON
    file_put_contents($fichier, json_encode($utilisateurs, JSON_PRETTY_PRINT));

    // Redirection vers la page de profil
    header("Location: profile.php");
    exit();
}
?>
