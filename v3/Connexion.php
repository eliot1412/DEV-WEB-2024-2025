<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<title>Page de connexion</title>
<style>

label{
    display: block;
    float: left;
    width: 8em;
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
    <h1>Connexion :</h1>
<form method="post" action="<?php echo $_SERVER['Verfification'];?>">
    <div class="NMDP">
    <div class="inputs">
        <div class="input1"><label>Utilisateur :</label><input type="text" name="Username"><br></div>
        <div class="input2"><label>Mot de passe :</label><input type="password" name="Password"><br></div>
    </div>
    <input type="submit" value="Envoyer">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// collect value of input field
$username = $_REQUEST['Username'];
$mdp = $_REQUEST['Password'];
if (empty($username) || empty($mdp) ) {
echo "Merci de remplir les champs";
} 
    else {
        $_SESSION["mdp"] = "$mdp";
        $_SESSION["username"] = "$username";
        header("Location: Verification.php");
        exit();


    }
}
?>

</body>
</html>
