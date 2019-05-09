<?php

include './security.php';
include './bdd.php';
if (isset($_POST["connexion"]) && isset($_POST["nom"]) && isset($_POST["mdp"])) // si tu as clique sur connexion
    // dans la page connect.php et 
    // que tu as entré un nom et mdp
{
    $check = mdpValid($_POST["mdp"]);
    if ($check == 0)
    {
        echo "connecté";
        echo "<p>Bienvenue ".$_POST["nom"]." !</p>";                                    // on check le mdp
        echo "votre mdp est ".$_POST["mdp"];
        /*lien vers le jeu en php*/
    }
    else
    {        
        echo "<script>alert('mdp invalide')</script>";                                  // ou on envoie une alerte
    }
}
else if (isset($_POST["connexion"]) && !isset($_POST["nom"])) 
{
    echo "erreur de connexion";
    /*lien vers l'accueil en prevenant pourquoi*/                                       // si ya eu un problm (on sait pas
    // pk) et que t'as pas de nom ya une
    // erreur
}
// c'est la meme chose mais pour l'inscription (de la page inscrit.php)
if (isset($_POST["inscription"]))
{
    $check = mdpValid($_POST["mdp"]);
    if ($check == 0)
    {
	$cMdP = encrypt($_POST["mdp"], clef());
	$BDD = GenerBDD();
	CreUser($BDD, $_POST["nom"], $cMdP);
	$cMdP = decrypt($cMdP, clef());
	echo "inscrit sous le nom de ".$_POST["nom"]." ! ton mdp est ".$cMdP;
	fermerBDD($BDD);
    }
    else echo "mot de passe invalide";
    
}
else if (isset($_POST["inscription"]) && !isset($_POST["connexion"]) && !isset($_POST['nom']))
{
    echo "erreur d'inscription";
}
?>



<!DOCTYPE html>
<html>
    <head>
	<title></title>
	<link rel="icon" href="favicon.png">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">

    </head>
    <body>
	<div class="round-button" name="boutonPokeball">
	    <a href="index.php">
		<img src="decors/pokeball.png">
	    </a>
	</div>
    </body>
</html>

<style type="text/css">
 .round-button {
     position: relative;
     margin:5px;
     width: 80px;
     height: 0;
     padding-bottom: 80px;
     border-radius: 50%;
     border: 2px solid #f5f5f5;
     overflow: hidden;
     background: #464646;
     box-shadow: 0 0 3px gray;
 }
 .round-button:hover {
     background: red;
 }
 .round-button img {
     display: block;
     width: 77px;
     padding: 0;
     height: auto;
 }
</style>
