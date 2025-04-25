<!DOCTYPE html>
<?php 
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: log.php');
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
            $isadmin = false;
            if ($u['admin']==1) {
                $isadmin=true;
            
            }
            $credit_croped = '**** **** **** ' . substr($u['credit'], -4);
            $adresse = $u['adresse'];
            $adresse_parts = explode(';', $adresse);

        }
    }

    if (!$email_trouve) {
        echo "<p style='color:red; text-align:center;'>Email introuvable.</p>";
    }

?>
<html lang="fr">
<head>
    <title>Page de profile</title>
    <link rel="stylesheet" type="text/css" href="head.css">
    <link rel="stylesheet" type="text/css" href="profile.css">
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
                <?php if ($isadmin === true) { ?>
                <li><a href="admin.php">Page administrateur</a></li>
                <?php } ?>
                
                

            </ul>



        </div>

        <a href="profile.php">
            <img src="pp.jpg" alt="profile">
            </a>
    </div>
    

    <div class="table">
        
                <div class="side"> 
                    <p>&nbsp;</p>  
                    
                </div>
            
            
                <div class="Principal">
                    <div class="change">
                        <button>
                            <img src="pencil.jpg" alt="Modifier">
                        </button>
                    </div>
                    <div class="profile">
                        
                        
                            <div class="pp"><img src="pp.jpg" alt="Photo de profile"></div><h1><b><?php print($nom .' '. $prenom) ?></b></h1>
                            
                        
                    </div>

                    <div class="personal_data">
                        <ul>
                            <h1>Données personnelles :</h1>
                            <p>Sexe : <?php print($sexe) ?></p>
                            <p>Date de naissance : <?php print($date_naissance) ?></p>
                            <p>Adresse email : <?php print($email) ?></p>
                            <p>Mot de passe : <?php echo str_repeat('*', strlen($password)); ?></p>
                            
                        </ul>
                    </div>

                    <div class="pay_data">
                        <ul>
                            <h1>Information de paiement :</h1>
                            <p>Adresse de facturation : <?php print($adresse_parts[0].' '.$adresse_parts[1].' '.$adresse_parts[2].' | '.$adresse_parts[3].'  | '.$adresse_parts[4]); ?>
                            <p>Carte banquaire enregistrée : <?php print($credit_croped) ?>
                        </ul>
                    </div>

                    </form>
                    <!-- Bouton Déconnexion -->
                    <div class="logout-btn-container">
                        <a href="logout.php" class="logout-btn">
                            Se déconnecter
                        </a>
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

