<!DOCTYPE html>
<?php $BDD = GenerBDD();

if(!isset($_SESSION['ID']))
{
	header( "refresh:5;url=connect.php" );
	die("vous devez vous connecter !");
}

 $un = getUsername($BDD, $_SESSION["ID"]);
 $pb = getPokeball($BDD, $_SESSION["ID"]);
 $pt = getPotion($BDD, $_SESSION["ID"]);
 $mn = getMoney($BDD, $_SESSION["ID"]);

fermerBDD($BDD); ?>

<html>
    <head>
	<title>Pokenet!</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="./decors/police.css">
    </head>
    <body class="w3 container w3-text-white">
	<div class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-right w3-black w3-text-white" style="display:none;" id="mySidebar">
	    <button class="w3-bar-item w3-button w3-large w3-bold-pokefont" onclick="w3_close()">Fermer &times;</button>
	    <ul>
      		<li><p><a href="jeu.php">Accueil</a></p></li>
      		<li><p><a href="combat.php">Se promener</a></p></li>
      		<li><p><a href="magasin.php">Magasin</a></p></li>
      		<li><p><a href="gestion.php">Gerez son équipe</a></p></li>
      		<li><p><a href="pokedex.php">Voir le pokedex</a></p></li>
	    </ul>
	</div>

	<div id="main">
	    <header class="w3-bar w3-deep-purple">
			<button id="openNav" class="w3-button w3-xlarge w3-bold-pokefont w3-bar-item" onclick="w3_open()">Menu</button>

			<form method='POST' action='index.php'>
			    <input type='submit' value='Déconnexion' id='deco' name='deco'class="w3-button w3-xlarge w3-bold-pokefont w3-bar-item w3-right"/>
			</form> 
	    </header>
	    <div class="w3-container">