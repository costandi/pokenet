<?php
session_start();

include './bdd.php';
$BDD = GenerBDD();
$un = getUsername($BDD, $_SESSION['ID']);
fermerBDD($BDD);
?>

<!DOCTYPE html>
<html lang="fr">
    
    <head>
	<meta charset="utf-8">
	<title>Pokenet</title>
	<link rel="icon" href="decors/favicon.png">
	<link rel="stylesheet" type="text/css" href="jeu.css">
    </head>
    
    <body>
	
	<div id="fenetre">Fenetre</div>
	
	<div id="droite">test
	    <div id="g"><p id ="md">AFFICHER ou FERMER LE MENU</p></div>
	    <div id="d">
		<ul>
		    <li><p>Se promener</p></li>
		    <li><p>Combattre d'autres joueurs!</p></li>
		</ul>
	    </div>
	</div>
	<div id="etatJ">
	    Nom : <?php echo $un; ?> 
	</div>
	
    </body>
</html>


<script type="text/javascript">
 
 var statutB = 1;
 var fenetre = document.querySelector("#fenetre");
 var droite = document.querySelector("#droite");
 
 var g = document.querySelector("#g");
 var d = document.querySelector("#d");
 
 var etatJ = document.querySelector("#etatJ");
 
 
 
 g.addEventListener("click", function (){
     
     if (statutB == 1){
	 
	 d.style.visibility="hidden";
	 
	 droite.style.width="5%";
	 
	 g.style.width="90%";
	 
	 fenetre.style.width="94%";
	 
	 statutB = 0;
     }
     
     else if (statutB == 0){
	 
	 d.style.visibility="visible";
	 
	 droite.style.width="24%";
	 
	 g.style.width="20%";
	 
	 fenetre.style.width="75%";
	 
	 statutB = 1;
     }
     
     
     
 });

 
</script>
