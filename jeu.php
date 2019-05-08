<?php
	session_start();

	include_once './bdd.php';

	$BDD =  GenerBDD();
	$DD = getDateDeconnexion($BDD, $_SESSION['ID']);

	if ($DD <= (time() - 24*60*60)){
    		newDay($BDD, $_SESSION['ID']);
    	setDateDeconnexion($BDD, $_SESSION['ID']); 
	}
	fermerBDD($BDD);

	include './Template/header.php';

	if ($dejaJoue == 0) {
		include './speach.php';
	}
?>
Fenetre

<?php 
	include './Template/footer.php'; 
?>
