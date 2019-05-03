<?php
session_start();

include './bdd.php';

$BDD = GenerBDD();
$rep = array();

if($_POST["action"] == "1"){
    $tmp = buyPotion($BDD, $_SESSION['ID']);
    $mnn = getMoney($BDD, $_SESSION["ID"]);
    $_POST = null;
    if ($tmp == true)
	$rep[0] = "Potion achetée! Il te reste ".$mnn." pokedollards.";
    else $rep[0] = "Tu n'a pas asser d'argent!";
}

else if($_POST["action"] == "2"){
    $tmp = buyPokeball($BDD, $_SESSION['ID']);
    $mnn = getMoney($BDD, $_SESSION["ID"]);
    $_POST = null;
    if ($tmp == true)
	$rep[0] = "Pokeball achetée! Il te reste ".$mnn." pokedollards.";
    else $rep[0] = "Tu n'a pas asser d'argent!";
}


$rep[1] = getPokeball($BDD, $_SESSION['ID']);
$rep[2] = getPotion($BDD, $_SESSION['ID']);
$rep[3] = $mnn;

fermerBDD($BDD);

echo json_encode($rep);
?>
