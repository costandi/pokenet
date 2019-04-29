<?php
session_start();
include './bdd.php';

if (!isset($_SESSION['ID'])) {
	echo "<script> alert('vous devez vous connecter pour combatre !')</script>";
	
	header("location: connect.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fight !</title>
</head>
<body>

	<?php
	$BDD = GenerBDD();
	

	$joueur1 = getFirstPkm($BDD, $_SESSION['ID']); // joueur1 VS joueur2
	$joueur2 = 2;

	echo $joueur1;
	
	

	$pok = getPkmAtk($BDD, $joueur1);
	$t = getTypePkm($BDD, $joueur1);

	$pok2 = getPkmAtk($BDD, $joueur2);
	$t2 = getTypePkm($BDD, $joueur2);


	$premier = whoStart($BDD, $joueur1, $joueur2);
	echo "le premier est le num : ".$premier;



	$dernier = whoFinish($BDD, $joueur1, $joueur2);
	echo "<br/>le dernier est le num : ".$dernier;


	?>

	<div id="ennemi">ennemi
		<?php
		displayPokemonInfo($BDD, $joueur2);
		echo $t2[0]."<br/>";
		echo $t2[1];

		// echo getRandomAttaque($BDD, $joueur2);
		?>
	</div>

	<div id="vie">
		<?php
		$PV = getPV($BDD, $joueur2);
		echo "il reste ".$PV." pv à l'adversaire !";
		setKO($BDD, $joueur2);


		?>
		<?php // ici la valeur de l'attaque s'affiche
			echo "
			<script>
				var test=".getRandomAttaque($BDD, $joueur2)."
				alert(test);

			</script>";
			//getRandomAttaque($BDD, $joueur2);	
		?>;
	</div>
			


			



	<br/>
	<br/>

	<div id="pokemon">
		<?php
		displayPokemonInfo($BDD, $joueur1);
		$PV2 = getPV($BDD, $joueur1);
		echo "il vous reste ".$PV2." pv !<br/>";
		setKO($BDD, $joueur1);

		echo $t[0]."<br/>";
		echo $t[1]."<br/>";
		?>
	</div>



	<div id="actions">
		<input type="button" id="attaque" value="Attaques" onclick="aQui()">

		<?php
		displayAttaque($BDD, $pok);

		?>


		<br/>


		<input type="button" id="objets" value="Objets">

		<input type="button" id="pokeball" value="Pokeball">
		<input type="button" id="potion" value="Potion">

		<br/>
		<br/>
		<br/>

		<input type="button" id="retour" value="Retour">
		

		
	</div>





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

	// var bbb =parseInt(<?php //echo 5;?>, 10) ;
	// // document.write(bbb.toString() )	;

	// alert(bbb);

	// alert("oui");
</script>


<script type="text/javascript">

	var joueur1 = <?php echo $joueur1 ?>;
	var joueur2 = <?php echo $joueur2 ?>;
	var premier = <?php echo $premier ?>;
	var actions = document.querySelector("#actions");
	



	//while equipe1 pas KO et equipe2 pas ko
	// combatre();
	// function combatre(IDAtk) {
	// 	if (current == joueur1) {
	// 		// afficher les attaques
	// 	}
	// 	else {
	// 		randomAttaque = getRandomAttaque(/*nb d'attaque de l'ennemi*/);
	// 	}
	// }



	// <?php
	// echo "
	// var test = ".getRandomAttaque($BDD, $joueur2).";
	// alert(test);
	// ";
	// ?>






	function send(IDAtk){
		var xhr = new XMLHttpRequest();
		let vie =  document.querySelector("#vie");
		xhr.open('GET', 'ajaxCombat.php?IDAtk=' + IDAtk, false); //true pour synchrone, false pour asynchrone
		xhr.addEventListener('readystatechange', function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
				vie.innerHTML = xhr.responseText;
		}
		);
		
		
		xhr.send();
		
		
		
	}
	// function bot() {
	// 	return "not a robot";
	// }
	//appeler la fonction dans chaque bouton d'attaque, ou d'objet
	// si i = 0 => le plus rapide
	// si i = 1 => le plus lent
	// }

	var attE;
	var current = <?php echo $premier ?>;
	// current = 18;
	var test;

	function aQui()	{
		if (current == joueur1)
		{
			vie.innerHTML += "<br/>ton tour";
			

			current = joueur2;
		}
		else if (current == joueur2)
		{
			// alert(<?php // echo getRandomAttaque($BDD, $joueur2); ?>);
			// alert(test);

			// <?php
			// 	echo " 				
			// 		test = ".getRandomAttaque($BDD, $joueur2).";
			// 		alert(test);
			// 	";// RAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAHHHHHHHHHH
			// ?>




			

			current = joueur1;
		}

		else
		{
			alert("ekjfhezkfjhefzkjhzekjfh");
		}


		return current;
	}



	var retour = document.querySelector("#retour");
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
	retour.addEventListener("click", function ()
	{
		attaque.style.visibility = "visible";
		objets.style.visibility = "visible";
		pokeball.style.visibility = "hidden";
		potion.style.visibility = "hidden";
		attaque1.style.visibility = "hidden";
		attaque2.style.visibility = "hidden";
		attaque3.style.visibility = "hidden";
		attaque4.style.visibility = "hidden";
		
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
<?php
fermerBDD($BDD);
?>