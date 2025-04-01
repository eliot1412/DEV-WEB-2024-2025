<?php session_start();?>
<!DOCTYPE html>
<html>
<title>Enregistrement du joueur...</title>
<meta charset="UTF-8">
<body>
<?php
        $fichier = fopen("infoJoueur.txt", "a");
        if ($fichier) {
            fprintf($fichier, "%s;%s;%s;%s\n", $_SESSION["name"], $_SESSION["firstname"], $_SESSION["date"], $_SESSION["where"]);
            fclose($fichier);
        } else {
            echo "Erreur lors de l'ouverture du fichier.";
        }
    
      
    
?>
    
    <p>Votre joueur a bien été ajouté!</p>
    <a href="addPlayer.php">
        <p>Revenir en arrière.</p>
    </a>
</body>
</html>
