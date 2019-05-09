<?php
session_start();
include './bdd.php';

$BDD = GenerBDD();

if ($_POST['use'] == '1')
    centrePkm($BDD, $_SESSION['ID']);

else if ($_POST['use'] == '2')
    exchangePkmEq($BDD, $_SESSION['ID'], 1, $_POST['pos']);

$eq = getEquipe($BDD, $_SESSION['ID']);

echo displayEquipe($eq);

fermerBDD($BDD);
?>
