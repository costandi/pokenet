<?php
session_start();
include '../bdd.php';
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
	<link rel="stylesheet" href="../decors/police.css">
	<style>
	 .w3-pokefont {
	     font-family: 'pokemon_hollownormal';
	 }

	 .w3-bold-pokefont {
	     font-family: 'pokemon_solidnormal';
	 }
	</style>
	
    </head>
    <body background="../decors/fondSombre.png" class="w3-text-white w3-center">
    <div class="w3-bar w3-center">
		<a class="w3-bar-item w3-button w3-round" href="index.php" style="width:10%; height: 10%;">
		    <img class="w3-round" src="../decors/pokeball.png" style="width:100%; height: 100%;">
		</a>
		<h1 class="w3-bar-item w3-pokefont w3-xxxlarge">Bienvenue sur Pokenet !</h1>
		<!-- <div>
		     <a href="easter.html">
		     <img id="gifPika" src="../decors/pika.gif">
		     </a>
		     </div>
		     <br/>-->
	</div>
	<div id="content">
	    <p id="resume" class="w3-xlarge">Pokenet est un site où vous pouvez constituer une équipe de pokemon et combattre d'autres joueurs du monde entier depuis votre salon (ou votre chambre si vous voulez! )</p>
	</div>
	
	<div id="boutons">
	    <form>
		<button class="w3-button w3-deep-purple w3-hover-purple w3-xlarge" type="submit" formaction="inscrit.php" formmethod="POST" >Inscrivez vous !</button>
		<button class="w3-button w3-deep-purple w3-hover-purple w3-xlarge" type="submit" formaction="connect.php" formmethod="POST" autofocus>Connectez vous !</button>
	    </form>
	</div>
	<div class="w3-content w3-black w3-opacity-min">
	    <p><span class="w3-tag w3-blue w3-bold-pokefont w3-large">New!</span> Nouveau theme : Sombre</p>
	    <p><span class="w3-tag w3-teal w3-bold-pokefont w3-large">More Later!</span> Combat en multijoueur!</p> 
	</div>
    </body>

</html>
