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
		<h1 class="w3-bar-item w3-pokefont w3-xxxlarge w3-display-topmiddle">Connectez-vous!</h1>
		<!-- <div>
		     <a href="easter.html">
		     <img id="gifPika" src="../decors/pika.gif">
		     </a>
		     </div>
		     <br/>-->
	</div>

	<form action="traitement.php" method="POST">
		<input type="text" required placeholder="Pseudo" name="nom" autofocus> <br/><br/>
		<input type="password" required placeholder="mot de passe" name="mdp"> <br/><br/>
		<input class="w3-button w3-deep-purple w3-hover-purple w3-xlarge" type="submit" value="se connecter" name="connexion">
	</form>
    </body>