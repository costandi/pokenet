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
	<link rel="stylesheet" href="../decors/police.css">
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
	    <div class="w3-bar w3-deep-purple">
		<button id="openNav" class="w3-button w3-xlarge w3-bold-pokefont" onclick="w3_open()">Menu</button>
		<button class="w3-button w3-xlarge w3-right w3-bold-pokefont">Deconnexion</button>
	    </div>
	    <div class="w3-container">
		FENETRE
	    </div>

	</div>
	<div id="footer" class="w3-row w3-bar w3-deep-purple w3-display-bottommiddle">
	    <div class="w3-container w3-col s3 m3 l3">
		Pseudo :
	    </div>
	    <div class="w3-container w3-col s3 m3 l3">
		Potion(s) :
	    </div>
	    <div class="w3-container w3-col s3 m3 l3">
		Pokeball(s) :
	    </div>
	    <div class="w3-container w3-col s3 m3 l3">
		Pokédollar(s) :
	    </div>
	</div>
	<style>
	.w3-pokefont {
	    font-family: 'pokemon_hollownormal';
	}

	.w3-bold-pokefont {
	    font-family: 'pokemon_solidnormal';
	}
	 body {
	     background-image: url("../decors/fondSombre.png");
	 }
	</style>
	<script>
	 function w3_open() {
	     document.getElementById("main").style.marginLeft = "25%";
	     document.getElementById("mySidebar").style.width = "25%";
	     document.getElementById("mySidebar").style.display = "block";
	     document.getElementById("openNav").style.display = 'none';
	 }
	 function w3_close() {
	     document.getElementById("main").style.marginLeft = "0%";
	     document.getElementById("mySidebar").style.display = "none";
	     document.getElementById("openNav").style.display = "inline-block";
	 }

	 function updatePokeball(newVal){
	     document.getElementById("pb").innerHTML = newVal;
	 }

	 function updatePotion(newVal){
	     document.getElementById("pt").innerHTML = newVal;
	 }

	 function updateMoney(newVal){
	     document.getElementById("mn").innerHTML = newVal;
	 }

	function updateVie(i){
		document.getElementById("vie").innerHTML = "il vous reste "+i+" pv !";
		maBarreVie.value = i;
	}

	 function updateEquipe(newVal){
	     document.getElementById("equipe").innerHTML = newVal;
	 }

	 function updatePC(newVal){
	     document.getElementById("PC").innerHTML = newVal;
	 }
	</script>
 
    </body>
</html>

