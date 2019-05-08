<?php
	session_start();

	include_once './bdd.php';

	// $un = getUsername($BDD, $_SESSION['ID']);
	// $pb = getPokeball($BDD, $_SESSION['ID']);
	// $pt = getPotion($BDD, $_SESSION['ID']);
	// $mn = getMoney($BDD, $_SESSION['ID']);


	include './Template/header.php';

// echo "deja joue : ".$dejaJoue;


	if ($dejaJoue == 0) {
		include './speach.php';
	}
?>
Fenetre

<?php 
	include './Template/footer.php'; 
?>
