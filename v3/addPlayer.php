<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<title>Page d'ajout de joueur</title>
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
    width : width: 8em;
    align-self : center;
}

</style>
<head>
    
    <meta charset="UTF-8">
</head>
<body>
    <h1>Quel joueur voulez-vous ajouter ?</h1>
    <form method="post" action="">
    <div class="NMDP">
    <div class="inputs">
        <div class="input1"><label>Nom du joueur :</label><input type="text" name="Name"><br></div>
        <div class="input2"><label>Prénom du joueur :</label><input type="text" name="Firstname"><br></div>
        <div class="input2"><label>Dat de naissance du joueur :</label><input type="date" name="Date"><br></div>
        <div class="input2"><label>Position du joueur :</label><input type="text" name="Where"><br></div>
    </div>
    <input type="submit" value="Envoyer">
</form>

<?php
$name = $_POST['Name'];
$firstname = $_POST['Firstname'];
$date = $_POST['Date'];
$where = $_POST['Where'];
if (empty($name) || empty($firstname) || empty($date) || empty($where) ) {
echo "Merci de remplir tout les champs";
} 
    else {
        $_SESSION["name"] = "$name";
        $_SESSION["firstname"] = "$firstname";
        $_SESSION["date"] = "$date";
        $_SESSION["where"] = "$where";
        header("Location: ../savePlayer.php");
        exit();


    }

?>

</body>
</html>
