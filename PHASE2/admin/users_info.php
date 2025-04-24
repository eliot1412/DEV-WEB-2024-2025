<!DOCTYPE html>
<?php
session_start();
/*if (!isset($_SESSION['email'])) {
    header('Location: ../accueil.php');
    exit();    
    }*/
    $fichier = '../utilisateurs.json';
    if (!file_exists($fichier)) {
        echo "<p style='color:red; text-align:center;'>Erreur.</p>";
        exit();
    }

    $utilisateurs = json_decode(file_get_contents($fichier), true);

    foreach ($utilisateurs as $u) {
        if ($u['email'] === $_SESSION['email']) {
            $email_trouve = true;
            if($u['admin'] == 0) {
                header('Location: ../accueil.php');
                exit();
            } else {
                $isadmin = true;
                
            }
        }
    }


?>
<html lang="fr">
<head>
    <title>Gestions utilisateurs</title>
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
        <a href="../profile.php">
            <img src="../pp.jpg" alt="profile">
            </a>
    </div>
    
    <div></div>

    <div class="table">
        <div class="side">
            <button onclick="window.location.href='../admin.php'">Dashboard</button>
            <button style="background-color: #bdbdbd7e;">Gestions des utilisateurs</button>
            <button onclick="window.location.href='reservations_info.php'">Réservations</button>
            <button onclick="window.location.href='payments_info.php'">Paiements</button>
        </div>
        
        <div class="Principal">
            
                <div class="stat-box">
                    <h2>Utilisateurs</h2>
                    <p>📌 1 250 inscrits</p>
                </div>
                <div class="users-tool">
                    <div class="research-users">

                        <input type="text" class="search-box" placeholder="Rechercher un utilisateur...">
                        <button class="search-button">🔍</button>
    
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Nom-Prénom</th>
                                <th>N°d'utilisateur</th>
                                <th>Âge</th>
                                <th>Email</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Mr.X</td>
                                <td>123456789</td>
                                <td>101</td>
                                <td>jean.dupont@email.com</td>
                                <td><button>ban/unban</button></td>
                            </tr>
                            <tr>
                                <td>Mr.Y</td>
                                <td>123456789</td>
                                <td>100</td>
                                <td>jean.dupont@email.com</td>
                                <td><button>ban/unban</button></td>
                            </tr>
                            <tr>
                                <td>Mr.Z</td>
                                <td>123456789</td>
                                <td>99</td>
                                <td>jean.dupont@email.com</td>
                                <td><button>ban/unban</button></td>
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

                    




