<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="head.css">
    <link rel="stylesheet" type="text/css" href="reglog.css">
</head>
<body>

    <div class="head">
        <a href="accueil.html">
            <img src="VolcanFly.jpg" alt="Accueil">
        </a>
        <div></div>
        <div class="headers">
            
            <ul>
                <li><a href="accueil.html">Accueil</a></li>
                <li><a href="reg.html">Inscription</a></li>
                <li><a href="log.html">Connexion</a></li>
                <li><a href="choice.html">Voyages</a></li>
                <li><a href="aides.html">Aides</a></li>
                
            </ul>
        </div>
    </div>
  

    <div class="title">
        <h1>Connectez-vous pour profiter pleinement de VolcanFly</h1>
    </div>

    <div class="info" id="log">
        <form action="proce.php" method="post">

            <div class="input-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" />
            </div>
            <p></p>


            <div class="input-group">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" size="20" maxlength="15" />
            </div>
            <p></p>


            <div class="button-group">
                <button type="button">Envoyer</button><br>
            </div>
            
            <p></p>
            <div class="changep">
                <p>Vous n'avez pas de compte?</p><pre> </pre><a href="reg.html"><p>Inscrivez vous</p></a>
            </div>

        </form>
    </div>

    <div class="tail">
        <a href="accueil.html">
            <p>Accueil</p>
        </a>
        <p>| Destinations | Offres spéciales | Contact | À propos</p>
    </div>

</body>
</html>
