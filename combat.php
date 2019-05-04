<?php
session_start();
include './bdd.php';

if (!isset($_SESSION['ID'])) {
	echo "<script> alert('vous devez vous connecter pour combatre !')</script>";
	
	header("location: connect.php");
}
include './Template/header.php';
?>

<link rel='stylesheet' type='text/css' href='styleCombat.css'>

<body>
	<?php
	$BDD = GenerBDD();

	$joueur1 = getFirstPkm($BDD, $_SESSION['ID']); // joueur1 VS joueur2
	$joueur2 = 2;


	$pok = getPkmAtk($BDD, $joueur1);
	$t = getTypePkm($BDD, $joueur1);

	$pok2 = getPkmAtk($BDD, $joueur2);
	$t2 = getTypePkm($BDD, $joueur2);


	$premier = whoStart($BDD, $joueur1, $joueur2);
	// echo "le premier est le num : ".$premier;

	$dernier = whoFinish($BDD, $joueur1, $joueur2);
	// echo "<br/>le dernier est le num : ".$dernier;
	?>

	<div id="ennemi">
		<?php displayPokemonInfo($BDD, $joueur2);?>
		<p id="typeE">	<?php echo $t2[0] ?> </p>
		<p id="typeE">	<?php echo $t2[1] ?> </p> 



		<p id="vieE"> <?php	$PV = getPV($BDD, $joueur2);	echo "il reste ".$PV." pv à l'adversaire !";?> </p>

		<p id=KOE> <?php echo setKO($BDD, $joueur2); ?>	</p>

		<progress id="barreVieE" value="<?php echo getPV($BDD, $joueur2) ?>" max="100"></progress>

	</div>



	<div id="pokemon">
		<?php displayPokemonInfo($BDD, $joueur1);?>
		<p> <?php echo $t[0] ?> </p>
		<p> <?php echo $t[1] ?> </p>

		<p id="vie"> <?php $PV2 = getPV($BDD, $joueur1);	echo "il vous reste ".$PV2." pv !";?> </p>

		<p id=KO> <?php echo setKO($BDD, $joueur1); ?>	</p>

		<progress id="barreVie" value="<?php echo getPV($BDD, $joueur1) ?>" max="100"></progress>

	</div>


	<div id="actions">

		<input type="button" id="attaque" value="Attaques" onclick="del(), display()">

		<div id="atk">

		</div>

		<br/>

		<div id="obj">
			<input type="button" id="objets" value="Objets">

			<input type="button" id="pokeball" value="Pokeball">
			<input type="button" id="potion" value="Potion">

			<br/>

			<input type="button" id="retour" value="Retour" onclick="del()">



		</div>

	</div>



</body>
</html>



<script type="text/javascript">

	var joueur1 = <?php echo $joueur1 ?>;
	var joueur2 = <?php echo $joueur2 ?>;
	var premier = <?php echo $premier ?>;
	var atk = document.querySelector("#atk");
	
	let vieE =  document.querySelector("#vieE");
	let vie =  document.querySelector("#vie");


	let maBarreVie = document.querySelector("#barreVie")
	let barreVieE = document.querySelector("#barreVieE")
	


	function display()
	{
		atk.innerHTML += "<?php displayAttaque($BDD, $pok);?>";
	}


	function del()
	{
		atk.innerHTML = "";
	}


	function updateVieE(i){
		document.getElementById("vieE").innerHTML = "il reste "+i+" pv à l'adversaire !";
		barreVieE.value = i;

	}

	function updateVie(i){
		document.getElementById("vie").innerHTML = "il vous reste "+i+" pv !";
		maBarreVie.value = i;

	}

	function KO(i)
	{
		if (i != null)
			{document.getElementById("vie").innerHTML += "<br/>KO !";}
	}

	function KOe(i)
	{
		if (i != null)
			{document.getElementById("vieE").innerHTML += "<br/>KO !";}
	}

	function getRandomInt(max) {
		return Math.floor(Math.random() * Math.floor(max));
	}

	function getRandomAttaque()
	{
		var arrayAtkE = <?php echo json_encode(getArrayIDAtk($BDD, $joueur2)) ?>;
		var aleat = getRandomInt(arrayAtkE.length);

		return arrayAtkE[aleat];
	}


	// function getNomAtk(id)
	// {
	// 	.innerHTML += "<?php //getNomAttaque($BDD, );?>";
	// }




	function send(IDAtk, idCible, idLanceur){
		var xhr = new XMLHttpRequest();

		
		xhr.open('GET', 'ajaxCombat.php?IDAtk=' + IDAtk +'&cible=' + idCible+'&lanceur=' + idLanceur , true); //true pour synchrone, false pour asynchrone

		xhr.addEventListener('readystatechange', function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
				var tab = JSON.parse(xhr.responseText);

	    		updateVie(tab[0]); // ma vie
	     		updateVieE(tab[1]);// vie adversaire

	     		KO(tab[2]); // mon KO
	     		KOe(tab[3]);// KO adversaire


	     		return tab;


	     	});

		xhr.send();
	}


	var attE;
	// var current = <?php //echo $premier ?>;
	var current = joueur2;
	var test;

	function aQui()	{
		if (current == joueur1)
		{
			vie.innerHTML += "<br/>ton tour";
			current = joueur2;
		}

		else if (current == joueur2)
		{
			send(getRandomAttaque(), joueur1, joueur2);

			current = joueur1;
			aQui();
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
	
	// attaque.addEventListener("click", function ()
	// {
		
	// 	objets.style.visibility = "hidden";
	// 	attaque1.style.visibility = "visible";
	// 	attaque2.style.visibility = "visible";
	// 	attaque3.style.visibility = "visible";
	// 	attaque4.style.visibility = "visible";

	// });

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
<?php include './Template/footer.php'; ?>