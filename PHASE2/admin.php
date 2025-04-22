<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Gestion société/site</title>
    <link rel="stylesheet" type="text/css" href="head.css">
    <link rel="stylesheet" type="text/css" href="admin.css">
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
                
            </ul>
        </div>
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

                    




