<?php
session_start();

include './bdd.php';
$BDD = GenerBDD();

$un = getUsername($BDD, $_SESSION['ID']);
$pb = getPokeball($BDD, $_SESSION['ID']);
$pt = getPotion($BDD, $_SESSION['ID']);
$mn = getMoney($BDD, $_SESSION['ID']);

fermerBDD($BDD);

include './Template/header.php';?>
Fenetre

<?php include './Template/footer.php'; ?>
