<!DOCTYPE html>
<html lang="fr">
<title>Recherche de Voyages Volcaniques</title>
<head>
    <link rel="stylesheet" type="text/css" href="head.css">
    <link rel="stylesheet" type="text/css" href="choice.css">
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
    
    <div class="contenu">
        <h1>Rechercher un Voyage</h1>
        <form action="results.php" method="GET" class="Destination">
            <div class="Destiné">
                <label for="destination">Destination :</label>
                <input type="text" id="destination" name="destination" placeholder="Entrez une destination">
            </div>

            <div class="departure">
                <label for="departure-date">Date de départ :</label>
                <input type="date" id="departure-date" name="departure-date">
            </div>

            <div class="form-group">
                <label for="return-date">Date de retour :</label>
                <input type="date" id="return-date" name="return-date">
            </div>

            <div class="return">
                <label>Options :</label>
                <div class="options">
                    <label>
                        <input type="checkbox" name="options[]" value="hotel"> Hôtel
                    </label>
                    <label>
                        <input type="checkbox" name="options[]" value="flight"> Vol
                    </label>
                    <label>
                        <input type="checkbox" name="options[]" value="car"> Location de voiture
                    </label>
                </div>
            </div>

            <div class="research">
                <button type="submit">Rechercher</button>
            </div>
        </form>
    </div>
    <div class="tail">
    <a href="accueil.php">
        <p>Accueil</p>
    </a>
    <p>| Destinations | Offres spéciales | Contact | À propos</p>
</div>
</body>
</html>
