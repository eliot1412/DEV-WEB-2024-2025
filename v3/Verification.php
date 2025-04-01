<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<title>Page de véfication de logs utilisateur</title>
<head>
    
    <meta charset="UTF-8">
</head>
<body>
    <h1>Veuillez patienter...</h1>

    <?php
$countj=0;
$countc=0;
$count=0;
$myfile = fopen("Identifier.txt", "r") or die("Unable to open
        file!");
        while(!feof($myfile)) {
            $line = trim(fgets($myfile));
            $parts=explode(";",$line);
            if($parts[0]===""){
                break;
            }
            if($parts[0]==$_SESSION["username"] && $parts[1]==$_SESSION["mdp"] ){
                $count += 1;
                if($parts[2]=="entraineur"){
                    $countc += 1;
                }
                else{
                    $countj += +1;
                }
            }
            

            
        }
        fclose($myfile);

    if($count == 1){
        echo "Bons identifiants";
        sleep(1);
            if($countc==1){
                header("Location: Accueil.html");
                exit();
            }
            else{
                header("Location: searchStatistics.php");
                exit();
            }
        
    }
    else{
        
        echo "Mauvais identifiants";
        sleep(1);
        header("Location: ../Connexion.php");
        exit();
    }

?>

</body>
</html>