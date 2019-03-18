<?php
if (isset($_POST["connexion"]) && isset($_POST["nom"]))
{
	echo "connecté";
	echo "<p>Bienvenue ".$_POST["nom"]." !</p>";
	/*lien vers le jeu en php*/
}
else if (isset($_POST["connexion"]) && !isset($_POST["nom"])) 
{
	echo "erreur de connexion";
	/*lien vers l'accueil en prevenant pourquoi*/
}

if (isset($_POST["inscription"]))
{
	echo "inscrit sous le nom de ".$_POST["nom"]." ! ton mdp est ".$_POST["mdp"];
}

else if (isset($_POST["inscription"]) && !isset($_POST["connexion"]))
{
	echo "erreur d'inscription";
}


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="round-button" name="boutonPokeball">
		<a href="index.php">
			<img src="pokeball.png">
		</a>
	</div>
</body>
</html>



<style type="text/css">

.round-button {
	position: relative;
	margin:5px;
	width: 80px;
	height: 0;
	padding-bottom: 80px;
	border-radius: 50%;
	border: 2px solid #f5f5f5;
	overflow: hidden;
	background: #464646;
	box-shadow: 0 0 3px gray;
}
.round-button:hover {
	background: red;
}
.round-button img {
	display: block;
	width: 77px;
	padding: 0;
	height: auto;
}

</style>