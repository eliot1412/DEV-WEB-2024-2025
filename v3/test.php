

<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
<body>
<form method="post" action="bonjour.php">
<label>Quel est votre nom? <input type="text" name="nom"></label><br>    
Quel est votre prénom <input type="text" name="firstname"> <br>
Quel est votre date de naissance ?<input type="date" name="date">
<br> <input type="submit" value="Envoyer">
</form>
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
// collect value of input field


$name = $_REQUEST['nom'];
if (empty($name)) {
echo "Name is empty<br>";
} else {
echo $name;
}

$firstname = $_REQUEST['firstname'];
if (empty($firstname)) {
echo "Firstame is empty <br>";
} else {
echo $firstname;
}


$date = $_REQUEST['date'];
if (empty($date)) {
echo "Date is empty <br>";
} else {
echo $date;
}



// Set session variables
$_SESSION["name"] = "$name";
$_SESSION["age"] = "$age";
echo "Session variables are set.";


}

?>
</body>