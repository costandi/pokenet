<?php
session_start();

include './bdd.php';

$BDD = GenerBDD();
$rep = array();

if($_POST["action"] == "1"){
    for ($i = 0, $tmp = true;
         $i < $_POST['qtte'] && $tmp != false;
         $i = $i + 1) 
        $tmp = buyPotion($BDD, $_SESSION['ID']);
    
    $mnn = getMoney($BDD, $_SESSION["ID"]);
    $i = $i -1;
    
    if ($tmp == true || ($tmp == false && $i > 0)){
        $i = $i+1;
        $rep[0] = "Tu a acheter ".$i." potion(s)! Il te reste ".$mnn." pokedollards.";
    }
    else $rep[0] = "Tu n'a pas asser d'argent!";
}

else if($_POST["action"] == "2"){
 for ($i = 0, $tmp = true;
      $i < $_POST['qtte'] && $tmp != false;
      $i = $i + 1)
     $tmp = buyPokeball($BDD, $_SESSION['ID']);
 
    $mnn = getMoney($BDD, $_SESSION["ID"]);
    $i = $i -1;
    
    if ($tmp == true || ($tmp == false && $i > 0)){
        $i = $i+1;
        $rep[0] = "Tu a acheter ".$i." pokeball(s)! Il te reste ".$mnn." pokedollards.";
    }
    else $rep[0] = "Tu n'a pas asser d'argent!";
}


$rep[1] = getPokeball($BDD, $_SESSION['ID']);
$rep[2] = getPotion($BDD, $_SESSION['ID']);
$rep[3] = $mnn;

fermerBDD($BDD);

echo json_encode($rep);
?>
