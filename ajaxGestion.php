<?php
session_start();
include './bdd.php';

$BDD = GenerBDD();

if ($_POST['use'] == '1')
    centrePkm($BDD, $_SESSION['ID']);

else if ($_POST['use'] == '2')
    exchangePkmEq($BDD, $_SESSION['ID'], 1, $_POST['pos']);

else if ($_POST['use'] == '3')
    fromEqToPC($BDD, $_SESSION['ID'], $_POST['pos']);

else if ($_POST['use'] == '4')
    fromPCToEq($BDD, $_SESSION['ID'], $_POST['pos']);




$eq = getEquipe($BDD, $_SESSION['ID']);
$PC = getPC($BDD, $_SESSION['ID']);

$res[0] = displayEquipe($eq);
$res[1] = displayPC($PC);;

echo json_encode($res);
fermerBDD($BDD);
?>
