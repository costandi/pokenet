<?php
session_start();

include './bdd.php';

$BDD = GenerBDD();

if($_POST["action"] == "1"){
    $tmp = buyPotion($BDD, $_SESSION['ID']);
    $_POST = null;
    if ($tmp == true)
	echo "Potion achetée!";
    else echo "Tu n'a pas asser d'argent!";
}

else if($_POST["action"] == "2"){
    $tmp = buyPokeball($BDD, $_SESSION['ID']);
    $_POST = null;
    if ($tmp == true)
	echo "Pokeball achetée!";
    else echo "Tu n'a pas asser d'argent!";
}

?>
