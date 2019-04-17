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

// select nom, PV, niveau from Pokedex, Pokemon where IDPkd=IDPkm and IDPkm=1;

// select nomT from Type, PoType where IDPkdPT=2 and IDT=IDTypePT

// select nomAtk from Attaque, PoAtk where IDPkmPA=3 and IDAtk=IDAtkPA


//utiliser l'id dresseur pour le sac et l'equipe
//__________________________________________________________________________________

function GenerBDD(){
	$BDD=mysqli_connect("localhost","root","1919","pokenet");
	if(!$BDD){
		die("<p>connexion impossible</p>");
	}
	else return $BDD;
}



function CreUser($BDD, $username, $MdP){

	$prepUser = mysqli_prepare($BDD, "INSERT INTO User(userName,userMDP, qtteThune) VALUES(?,?, 500)");
	mysqli_stmt_bind_param($prepUser, 'ss', $username, $MdP);
	mysqli_execute($prepUser);
	$ID = getIdNumber($BDD, $username);

	$newSac = mysqli_prepare($BDD, "INSERT INTO Sac VALUES(?, 5, 5)");
	mysqli_stmt_bind_param($newSac,'i', $ID);
	mysqli_execute($newSac);
}



function fermerBDD($BDD){
	mysqli_close($BDD);
}



function checkUserBDD($BDD, $UNcheck, $MDP2check){
	$stmt = mysqli_prepare($BDD, "SELECT userMDP FROM User WHERE userName = ?");
	mysqli_stmt_bind_param($stmt, 's', $UNcheck);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $MDPvalide);

	while(mysqli_stmt_fetch($stmt));
	if ($MDPvalide == $MDP2check)
		return true;
	else
		return false;
}



function getIdNumber($BDD, $User)
{
	$stmt = mysqli_prepare($BDD, "SELECT IDD FROM User WHERE userName = ?");
	mysqli_stmt_bind_param($stmt, 's', $User);
	mysqli_execute($stmt);

	mysqli_stmt_bind_result($stmt, $ID);
	while(mysqli_stmt_fetch($stmt));

	return $ID;

}



function getUsername($BDD, $ID)
{
	$stmt = mysqli_prepare($BDD, "SELECT username FROM User WHERE IDD = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);

	mysqli_stmt_bind_result($stmt, $User);
	while(mysqli_stmt_fetch($stmt));

	return $User;

}



function getPkmAtk($BDD, $ID){
	$stmt = mysqli_prepare($BDD, 
		"SELECT IDAtkPA, nomAtk from Attaque, PoAtk where IDPkmPA = ? and IDAtk = IDAtkPA");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	$res = mysqli_stmt_bind_result($stmt, $IDAtk, $nomAtk);


	$AtkTab = array();
	if($res) {
		while(mysqli_stmt_fetch($stmt)){
			array_push($AtkTab, $IDAtk, $nomAtk);
		}
	}
	return $AtkTab;
}



function newPkm($BDD, $ID){
	$newPkm = mysqli_prepare($BDD, "INSERT INTO Pokemon(IDPkd_, niveau, PV, etat, KO, vitesse, sauvage)
		VALUES(?, 1, 100, -1, 0, 5, 1)");

	mysqli_stmt_bind_param($newPkm, 'i', $ID);
	mysqli_execute($newPkm);
}



function starter($BDD, $IDPkm, $IDUser){
	newPkm($BDD, $IDPkm);

	$newEq = mysqli_prepare($BDD, "INSERT INTO Equipe(IDEq, IDPkmEq) VALUES(?,?)");
	mysqli_stmt_bind_param($newEq, 'ii', $IDUser, $IDPkm);
	mysqli_execute($newPkm);    
}



// function hardestChoice($BDD) {
// 	$stmt = mysqli_querry($BDD, "SELECT * FROM Pokedex WHERE IDPkd=1 or IDPkd=4 or IDPkd=7");


// 	$AtkTab = array();
// 	if($res) {
// 		while(mysqli_stmt_fetch($stmt)){
// 			array_push($AtkTab, $IDPkd, $nom);
// 		}
// 	}
// }



function displayAttaque($BDD, $pok) {
	$taille = count($pok);
	//echo "taille = ".$taille;

	$i = 0;
	$a = 1;

	for ($i=1; $i < $taille; $i=$i+2) { 
		echo "	<input type='button' id='attaque".$a."' value='".$pok[$i]."'>	";
		$a = $a+1;
	}
	echo "<br/>";

}



function getTypePkm($BDD, $pok) {
	$stmt = mysqli_prepare($BDD, "SELECT nomT from Type, PoType where IDPkdPT=? and IDT=IDTypePT");
	mysqli_stmt_bind_param($stmt, 'i', $pok);
	mysqli_execute($stmt);

	$res = mysqli_stmt_bind_result($stmt, $type);


	$typeTab = array();
	if($res) {
		while(mysqli_stmt_fetch($stmt)){
			array_push($typeTab, $type);
		}
	}
	return $typeTab;
}

 

function displayPokemonInfo($BDD, $pok) {
	$stmt = mysqli_prepare($BDD, "SELECT nom, niveau, PV from Pokedex, Pokemon where IDPkd=IDPkm and IDPkm=?");
	mysqli_stmt_bind_param($stmt, 'i', $pok);
	mysqli_execute($stmt);

	mysqli_stmt_bind_result($stmt, $nom, $niveau, $PV);
	while(mysqli_stmt_fetch($stmt));

	echo $nom." niveau ". $niveau." avec ". $PV." pv !<br/>";
}



function getDamage($BDD, $attaque)
{
	$stmt = mysqli_prepare($BDD, "SELECT degats FROM Attaque WHERE IDAtk = ?");
	mysqli_stmt_bind_param($stmt, 'i', $attaque);
	mysqli_execute($stmt);

	mysqli_stmt_bind_result($stmt, $degats);
	while(mysqli_stmt_fetch($stmt));

	return $degats;
}

?>



