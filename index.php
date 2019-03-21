<!DOCTYPE html>

<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Accueil</title>
	<link rel="icon" href="favicon.png">
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





<style type="text/css">



* {
	padding: 0;
	margin: 0; 
}

body {

	background: url("fond.jpg") no-repeat;
}

#resume {
	font-size: 22px;
}

#titre {
	position: relative;
	top: 5px;
	text-align: center;
	width: 33%;
	margin-left: 33%;
	border: 4px solid red;
	border-radius: 7px;
	padding: 10px;
}

#gifPika {
	width: 70px;
	height: 70px;
	position: fixed;
	top: 5px;
	right: 5px;
}

#gifPika:hover {
	background-color: rgba(255,0,30,0.5);

}

#content {
	margin: 10px;
	margin-right: 0px;
	padding-left: 5px;
}

#resume {
	text-shadow: 1px 1px 2px black; 
	text-align: center;
	text-transform: 
}

.styled {
	border: 0;
	line-height: 2.5;
	padding: 0 20px;
	font-size: 1rem;
	text-align: center;
	color: #fff;
	text-shadow: 1px 1px 1px #000;
	border-radius: 10px;
	background-color: rgba(220, 0, 0, 1);
	background-image: linear-gradient(to top left,
		rgba(0, 0, 0, .2),
		rgba(0, 0, 0, .2) 30%,
		rgba(0, 0, 0, 0));
	box-shadow: inset 2px 2px 3px rgba(255, 255, 255, .6),
	inset -2px -2px 3px rgba(0, 0, 0, .6);

}

.styled:hover {
	background-color: rgba(255, 0, 0, 1);
}

.styled:active {
	box-shadow: inset -2px -2px 3px rgba(255, 255, 255, .6),
	inset 2px 2px 3px rgba(0, 0, 0, .6);
}

.round-button {
	position: fixed;
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



#boutons {
	position: relative;
	margin-top: 100px;
	top: 25%;
	margin-left : 40%;
}

video {
	position: relative;
	margin-top: 40px;
	margin-left: 25%; 
}

</style>