<?php
include './bdd.php';

// echo "bouton ".$_GET['param1']." !";

$BDD = GenerBDD();

$damage = getDamage($BDD, $_GET['param1']);

// echo "<br/>cette attaque fait ".$damage." degats !";

applyDamage($BDD, $damage, 3);


// displayPokemonInfo($BDD, 4);
// displayPokemonInfo($BDD, 2);

$PV = getPV($BDD, 3);
echo "<br/>il reste ".$PV." pv";

setKO($BDD, 3);


fermerBDD($BDD);

// if ($_GET['param1'] == 1) 
// {
// 	echo "azertyuio";

// }


?>