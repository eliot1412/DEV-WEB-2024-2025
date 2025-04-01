<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
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
  

    <div class="Centre">
        <div class="title">
            <h1>Inscrivez-vous pour profiter du meilleur de VolcanFly</h1>
        </div>

        <div class="info">
            <form action="" method="post">

                <div class="input-group">
                    <label for="fname">Nom :</label>
                    <input type="text" id="fname" name="fname" />
                </div>
                <p></p>

                <div class="input-group">
                    <label for="lname">Prénom :</label>
                    <input type="text" id="lname" name="lname" />
                </div>
                <p></p>

                <div class="input-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" />
                </div>
                <p></p>

                <div class="input-group">
                    <label for="date">Date de naissance :</label>
                    <input type="date" id="date-day" name="date"/>
                </div>
                <p></p>
                
                <div class="input-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password1" size="20" maxlength="15" />
                </div>
                <p></p>


                <div class="input-group">
                    <label for="password">Confirmer votre mot de passe :</label>
                    <input type="password" name="password" size="20" maxlength="15" />
                </div>
                <p></p>

                <div class="button-group">
                    <button type="submit">Envoyer</button><br>
                </div>


                <p></p>
       
            </form>
            
                            <div class="changep">
                    <p>Vous avez déjà un compte?</p><pre> </pre><a href="log.php"><p>Connectez vous</p></a>
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
<?php   

                    $name = $_POST['lname'];
                    $firstname = $_POST['fname'];
                    $firstname = $_POST['email'];
                    $date = $_POST['date'];
                    $password1 = $_POST['password1'];
                    $password = $_POST['password'];
                    
                    if (empty($name) || empty($firstname) || empty($date) || empty($where) ) {
                    echo "<p> Merci de remplir tout les champs</p>";
                    } else if ( $password1!=$password ) {
                        echo "<p> mauvais mot de passe</p>";
                        } 

                        else {
                            
                            
                            


                    }

                ?>
