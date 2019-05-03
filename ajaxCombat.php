<?php
session_start();

include './bdd.php';
$BDD = GenerBDD();

$joueur1 = getFirstPkm($BDD, $_SESSION['ID']); // joueur1 VS joueur2
$joueur2 = 2;



if (isset($_GET['IDAtk']) && isset($_GET['cible']) && isset($_GET['lanceur'])) 
{
	$rep = array();

	$pok = getPkmAtk($BDD, $_GET['lanceur']);
	$damage = getDamage($BDD, $_GET['IDAtk'], $pok);

	applyDamage($BDD, $damage, $_GET['cible']);


	// $PV = getPV($BDD, $joueur2);

	// echo "il reste ".$PV." pv à l'adversaire !";
	$rep[0] = getPV($BDD, $joueur1);
	$rep[1] = getPV($BDD, $joueur2);
	$rep[2] = setKO($BDD, $joueur1);
	$rep[3] = setKO($BDD, $joueur2);

	echo json_encode($rep);

	//echo setKO($BDD, $_GET['cible']);

}
// else 
// {
// 	echo "pas de click sur une attaque !";
// }

fermerBDD($BDD);
?>