<?php
session_start();

include './bdd.php';
	$BDD = GenerBDD();

	$bob = getFirstPkm($BDD, $_SESSION['ID']); // bob VS joseLeBandit
	$joseLeBandit = 3;


	$pok = getPkmAtk($BDD, $bob);



// echo "bouton ".$_GET['IDAtk']." !";

if (isset($_GET['IDAtk'])) 
{
//	echo "bouton ".$_GET['IDAtk']." !";

	$damage = getDamage($BDD, $_GET['IDAtk'], $pok);


	// echo "<br/>cette attaque fait ".$damage." degats !";


	applyDamage($BDD, $damage, $joseLeBandit);


	// displayPokemonInfo($BDD, 4);
	// displayPokemonInfo($BDD, 2);


	$PV = getPV($BDD, $joseLeBandit);
	echo "il reste ".$PV." pv à l'adversaire !";


	setKO($BDD, $joseLeBandit);
} 
else 
{
	echo "pas de click sur une attaque !";
}



// if ($_GET['IDAtk'] == 1) 
// {
// 	echo "azertyuio";
// }

fermerBDD($BDD);

?>
