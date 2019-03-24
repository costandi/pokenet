<!DOCTYPE html>

<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Accueil</title>
	<link rel="icon" href="favicon.png">
    <link rel="stylesheet" type="text/css" href="indexstylesheet.css">

</head>


<body>

	<div class="round-button" name="boutonPokeball">
		<a href="index.php">
			<img src="pokeball.png">
		</a>
	</div>

	<h1 id="titre">Bienvenue sur pokenet !</h1>

	<div>
		<a href="https://www.pokemon.com/fr/">
			<img id="gifPika" src="pika.gif">
		</a>
	</div>


	<br/>


	<div id="content">
		<p id="resume">Pokenet est un site où vous pouvez constituer une équipe de pokemon et combattre d'autres joueurs dans le monde entier (votre salon) !</p>
	</div>

	<div id="boutons">
		<form>
			<button class="favorite styled" type="submit" formaction="inscrit.php" formmethod="POST" >Inscrivez vous !</button>
			<button class="favorite styled" type="submit" formaction="connect.php" formmethod="POST" autofocus>Connectez vous !</button>
		</form>
	</div>



	<video autoplay width="800" loop muted>
		<source src="video.webm" type="video/webm">
		Sorry, your browser doesn't support embedded videos.
	</video>



</body>

</html>
