<?php
session_start();
include_once './bdd.php';
$BDD = GenerBDD();

$dejaJoue = dejaJoue($BDD, $_SESSION['ID']);

// echo $dejaJoue;

if ($dejaJoue == 1 || !isset($_SESSION['ID'])) {
	header('Location: jeu.php');
}

?>
<div id="speach">
		<p id="texte"></p>
	<div id="choix">

	</div>
	<button id="next" onclick="ecrire()">Suivant</button>
</div>

<script type="text/javascript">
	var text = 1;
	let next = document.getElementById("next");
	let txt = document.getElementById("texte");
	let div = document.getElementById("choix");
	let bulb = document.getElementById("bulb");
	let sala = document.getElementById("sala");
	let cara = document.getElementById("cara");

	txt.innerHTML="Bonjour ! Et bienvenue dans le monde de Pokenet !";

	function add()
	{
		text += 1;
	}

	function ecrire()
	{

		if (text == 1)
		{
			txt.innerHTML="Tu es ici sur un site révolutionaire (enfin, on y travaille) de combat de Pokémons !";
		}

		if (text == 2)
		{
			txt.innerHTML="Je me présente : je suis le professeur Tilleul mais ici tout le monde m'appelle Professeur !";
		}

		if (text == 3)
		{
			txt.innerHTML="Tu le sais sûrement déjà mais le monde est impitoyable et l'alcool n'est pas une solution... Il faut se battre !";
		}
		
		if (text == 4)
		{
			txt.innerHTML="Mais déjà un premier obstacle ! Et de taille !";
		}

		if (text == 5)
		{
			txt.innerHTML="Tu vas devoir choisir entre trois bêtes féroces !";
		}

		if (text == 6)
		{
			next.style.visibility = 'hidden';
			txt.innerHTML="Choisis bien !";
			div.innerHTML+=
			"<button id='bulb' onclick='ecrire(), start(1)'>Bulbizare</button>"+
			"<button id='sala' onclick='ecrire(), start(4)'>Salameche</button>"+
			"<button id='cara' onclick='ecrire(), start(7)'>Carapuce</button>";
		}

		if (text == 7)
		{
			next.style.visibility = 'visible';
			div.innerHTML="";
			txt.innerHTML="Ce choix est sans doute le meilleur que tu aies pu faire ! (Moi j'aurais pas fais ça...)";
		}

		if (text == 8)
		{
			txt.innerHTML="Ton aventure Pokenet est sur le point de commencer !";
		}

		if (text == 9)
		{
			txt.innerHTML="Fais tes valises, ta mère te jette à la rue, tu as 10 ans, bon courage !";
		}

		if (text == 10)
		{
			window.location.replace("jeu.php");
		}

		add();
	}

	function start(i)
	{
		var xhr = new XMLHttpRequest();

		xhr.open('GET', 'ajaxStarter.php?choix=' + i); //true pour synchrone, false pour asynchrone

		xhr.addEventListener('readystatechange', function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
				// alert(xhr.responseText);
			}
		});
		xhr.send();
	}

	// bulb.addEventListener("click", function()
	// {
	// 	var xhr = new XMLHttpRequest();

	// 	xhr.open('GET', 'ajaxStarter.php?choix=' + 1, false); //true pour synchrone, false pour asynchrone

	// 	xhr.addEventListener('readystatechange', function() {
	// 		if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
	// 			alert(xhr.responseText);
	// 		}
	// 	});
	// 	xhr.send();
	// });

	// cara.addEventListener("click", function()
	// {
	// 	var xhr = new XMLHttpRequest();

	// 	xhr.open('GET', 'ajaxStarter.php?choix=' + 4, false); //true pour synchrone, false pour asynchrone

	// 	xhr.addEventListener('readystatechange', function() {
	// 		if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
	// 			alert(xhr.responseText);
	// 		}
	// 	});
	// 	xhr.send();
	// });

	// sala.addEventListener("click", function()
	// {
	// 	var xhr = new XMLHttpRequest();

	// 	xhr.open('GET', 'ajaxStarter.php?choix=' + 7, false); //true pour synchrone, false pour asynchrone

	// 	xhr.addEventListener('readystatechange', function() {
	// 		if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
	// 			alert(xhr.responseText);
	// 		}
	// 	});
	// 	xhr.send();
	// });

</script>