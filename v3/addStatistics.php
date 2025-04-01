<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<title>Page d'ajout de statistiques</title>
<style>

label{
    display: block;
    float: left;
    width: 15em;
    margin-right: 5px;
}

h1{
    text-align: center;
}

.input1 {
    display: flex;
    
    align-items: center;
    margin-bottom: 0.5em;
}
.input2 {
    display: flex;
    
    align-items: center;
    margin-bottom: 0.5em;
}
.inputs {
    display: grid;
    flex-grow: 1;
}


input[type="submit"]{
    display : flex;
    padding: 0.4em;
    width :8em;
    align-self : center;
}

</style>
<head>
    
    <meta charset="UTF-8">
</head>
<body>
    <h1>Quel joueur voulez-vous ajouter ?</h1>
<form method="post" action="">
    <div class="NP">
    <label for="joueur">Choisissez un joueur :</label>
    <select name="joueur" id="pays">
    <?php
        $myfile = fopen("infoJoueur.txt", "r") or die("Unable to open
        file!");
        while(!feof($myfile)) {
            
            $parts=explode(";",fgets($myfile));
            if($parts[0]===""){
                break;
            }
            echo "<option>$parts[0];$parts[1]</option>";
            
        }
        fclose($myfile);
    ?>
    </select>

    <div class="inputs">
        <div class="input1"><label>Nombre de buts marqués :</label><input type="number" name="goals"><br></div>
        <div class="input2"><label>Temps joué :</label><input type="number" name="playedTime"><br></div>
    </div>
    <input type="submit" value="Envoyer">
</form>

<?php
$joueur = $_POST['joueur'];
$goals = $_POST['goals'];
$playedTime = $_POST['playedTime'];
if (empty($joueur) || empty($goals) || empty($playedTime) ) {
echo "Merci de remplir tout les champs";
} 
else {
        
    $myfile = fopen("allStatistics.txt", "a") or die("Unable to open
    file!");
    fprintf($myfile, "%s;%d;%f\n", $joueur, $goals, $playedTime);
    fclose($myfile);
    $_SESSION["joueur"] = "$joueur";
    $_SESSION["goals"] = "$goals";
    $_SESSION["playedTime"] = "$playedTime";
    header("Location: ../saveStatistics.php");
    exit(); 

}




?>

</body>
</html>
