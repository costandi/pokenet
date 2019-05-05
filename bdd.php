<?php
/*
function GenerBDD(){}
function CreUser($BDD, $username, $MdP){}
function fermerBDD($BDD){}
function checkUserBDD($BDD, $UNcheck, $MDP2check) {}
function getIdNumber($BDD, $User){}
function getUsername($BDD, $ID){}
function newPkmSauvage($BDD, $ID){}
//function starter($BDD, $IDPkm, $IDUser){
// function hardestChoice($BDD) {}
function displayAttaque($BDD, $pok) {}
function getTypePkm($BDD, $pok) {}
function displayPokemonInfo($BDD, $pok) {}
function getPV($BDD, $pok){}
function setKO($BDD, $pok){}
function getPkmAtk($BDD, $ID){}
function getDamage($BDD, $attaque, $array){}
function applyDamage($BDD, $damage, $IDennemi){}
function getMoney($BDD, $ID){}
function getPokeball($BDD, $ID){}
function getPotion($BDD, $ID){}
function newDay($BDD){}
function buyPokeball($BDD, $ID){}
function buyPotion($BDD, $ID){}
function getEquipe($BDD, $ID){}
function displayEquipe($BDD, $eq) {}
function getPkmPc($BDD, $ID){}
function getFirstPkm($BDD, $IDEq){}
function getVitesse($BDD, $ID){}
function whoStart($BDD, $Pkm1, $Pkm2){}
function whofinish($BDD, $Pkm1, $Pkm2){}
function countAttaque($BDD, $ID){}
function getArrayIDAtk($BDD, $ID){}
function getNomAttaque($BDD, $ID) {}

et la c'est le bordel
function newPkmSauvage
function capture
function countEquipe
function countPokemon
function addInEquipe
function addInPC
function starter
*/
//__________________________________________________________________________________
function GenerBDD(){
	$BDD=mysqli_connect("localhost","root","1919","pokenet");
	if(!$BDD){
		die("<p>connexion impossible</p>");
	}
	else return $BDD;
}
function CreUser($BDD, $username, $MdP){
    $tmp = getIdNumber($BDD, $username);
    
    if ($tmp == -1){
        $prepUser = mysqli_prepare($BDD, "INSERT INTO User(username,userMDP, qtteThune) VALUES(?,?, 500)");
        mysqli_stmt_bind_param($prepUser, 'ss', $username, $MdP);
        mysqli_execute($prepUser);
        $ID = getIdNumber($BDD, $username);
        
        $newSac = mysqli_prepare($BDD, "INSERT INTO Sac VALUES(?, 5, 5)");
        mysqli_stmt_bind_param($newSac,'i', $ID);
        mysqli_execute($newSac);
    }
    
    return $tmp;
}
function fermerBDD($BDD){
	mysqli_close($BDD);
}
function checkUserBDD($BDD, $UNcheck, $MDP2check) {
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
    if (!$ID)
        return -1;
    else
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
		echo "	<input type='button' style='visibility:visible' id='attaque".$a."' onclick='del(), send(".$pok[$i-1].", joueur2, joueur1), aQui()' value='".$pok[$i]."'>	";
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
	$stmt = mysqli_prepare($BDD, "SELECT nom, niveau from Pokedex, Pokemon where IDPkd=IDPkm and IDPkm=?");
	mysqli_stmt_bind_param($stmt, 'i', $pok);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $nom, $niveau);
	while(mysqli_stmt_fetch($stmt));
	echo "<p id=stat>".$nom." niveau ". $niveau."</p>";
}
function getPV($BDD, $pok){
	$stmt = mysqli_prepare($BDD, "SELECT PV from  Pokemon where IDPkm=?");
	mysqli_stmt_bind_param($stmt, 'i', $pok);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $PV);
	while(mysqli_stmt_fetch($stmt));
	return $PV;
}
function setKO($BDD, $pok)
{
	$PV = getPV($BDD, $pok);
	if ($PV <= 0) {
		$stmt = mysqli_prepare($BDD, "UPDATE Pokemon set KO=1 where IDPkm=?");
		mysqli_stmt_bind_param($stmt, 'i', $pok);
		mysqli_execute($stmt);
		return "KO !";
	}
	else
	{
		$stmt = mysqli_prepare($BDD, "UPDATE Pokemon set KO=0 where IDPkm=?");
		mysqli_stmt_bind_param($stmt, 'i', $pok);
		mysqli_execute($stmt);
		// echo "<br/>pas KO !";
	}
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
function getDamage($BDD, $attaque, $array)
{
	if (in_array($attaque, $array)) {
		$stmt = mysqli_prepare($BDD, "SELECT degats FROM Attaque WHERE IDAtk = ?");
		mysqli_stmt_bind_param($stmt, 'i', $attaque);
		mysqli_execute($stmt);
		mysqli_stmt_bind_result($stmt, $degats);
		while(mysqli_stmt_fetch($stmt));
		return $degats;
	}
	
}
function applyDamage($BDD, $damage, $IDennemi)
{
	$stmt = mysqli_prepare($BDD, "UPDATE Pokemon set PV=PV-? where IDPkm = ?");
	mysqli_stmt_bind_param($stmt, 'ii', $damage, $IDennemi);
	mysqli_execute($stmt);
	
}
function getMoney($BDD, $ID){
	$stmt = mysqli_prepare($BDD, "SELECT qtteThune FROM User WHERE IDD = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $Thune);
	while(mysqli_stmt_fetch($stmt));
		
	return $Thune;
}
function getPokeball($BDD, $ID){
	$stmt = mysqli_prepare($BDD, "SELECT pokeball FROM Sac WHERE IDSac = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $Pokeball);
	while(mysqli_stmt_fetch($stmt));
	
	return $Pokeball;
}
function getPotion($BDD, $ID){
	$stmt = mysqli_prepare($BDD, "SELECT potion FROM Sac WHERE IDSac = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $Potion);
	while(mysqli_stmt_fetch($stmt));
	
	return $Potion;
}
function newDay($BDD){
	mysqli_query($BDD, "UPDATE User SET qtteThune = qtteThune + '50'");
	mysqli_query($BDD, "UPDATE Sac SET pokeball = pokeball + '5'");
}
function  buyPokeball($BDD, $ID){
	$test = getMoney($BDD, $ID);
	if($test >= 300){ 
		$stmt = mysqli_prepare($BDD, "UPDATE User SET qtteThune = qtteThune - '300' WHERE IDD = ?");
		mysqli_stmt_bind_param($stmt, 'i', $ID);
		mysqli_execute($stmt);
		
		$stmt2 = mysqli_prepare($BDD, "UPDATE Sac SET pokeball = pokeball + '1' WHERE IDSac = ?");
		mysqli_stmt_bind_param($stmt2, 'i', $ID);
		mysqli_execute($stmt2);
		
		return true;
	}
	
	else return false;
}
function  buyPotion($BDD, $ID){
	$test = getmoney($BDD, $ID);
	if($test >= 200){ 
		$stmt = mysqli_prepare($BDD, "UPDATE User SET qtteThune = qtteThune - '200' WHERE IDD = ?");
		mysqli_stmt_bind_param($stmt, 'i', $ID);
		mysqli_execute($stmt);
		
		$stmt2 = mysqli_prepare($BDD, "UPDATE Sac SET potion = potion + '1' WHERE IDSac = ?");
		mysqli_stmt_bind_param($stmt2, 'i', $ID);
		mysqli_execute($stmt2);
		
		return true;
	}
	
	else return false;
}

function getEquipe($BDD, $ID){

 	$stmt = mysqli_prepare($BDD,
                           "SELECT IDPkmEq, position, nom, PV 
                            from Equipe, User, Pokedex, Pokemon 
                            where IDEq=IDD and IDPkm=IDPkmEq and IDD=? and IDPkmEq=IDPkd 
                            order by position ASC");
 	mysqli_stmt_bind_param($stmt, 'i', $ID);
 	mysqli_execute($stmt);

 	$res = mysqli_stmt_bind_result($stmt, $IDPkm, $pos, $nom, $PV);


 	$equipe = array(0);
    
 	if($res) {
 		while(mysqli_stmt_fetch($stmt)){
 			array_push($equipe, array('ID' => $IDPkm, 'nom' => $nom, 'pv' =>$PV));
		}
 	}
 	return $equipe;
}

function displayEquipe($eq) {
 	$taille = count($eq);
 	$i = 0;
 	echo "<ul>";
 	for ($i=1; $i < $taille; $i++) { 
 		echo "<li>idPkm : ".$eq[$i][ID]."<br/>position : ".$i."<br/>nom : ".$eq[$i][nom]."<br/>pv : ".$eq[$i][pv]." pv</li>	";
 		echo "<br/>";
 	}
 	echo "</ul>";
	
}

function getPkmPc($BDD, $ID){
	$stmt = mysqli_prepare($BDD, 
		"SELECT IDPkmPC, nom from PC NATURAL JOIN Pokedex where IDPkmPC = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	$res = mysqli_stmt_bind_result($stmt, $IDPkmEq, $nomPkm);
	$AtkEq = array();
	if($res) {
 		while(mysqli_stmt_fetch($stmt)){
 			array_push($AtkEq, $IDPkmEq, $nomPkm);
        }
 	}
 	return $AtkEq;
}
// select count dans l'equipe :
// si < 6 => pos = count+1
// sinon => dans le PC
function getFirstPkm($BDD, $IDEq)
{
	$stmt = mysqli_prepare($BDD, "SELECT IdPkmEq from Equipe where IDEq= ? and position=1");
	mysqli_stmt_bind_param($stmt, 'i', $IDEq);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $first);
	while(mysqli_stmt_fetch($stmt));
	return $first;
}
function getVitesse($BDD, $ID)
{
	$stmt = mysqli_prepare($BDD, "SELECT vitesse from Pokemon, Equipe where IDPkm=IDpkmEq and IDEq=? and position=1");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $first);
	while(mysqli_stmt_fetch($stmt));
	return $first;
}
function whoStart($BDD, $Pkm1, $Pkm2)
{
	$pok1 = getVitesse($BDD, $Pkm1);
	$pok2 = getVitesse($BDD, $Pkm2);
	if ($pok1 < $pok2) {
		return $Pkm1;
	}
	else
		return $Pkm2;
}
function whofinish($BDD, $Pkm1, $Pkm2)
{
	$pok1 = getVitesse($BDD, $Pkm1);
	$pok2 = getVitesse($BDD, $Pkm2);
	if ($pok1 > $pok2) {
		return $Pkm1;
	}
	else
		return $Pkm2;
}
function countAttaque($BDD, $ID)
{
	$stmt = mysqli_prepare($BDD, "SELECT count(IDAtkPA) from PoAtk where IDPkmPA=?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $nb);
	while(mysqli_stmt_fetch($stmt));
	return $nb;
}
function getArrayIDAtk($BDD, $ID)
{
	$stmt = mysqli_prepare($BDD, "SELECT IDAtkPA from PoAtk where IDPkmPA=?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	$res = mysqli_stmt_bind_result($stmt, $PoAtk);
	$arrayAtk = array();
	if($res) {
 		while(mysqli_stmt_fetch($stmt)){
 			array_push($arrayAtk, $PoAtk);
        }
 	}
 	// print_r($arrayAtk);
 	return $arrayAtk;
}
// function getNomAttaque($BDD, $ID) 
// {
// 	$stmt = mysqli_prepare($BDD, "SELECT nomAtk from Attaque where IDAtk=?");
// 	mysqli_stmt_bind_param($stmt, 'i', $ID);
// 	mysqli_execute($stmt);
// 	mysqli_stmt_bind_result($stmt, $nom);
// 	while(mysqli_stmt_fetch($stmt));
//     if (!$nom)
//         return -1;
//     else
//         return $nom;
// }
function newPkmSauvage($BDD, $ID)
{
	$newPkm = mysqli_prepare($BDD, "INSERT INTO Pokemon(IDPkd_, niveau, PV, etat, KO, vitesse, sauvage)	VALUES(?, 1, 100, -1, 0, 5, 1)");
	mysqli_stmt_bind_param($newPkm, 'i', $ID);
	mysqli_execute($newPkm);
}
function capture($BDD, $IDD, $IDPkm) //idpkm est l'id en parametre de l'adversaire
{
	$stmt = mysqli_prepare($BDD, "UPDATE Pokemon set sauvage=0 where IDPkm= ?");
	mysqli_stmt_bind_param($stmt, 'i', $IDPkm);
	mysqli_execute($stmt);
	$nb = countEquipe($BDD, $IDD);
	if ($nb < 6)
	{
		addInEquipe($BDD, $IDD, $IDPkm);
	}
	else
	{
		addInPC($BDD, $IDD, $IDPkm);
	}
}
function countEquipe($BDD, $ID)
{
	$stmt = mysqli_prepare($BDD, "SELECT count(*) from Equipe where IDEq = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $nb);
	while(mysqli_stmt_fetch($stmt));
	return $nb;
}
function countPokemon($BDD, $ID)
{
	$stmt = mysqli_prepare($BDD, "SELECT count(*) from Pokemon");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $nb);
	while(mysqli_stmt_fetch($stmt));
	return $nb;
}
function addInEquipe($BDD, $IDD, $IDPkm)
{
	$pos = countEquipe($BDD, $ID)+1;
	$newInEq = mysqli_prepare($BDD, "INSERT INTO Equipe(IDEq, IDPkmEq, position) VALUES(?,?,?)");
	mysqli_stmt_bind_param($newInEq, 'ii', $IDD, $IDPkm, $pos);
	mysqli_execute($newInEq);
}
function addInPC($BDD, $IDD, $IDPkm)
{
	$newInPC = mysqli_prepare($BDD, "INSERT INTO PC(IDPC, PCPkm) VALUES(?,?)");
	mysqli_stmt_bind_param($newInPC, 'ii', $IDD, $IDPkm);
	mysqli_execute($newInPC);
}
function starter($BDD, $IDPkm, $IDD) //id pkm = le choix qu'on fait entre 1, 4, 7
{
	newPkmSauvage($BDD, $IDPkm);
	addInEquipe($BDD, $IDD, $IDPkm)
