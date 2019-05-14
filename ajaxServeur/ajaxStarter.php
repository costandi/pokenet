
<?php
session_start();
include_once '../bdd.php';
$BDD = GenerBDD();
aBienJoue($BDD, $_SESSION['ID']);
if (isset($_GET['choix']))
{
	echo $_GET['choix'];
	starter($BDD, $_GET['choix'], $_SESSION['ID']);
}
?>
