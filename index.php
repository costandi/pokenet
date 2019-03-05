<!DOCTYPE html>

<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Connexion</title>
</head>


<body>
	<h1>Bienvenue sur pokenet !</h1>
	<p>Pokenet est un site où vous pouvez constituer une équipe de pokemon et combattre d'autres joueurs dans le monde entier (votre salon) !</p>

	<form>
		<button class="favorite styled" type="submit" formaction="inscrit.php" formmethod="POST" >Inscrivez vous !</button>
		<button class="favorite styled" type="submit" formaction="connect.php" formmethod="POST" >Connectez vous !</button>
	</form>

	<img id="gifPika" src="pika.gif">

</body>

</html>


<style type="text/css">

/*

* {
	padding: 0;
	margin: 0;
}
*/

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

#gifPika {
	width: 70px;
	height: 70px;
}

</style>