<?php session_start();?>
<!DOCTYPE html>
<html>
<title>Enregistrement des statistiques...</title>
<meta charset="UTF-8">
<body>
<?php
        $temp=$_SESSION["joueur"];
        $parts=explode(";",$temp);
        $temp2=$parts[0]."_".$parts[1];
        $fichier = fopen("$temp2.txt", "a");
        if ($fichier) {
            fprintf($fichier, "%s;%d;%f min\n", $_SESSION["joueur"], $_SESSION["goals"], $_SESSION["playedTime"]);
            fclose($fichier);
        } else {
            echo "Erreur lors de l'ouverture du fichier.";
        }
    
      
?>
    
    <p>Vos statistiques ont bien été ajoutées!</p>
    <a href="addStatistics.php">
        <p>Revenir en arrière.</p>
    </a>
</body>
</html>
