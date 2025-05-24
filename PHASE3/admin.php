<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: accueil.php');
    exit();    
    }
    $fichier = 'utilisateurs.json';
    if (!file_exists($fichier)) {
        echo "<p style='color:red; text-align:center;'>Erreur.</p>";
        exit();
    }

    $utilisateurs = json_decode(file_get_contents($fichier), true);

    foreach ($utilisateurs as $u) {
        if ($u['email'] === $_SESSION['email']) {
            $email_trouve = true;
            if($u['admin'] == 0) {
                header('Location: accueil.php');
                exit();
            } else {
                $isadmin = true;
                
            }
        }
    }


?>
<html lang="fr">
<head>
    <title>Gestion société/site</title>
    <link rel="stylesheet" type="text/css" href="head.css">
    <link rel="stylesheet" type="text/css" href="admin.css">
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
    
    <div></div>

    <div class="table">
        <div class="side">
            <button style="background-color: #bdbdbd7e;">Dashboard</button>
            <button onclick="window.location.href='admin/users_info.php'">Gestions des utilisateurs</button>
            <button onclick="window.location.href='admin/reservations_info.php'">Réservations</button>
            <button onclick="window.location.href='admin/payments_info.php'">Paiements</button>
        </div>
        <div class="Principal">

        <div class="alert-box" style="margin: 20px; padding: 15px; background-color: #fff3cd; border: 1px solid #ffeeba; border-radius: 8px; color: #856404;">
        <strong>Note :</strong><br>
        Cette page est en cours de développement et ne contient pas encore de fonctionnalités utiles.<br>
        Elle n'est pas prévue dans le cahier des charges actuel.<br>
        Veuillez consulter l'onglet <strong>Gestion des utilisateurs</strong> pour les fonctionnalités disponibles.<br>
        Merci de votre compréhension.
        </div>
            
            <div class="stats">
                <div class="stat-box">
                    <h2>Utilisateurs</h2>
                    <p>📌 1 250 inscrits</p>
                </div>
                <div class="stat-box">
                    <h2>Réservations</h2>
                    <p>🛫 340 réservations ce mois</p>
                </div>
                <div class="stat-box">
                    <h2>Revenus</h2>
                    <p>💰 125 000 € générés</p>
                </div>
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

                    




