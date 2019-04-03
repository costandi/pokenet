<?php
/*




select ID_Pkm, Niveau, nom, Nom_T, Nom_ATK from Pokemon, Pokedex, Type, Attaques where Pokemon.ID_Pkd=Pokedex.ID_Pkd and ID_T=type and Pokemon.Atk1=ID_ATK;








//Preparation de la BDD
//Fonction personelle. A modifier
function GenerBDD();

//CreUser est une fonction qui insere un tuple dans la table User avec une base de donnée, un username et un mot de passe crypter
//Fonction personelle.
function CreUser($BDD, $username, $MdP);

//Fermeture de la BDD
//fonction personelle pour les test. A modifier

function fermerBDD();

//Verifier si un mot de passe crypter correspond au mot de passe de la base de donnée. Prend en paramettre une base de donnée, un nom d'utilisateur et le mot de passe a comparer a la base de donnée
//Fonction personelle.
function checkUserBDD($BDD, $UNcheck, $MDP2check);
*/
//utiliser l'id dresseur pour le sac et l'equipe
//__________________________________________________________________________________


function GenerBDD(){
	$BDD=mysqli_connect("localhost","root","1919","pokenet");
	if(!$BDD){
		die("<p>connexion impossible</p>");
	}
	else return $BDD;

}


/*                       REMPLIR PAR DEFAUT LES VALEURS DE INSERT USER BORDEEEEEEEEELLLLLL                            */

function CreUser($BDD, $username, $MdP){

	$prepUser = mysqli_prepare($BDD, "INSERT INTO User(UserName,User_MDP, QteThune) VALUES(?,?, 500)");

	mysqli_stmt_bind_param($prepUser, 'ss', $username, $MdP);
	mysqli_execute($prepUser);
}


function Connection($BDD, $username, $MdP){
	$prepUser = mysqli_prepare($BDD, "SELECT UserName, User_MDP from User WHERE UserName=? ");

	mysqli_stmt_bind_param($prepUser, 's', $username);
	mysqli_execute($prepUser);


}


function fermerBDD($BDD){
	mysqli_close($BDD);
}


function checkUserBDD($BDD, $UNcheck, $MDP2check){
	$stmt = mysqli_prepare($BDD, "SELECT User_MDP FROM User WHERE UserName = ?");
mysqli_stmt_bind_param($stmt, 's', $UNcheck); //uncheck est l'utilisateur en parametre
mysqli_execute($stmt);

mysqli_stmt_bind_result($stmt, $MDPvalide);

while(mysqli_stmt_fetch($stmt));

//echo "Vrai mdp= ".$MDPvalide."<br>MDP 2 look: ".$MDP2check."<br>";


if ($MDPvalide == $MDP2check)
	return true;
else
	return false;

}




function getIdNumber($BDD, $User)
{
	$stmt = mysqli_prepare($BDD, "SELECT ID_D FROM User WHERE UserName = ?");
	mysqli_stmt_bind_param($stmt, 's', $User);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $ID);
	while(mysqli_stmt_fetch($stmt));

	return $ID;

}
function getUsername($BDD, $ID)
{
	$stmt = mysqli_prepare($BDD, "SELECT Username FROM User WHERE ID_I = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $User);
	while(mysqli_stmt_fetch($stmt));

	return $User;  
}




function vaChercherUnPkmnStp($BDD, $ID)
{

	$resultat=mysqli_query($BDD,"SELECT * FROM Pokemon");
	if($resultat) {
		echo "<ul>";
		foreach($resultat as $enr){
			echo "<li>id : ".$enr['ID_Pkm']." pv : ".$enr['PV']." </li>";
		}
		echo "</ul>";
	}

	/*
	$stmt = mysqli_prepare($BDD, "SELECT * FROM Pokemon WHERE ID_Pkm = ?");
	mysqli_stmt_bind_param($stmt, 's', $ID);
	mysqli_execute($stmt);

	mysqli_stmt_bind_result($stmt, $pokm);
	while(mysqli_stmt_fetch($stmt));
	*/

	return $pokm;  
}



?>
