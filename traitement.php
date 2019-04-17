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
        $BDD = GenerBDD();

        $MDP2check = Chiffrement::crypt($_POST["mdp"]);

        // echo $MDP2check;
        // echo Chiffrement::decrypt($MDP2check);

        $entrer = checkUserBDD($BDD, $_POST['nom'], $MDP2check);

        if ($entrer == true)
        {
            session_start();
            echo "connecté";
            echo "<p>Bienvenue ".$_POST["nom"]." !</p>";                                    // on check le mdp
            echo "votre mdp est ".$_POST["mdp"];
            $_SESSION['ID']=getIdNumber($BDD, $_POST['nom']);

            echo "<br>".$_SESSION['ID'];
            /*lien vers le jeu en php*/

            header('Location: jeu.php');
            exit;
            
        }

        else {
            echo "Identifiant ou mot de passe incorrect.";
        }
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
        $cMdP = Chiffrement::crypt($_POST["mdp"]);
        $BDD = GenerBDD();
        CreUser($BDD, $_POST["nom"], $cMdP);
        $cMdP = Chiffrement::decrypt($cMdP);
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
