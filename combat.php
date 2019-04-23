<?php
include './bdd.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fight !</title>
</head>
<body>

	<?php
	$bob = 1; // bob VS joseLeBandit
	$joseLeBandit = 3;
	
	$BDD = GenerBDD();

	$pok = getPkmAtk($BDD, $bob);
	$t = getTypePkm($BDD, $bob);

	$pok2 = getPkmAtk($BDD, $joseLeBandit);
	$t2 = getTypePkm($BDD, $joseLeBandit);
	?>

	<div id="ennemi">ennemi
		<?php
		displayPokemonInfo($BDD, $joseLeBandit);
		echo $t2[0]."<br/>";
		// echo $t2[1];
		?>
	</div>

	<div id="vie">
		<?php
		$PV = getPV($BDD, $joseLeBandit);
		echo "<br/>il reste ".$PV." pv";
		$KO = setKO($BDD, $joseLeBandit);

// IL FAUT EMPECHER D'UTILISER N'IMPORTE QUELLE ATTAQUE DEPUIS L'INVITE DE COMMANDE JS
		?>
	</div>


	<br/>

	<div id="pokemon">
		<?php
		displayPokemonInfo($BDD, $bob);
		echo $t[0]."<br/>";
		echo $t[1]."<br/>";
		?>
	</div>



	<form>
		<input type="button" id="attaque" value="Attaques">

		<?php
		displayAttaque($BDD, $pok);			
		?>




		<br/>


		<input type="button" id="objets" value="objets">

		<input type="button" id="pokeball" value="pokeball">
		<input type="button" id="potion" value="potion">

		<?php
		fermerBDD($BDD);
		?>
	</form>





</body>
</html>

<style>

	* {
		margin: 0;
		padding: 0;
	}

	input {
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

	#stat {
		color: red;
	}

	input:hover {
		background-color: rgba(255, 0, 0, 1);
	}

	input:active {
		box-shadow: inset -2px -2px 3px rgba(255, 255, 255, .6),
		inset 2px 2px 3px rgba(0, 0, 0, .6);
	}

	#attaque1, #attaque2, #attaque3, #attaque4 {
		visibility: hidden;
	}

	#potion, #pokeball {
		visibility: hidden;
	}


</style>

<script type="text/javascript">



	function send(bot, i){
		var xhr = new XMLHttpRequest();
		let vie =  document.querySelector("#vie");

		xhr.open('GET', 'ajaxServ.php?param1=' + i, false); //true pour synchrone, false pour asynchrone

		xhr.addEventListener('readystatechange', function() {

			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
				vie.innerHTML = xhr.responseText;


		}
		);
		
		if (bot == "not a robot") {
			xhr.send();
		}
		
		
	}

	function bot() {
		return "not a robot";
	}













	var attaque = document.querySelector("#attaque");
	var attaque1 = document.querySelector("#attaque1");
	var attaque2 = document.querySelector("#attaque2");
	var attaque3 = document.querySelector("#attaque3");
	var attaque4 = document.querySelector("#attaque4");


	var objets = document.querySelector("#objets");
	var potion = document.querySelector("#potion");
	var pokeball = document.querySelector("#pokeball");


	attaque.addEventListener("click", function ()
	{
		attaque.style.visibility = "hidden";
		objets.style.visibility = "hidden";


		attaque1.style.visibility = "visible";
		attaque2.style.visibility = "visible";
		attaque3.style.visibility = "visible";
		attaque4.style.visibility = "visible";

		

	});





	objets.addEventListener("click", function ()
	{
		attaque.style.visibility = "hidden";

		pokeball.style.visibility = "visible";
		potion.style.visibility = "visible";

		objets.style.visibility = "hidden";
	});


	pokeball.addEventListener("click", function ()
	{
		attaque.style.visibility = "visible";
		objets.style.visibility = "visible";

		pokeball.style.visibility = "hidden";
		potion.style.visibility = "hidden";

		
	});


	potion.addEventListener("click", function ()
	{
		attaque.style.visibility = "visible";
		objets.style.visibility = "visible";

		pokeball.style.visibility = "hidden";
		potion.style.visibility = "hidden";

		
	});


	attaque1.addEventListener("click", function ()
	{
		attaque.style.visibility = "visible";
		objets.style.visibility = "visible";

		attaque1.style.visibility = "hidden";
		attaque2.style.visibility = "hidden";
		attaque3.style.visibility = "hidden";
		attaque4.style.visibility = "hidden";

		

		
	});




	attaque2.addEventListener("click", function ()
	{
		attaque.style.visibility = "visible";
		objets.style.visibility = "visible";

		attaque1.style.visibility = "hidden";
		attaque2.style.visibility = "hidden";
		attaque3.style.visibility = "hidden";
		attaque4.style.visibility = "hidden";

		
	});




	attaque3.addEventListener("click", function ()
	{
		attaque.style.visibility = "visible";
		objets.style.visibility = "visible";

		attaque1.style.visibility = "hidden";
		attaque2.style.visibility = "hidden";
		attaque3.style.visibility = "hidden";
		attaque4.style.visibility = "hidden";

		
	});




	attaque4.addEventListener("click", function ()
	{
		attaque.style.visibility = "visible";
		objets.style.visibility = "visible";

		attaque1.style.visibility = "hidden";
		attaque2.style.visibility = "hidden";
		attaque3.style.visibility = "hidden";
		attaque4.style.visibility = "hidden";

		
	});


	
</script>
