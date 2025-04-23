<!DOCTYPE html>
<?php/*
if (!isset($_SESSION['email'])) {
    header('Location: accueil.php');
    exit();    
    }*/
?>
<html lang="fr">
<head>
    <title>Info réservations utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="../head.css">
    <link rel="stylesheet" type="text/css" href="users-res_info.css">
    <meta charset="UTF-8">
</head>
<body>
<div class="head">
        <a href="../accueil.php">
            <img src="../VolcanFly.jpg" alt="Accueil">
        </a>
        <div></div>
        <div class="headers">
            
            <ul>
                <li><a href="../accueil.php">Accueil</a></li>
                <li><a href="../reg.php">Inscription</a></li>
                <li><a href="../log.php">Connexion</a></li>
                <li><a href="../choice.php">Voyages</a></li>
                <li><a href="../aides.php">Aides</a></li>
                
            </ul>
        </div>
    </div>
    
    <div></div>

    <div class="table">
        <div class="side">
            <button onclick="window.location.href='../admin.php'">Dashboard</button>
            <button onclick="window.location.href='users_info.php'">Gestions des utilisateurs</button>
            <button style="background-color: #bdbdbd7e;">Réservations</button>
            <button onclick="window.location.href='payments_info.php'">Paiements</button>
        </div>
        <div class="Principal">
            
            <div class="stat-box">
                    <h2>Réservations</h2>
                    <p>🛫 340 réservations ce mois</p>
            </div>
            <div class="users-tool">
                <div class="research-users">

                    <input type="text" class="search-box" placeholder="Rechercher un utilisateur...">
                    <button class="search-button">🔍</button>

                </div>
                <table>
                    <thead>
                        <tr>
                            <th>N°d'utilisateur</th>
                            <th>Destination</th>
                            <th>Lieu</th>
                            <th>Référence hôtel</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>123456789</td>
                            <td>Réunion</td>
                            <td>une ville</td>
                            <td>987654321</td>
                            <td><button>annuler/réserver</button></td>
                        </tr>
                        <tr>
                            <td>123456789</td>
                            <td>Réunion</td>
                            <td>une ville</td>
                            <td>987654321</td>
                            <td><button>annuler/réserver</button></td>
                        </tr>
                        <tr>
                            <td>123456789</td>
                            <td>Réunion</td>
                            <td>une ville</td>
                            <td>987654321</td>
                            <td><button>annuler/réserver</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

                    
                    
    </div>
            
        
    </div>
    <div class="tail">
        <a href="../accueil.php">
            <p>Accueil</p>
        </a>
        <p>| Destinations | Offres spéciales | Contact | À propos</p>
    </div>

</body>
</html>

                    




