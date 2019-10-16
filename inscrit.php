<?php
session_start();
include './bdd.php';
if(isset($_POST['deco']))
{
    $BDD = GenerBDD();
    setDateDeconnexion($BDD, $_SESSION['ID']);
    fermerBDD($BDD);
    session_destroy();
    $_SESSION=array();
    
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
	<meta charset="utf-8">
	<title> Pokenet ! </title>
	<link rel="icon" href="../decors/favicon.png">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="./decors/police.css">
	<style>
	 .w3-pokefont {
	     font-family: 'pokemon_hollownormal';
	 }

	 .w3-bold-pokefont {
	     font-family: 'pokemon_solidnormal';
	 }
	</style>
	
    </head>
    <body background="./decors/fondSombre.png" class="w3-text-white w3-center">
	<div class="w3-bar w3-center">
		<a class="w3-bar-item w3-button w3-round" href="index.php" style="width:10%; height: 10%;">
		    <img class="w3-round" src="./decors/pokeball.png" style="width:100%; height: 100%;">
		</a>
		<h1 class="w3-bar-item w3-pokefont w3-xxxlarge w3-display-topmiddle">Inscrivez-vous!</h1>
		<!-- <div>
		     <a href="easter.html">
		     <img id="gifPika" src="../decors/pika.gif">
		     </a>
		     </div>
		     <br/>-->
	</div>

	<form class ="w3-center" action="traitement.php" method="POST">
		<input  class="w3-hover-purple" type="text" required placeholder="Pseudo" name="nom" autofocus> <br/><br/>
		<input class="w3-hover-purple" type="password" required placeholder="Mot de passe" name="mdp" id="password"> <br/><br/>
		<input  class="w3-hover-purple" type="password" required placeholder="Répètez le mot de passe" id="confirm_password"> <br/><br/>

		<input class="w3-button w3-deep-purple w3-hover-purple w3-xlarge" type="submit" value="S'inscrire" name="inscription">

	</form>
    </body>

    <script>
	 var password = document.getElementById("password");
	 var confirm_password = document.getElementById("confirm_password");

	 function validatePassword(){
	     if(password.value != confirm_password.value) {
		 confirm_password.setCustomValidity("Vos mots de passe ne sont pas identiques!");
	     } else {
		 confirm_password.setCustomValidity('');
	     }
	 }

	 password.onchange = validatePassword;
	 confirm_password.onkeyup = validatePassword;

</script>

</html>