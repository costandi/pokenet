<!DOCTYPE html>

<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Connexion</title>
</head>


<body>
	<div class="round-button">
		<a href="index.php">
			<img src="pokeball.png" />
		</a>
	</div>

	<h1 id="titre" >Bienvenue sur pokenet !</h1>

	<div id="content">
		<p id="resume" >Pokenet est un site où vous pouvez constituer une équipe de pokemon et combattre d'autres joueurs dans le monde entier (votre salon) !</p>
	</div>
	<form>
		<button class="favorite styled" type="submit" formaction="inscrit.php" formmethod="POST" >Inscrivez vous !</button>
		<button class="favorite styled" type="submit" formaction="connect.php" formmethod="POST" autofocus>Connectez vous !</button>
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


#titre {
	position: fixed;
	top: 0px;
	left: 120px;
	width: 300px;
	/*border: 3px solid #73AD21;*/
}

#content {
	border-radius: 5px;
	border: 3px solid red;
	margin: 10px;
	margin-right: 900px;
	padding-left: 5px;
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
	width: 80px;
	padding: 0px;
	height: auto;
}

#gifPika {
	width: 70px;
	height: 70px;
}

</style>