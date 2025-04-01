<?php session_start();?>
<!DOCTYPE html>
<html>
<title>recherche du joueur</title>
<meta charset="UTF-8">
<body>
<?php
$file=$_POST["nom"]."_".$_POST["prénom"].".txt";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["prénom"])||empty($_POST["nom"])) {
    echo "Erreur de saisie";
    }elseif(!file_exists($file)){
        echo "le fichier de statistique n'a pas été créé pour ce joueur\n";
    }else{

    
        $myfile = fopen($file, "r") or die("Unable to open
        file!");
        echo "Nom|Prénom|Nombre de but|Temps joué :<br>";
        while(!feof($myfile)) {
            $parts=explode(";",fgets($myfile));
            if($parts==""){
                break;
            }else{
                foreach ($parts as $value) {
                    echo $value . " "; 
                }
            }
        }
        fclose($myfile);


    }

}else{
    echo"Ereur de redirections";
}

      
    
?>
    
    
    <a href="searchStatistics.php">
        <p>Revenir en arrière.</p>
    </a>
</body>
</html>
