<?php
session_start();
include './bdd.php';

$BDD = GenerBDD();

exchangePkmEq($BDD, $_SESSION['ID'], 1, $_POST['pos']);
$eq = getEquipe($BDD, $BDD, $_SESSION['ID']);

echo displayEquipe($eq);

fermerBDD($BDD);
?>
