<!DOCTYPE html>
<?php $BDD = GenerBDD();

if(!isset($_SESSION['ID']))
{
	header( "refresh:5;url=connect.php" );
	die("vous devez vous connecter !");
}

 $un = getUsername($BDD, $_SESSION["ID"]);
 $pb = getPokeball($BDD, $_SESSION["ID"]);
 $pt = getPotion($BDD, $_SESSION["ID"]);
 $mn = getMoney($BDD, $_SESSION["ID"]);

fermerBDD($BDD); ?>

<html lang='fr'>
    
    <head>
	<meta charset='utf-8'>
	<Title>Pokenet</title>
	<link rel='icon' href='decors/favicon.png'>
	<link rel='stylesheet' type='text/css' href='style/jeu.css'>
    </head>
    
    <body>
	<div id='fenetre'>
	    
