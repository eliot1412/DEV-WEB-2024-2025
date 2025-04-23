<!DOCTYPE html>
<?php/*
if (!isset($_SESSION['email'])) {
    header('Location: accueil.php');
    exit();    
    }*/
?>
<html lang="fr">
<head>
    <title>Info paiements utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="../head.css">
    <link rel="stylesheet" type="text/css" href="payments_info.css">
    <meta charset="UTF-8">
</head>
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
            <button onclick="window.location.href='reservations_info.php'">Réservations</button>
            <button style="background-color: #bdbdbd7e;">Paiements</button>
        </div>
        <div class="Principal">
            
            <div class="stat-box">

                <div class="stat1">
                    <h2>Coûts</h2>
                    <p>💰 100 000 € dépensés</p>
                </div>

                <div class="stat2">
                    <h2>Revenus</h2>
                    <p>💰 125 000 € générés</p>
                </div>

                <div class="stat3">
                    <h2>Bénéfices</h2>
                    <p>💰 25 000 € gagnés</p>
                </div>
                
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
                            <th>RIB</th>
                            <th>Prélèvements en cours</th>
                            <th>Prélèvements précédents</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>123456789</td>
                            <td>000000000000000</td>
                            <td>aucun</td>
                            <td>aucun</td>
                            <td><button>prélever</button></td>
                        </tr>
                        <tr>
                            <td>123456789</td>
                            <td>000000000000000</td>
                            <td>2</td>
                            <td>1</td>
                            <td><button>prélever</button></td>
                        </tr>
                        <tr>
                            <td>123456789</td>
                            <td>000000000000000</td>
                            <td>1</td>
                            <td>0</td>
                            <td><button>prélever</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

                        
                        
    </div>
            
        
    </div>
    <div class="tail">
        <a href="../accueil.html">
            <p>Accueil</p>
        </a>
        <p>| Destinations | Offres spéciales | Contact | À propos</p>
    </div>
</body>
</html>

                    




