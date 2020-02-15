<?php

function GenerBDD(){
	$BDD=mysqli_connect("dwarves.iut-fbleau.fr","costandi","sqldwarves","costandi");
	if(!$BDD){
		die("<p>connexion impossible</p>");
	}
	else return $BDD;
}
function CreUser($BDD, $username, $MdP){
	$tmp = getIdNumber($BDD, $username);
	if ($tmp == -1){
		$prepUser = mysqli_prepare($BDD, "INSERT INTO User(username,userMDP, qtteThune, dateDeconnexion) VALUES(?,?, 500, false)");
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
	$stmt = mysqli_prepare($BDD, "SELECT nomT from Pokemon, Pokedex, PoType, Type where IDPkm=? and IDPkd_=IDPkd and IDPkdPT=IDPkd and IDT=IDTypePT");
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
	$stmt = mysqli_prepare($BDD, "SELECT nom, niveau from Pokedex, Pokemon where IDPkd=IDPkd_ and IDPkm=?");
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
function newDay($BDD, $ID){
	$stmt = mysqli_prepare($BDD, "UPDATE User SET qtteThune = qtteThune + '50' WHERE IDD = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	
	$stmt = mysqli_prepare($BDD, "UPDATE Sac SET pokeball = pokeball + '5' WHERE IDSac = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	
	$stmt = mysqli_prepare($BDD, "UPDATE Pokemon, Equipe SET PV=100 WHERE IDPkm = Equipe.IDPkmEq AND IDEq = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
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
	$stmt = mysqli_prepare($BDD, "SELECT IDPkmEq, position, nom, PV from User, Equipe, Pokedex, Pokemon where IDEq=? and IDPkm=IDPkmEq and IDPkd_=IDPkd and IDEq = IDD order by position");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	$res = mysqli_stmt_bind_result($stmt, $IDPkm, $pos, $nom, $PV);
	$equipe = array(0);
	
	if($res) {
		while(mysqli_stmt_fetch($stmt)){
			array_push($equipe, array('ID' => $IDPkm, 'nom' => $nom, 'pv' =>$PV, 'pos' => $pos));
		}
	}
	return $equipe;
}

function displayEquipe($eq) {
	$taille = count($eq);

    
	$tmp =  "<ul class='w3-ul'>";
	for ($i=1; $i < $taille; $i++) { 
	    $tmp = $tmp."<li class='w3-card-4 w3-deep-purple w3-hover-purple w3-padding-small'>".
	    "<header class='w3-container w3-black'>
  			<h1 class='w3-bold-pokefont'>".$eq[$i]['nom']."</h1>
		</header>".
		"<br/>position : ".$eq[$i]['pos'].
		"<br/>Points de vie : ".$eq[$i]['pv']." pv".
		"<br/><input class='w3-btn w3-black w3-hover-grey w3-round-xxlarge' type='button' value ='Envoyer au PC' onclick='send(3, ".$eq[$i]['ID'].")'>";
	    if ($eq[$i]['pos'] != 1){
            $tmp = $tmp."<input class='w3-btn w3-black w3-hover-grey w3-round-xxlarge'type='button' value ='Mettre ce pokémon en tête d&apos;équipe' onclick='send(2, ".$eq[$i]['pos'].")'>";
	    }
	    $tmp = $tmp."</li><br/>";
	}
    $tmp = $tmp."</ul>";

    return $tmp;
}

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
	$stmt = mysqli_prepare($BDD, "SELECT vitesse from Pokemon, Equipe where IDPkm=IDPkmEq and IDEq=? and position=1");
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
	return $arrayAtk;
}
function getArrayIDPkm($BDD)
{
	$stmt = mysqli_prepare($BDD, "SELECT IDPkd from Pokedex");
	mysqli_execute($stmt);
	$res = mysqli_stmt_bind_result($stmt, $IDPkm);
	$arrayPkm = array();
	if($res) {
		while(mysqli_stmt_fetch($stmt)){
			array_push($arrayPkm, $IDPkm);
		}
	}
	return $arrayPkm;
}
function getRandomPkd($BDD)
{
	$tab = getArrayIDPkm($BDD);
	$ran = random_int(0, sizeof($tab)-1);
	return $tab[$ran];
}
function getNomAttaque($BDD, $ID) 
{
	$stmt = mysqli_prepare($BDD, "SELECT nomAtk from Attaque where IDAtk=?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $nom);
	while(mysqli_stmt_fetch($stmt));
	if (!$nom)
		return -1;
	else
		return $nom;
}
function newPkmSauvage($BDD, $IDPkd)
{
	$newPkm = mysqli_prepare($BDD, "INSERT into Pokemon(IDPkd_, niveau, PV, etat, KO, vitesse, sauvage) VALUES(?, 5, 100, -1, FALSE, 2, TRUE)");
	mysqli_stmt_bind_param($newPkm, 'i', $IDPkd);
	mysqli_execute($newPkm);
	$IDaleatPkm = mysqli_insert_id($BDD);
	$tab = getTypePkm($BDD, $IDaleatPkm);
	setAtk($BDD, $IDaleatPkm);
	
	for ($i=0; $i < sizeof($tab); $i++) { 
		$insertType = mysqli_prepare($BDD, "INSERT INTO PoType VALUES(?, ?)");
		mysqli_stmt_bind_param($insertType, 'ii', $IDaleatPkm, $tab[$i]);
		mysqli_execute($insertType);
	}
	// echo "<h1>".$IDaleatPkm."</h1>";
	return $IDaleatPkm;
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
function addInEquipe($BDD, $IDD, $IDPkm)
{
	$stmt = mysqli_prepare($BDD, "UPDATE Pokemon set sauvage=0 where IDPkm= ?");
	mysqli_stmt_bind_param($stmt, 'i', $IDPkm);
	mysqli_execute($stmt);
	$pos = countEquipe($BDD, $IDD)+1;
	$newInEq = mysqli_prepare($BDD, "INSERT INTO Equipe(IDEq, IDPkmEq, position) VALUES(?,?,?)");
	mysqli_stmt_bind_param($newInEq, 'iii', $IDD, $IDPkm, $pos);
	mysqli_execute($newInEq);
}
function addInPC($BDD, $IDD, $IDPkm)
{
	$stmt = mysqli_prepare($BDD, "UPDATE Pokemon set sauvage=0 where IDPkm= ?");
	mysqli_stmt_bind_param($stmt, 'i', $IDPkm);
	mysqli_execute($stmt);
	$newInPC = mysqli_prepare($BDD, "INSERT INTO PC(IDPC, PCPkm) VALUES(?,?)");
	mysqli_stmt_bind_param($newInPC, 'ii', $IDD, $IDPkm);
	mysqli_execute($newInPC);
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
function starter($BDD, $IDPkm, $IDD) //id pkm = le choix qu'on fait entre 1, 4, 7
{
	$starter = newPkmSauvage($BDD, $IDPkm);
	addInEquipe($BDD, $IDD, $starter);
}
function usePokeball($BDD, $ID)
{
	$stmt = mysqli_prepare($BDD, "UPDATE Sac SET pokeball = pokeball - '1' WHERE IDSac = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
}
function heal($BDD, $IDPkm, $ID)
{
	$PV = getPV($BDD, $IDPkm);
	$stmt = mysqli_prepare($BDD, "UPDATE Sac SET potion = potion - '1' WHERE IDSac = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	if ($PV <= 0) 
	{
		return 1;
	}
	else if ($PV == 100)
	{
		return 1;
	}
	else if ($PV > 80)
	{
		$stmt = mysqli_prepare($BDD, "UPDATE Pokemon, Equipe SET PV = 100 WHERE IDPkmEq=IDPkm and position=1 and IDEq = ?");
		mysqli_stmt_bind_param($stmt, 'i', $ID);
		mysqli_execute($stmt);
	}
	else
	{
		$stmt = mysqli_prepare($BDD, "UPDATE Pokemon, Equipe SET PV = PV + 20 WHERE IDPkmEq=IDPkm and position=1 and IDEq = ?");
		mysqli_stmt_bind_param($stmt, 'i', $ID);
		mysqli_execute($stmt);
	}
}
// un pokemon n'apprend que les attaques de son type
function exchangePkmEq($BDD, $ID, $pos1, $pos2){
	$stmt = mysqli_prepare($BDD, "UPDATE Equipe SET position = -1  WHERE position = ? and IDEq = ?");
	mysqli_stmt_bind_param($stmt, 'ii', $pos1, $ID);
	mysqli_execute($stmt);
	$stmt = mysqli_prepare($BDD, "UPDATE Equipe SET position = ?  WHERE position = ? and IDEq = ?");
	mysqli_stmt_bind_param($stmt, 'iii', $pos1, $pos2, $ID);
	mysqli_execute($stmt);
	$stmt = mysqli_prepare($BDD, "UPDATE Equipe SET position = ?  WHERE position = -1 and IDEq = ?");
	mysqli_stmt_bind_param($stmt, 'ii', $pos2, $ID);
	mysqli_execute($stmt);
}
function getDateDeconnexion($BDD, $ID){
	$stmt = mysqli_prepare($BDD, "SELECT dateDeconnexion FROM User WHERE IDD=?");
	mysqli_stmt_bind_param($stmt, "i", $ID);
	mysqli_execute($stmt);
	$res = mysqli_stmt_bind_result($stmt, $DD);
	
	while(mysqli_stmt_fetch($stmt));
	return $DD;
}
function setDateDeconnexion($BDD, $ID){
    $time = time();
	$stmt = mysqli_prepare($BDD, "UPDATE User SET dateDeconnexion=? WHERE IDD=?");
	mysqli_stmt_bind_param($stmt, "ii", $time, $ID);
	mysqli_execute($stmt);
}
function dejaJoue($BDD, $ID)
{
	$stmt = mysqli_prepare($BDD, "SELECT dejaJoue FROM User WHERE IDD = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $res);
	while(mysqli_stmt_fetch($stmt));
	return $res;
}
function aBienJoue($BDD, $ID){
	$stmt = mysqli_prepare($BDD, "UPDATE User SET dejaJoue=1 WHERE IDD=?");
	mysqli_stmt_bind_param($stmt, "i", $ID);
	mysqli_execute($stmt);
}
function centrePkm($BDD, $ID){
	$stmt = mysqli_prepare($BDD, "UPDATE Pokemon, Equipe SET PV=100 WHERE IDPkm = Equipe.IDPkmEq AND IDEq = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);

    $stmt = mysqli_prepare($BDD, "UPDATE Pokemon, Equipe SET KO = 0 WHERE IDPkm = Equipe.IDPkmEq AND IDEq = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);

    
}
function apprendAttaque($BDD, $IDPkm, $IDAtk)
{
	$stmt = mysqli_prepare($BDD, "INSERT into PoAtk values (?, ?)");
	mysqli_stmt_bind_param($stmt, 'ii', $IDPkm, $IDAtk);
	mysqli_execute($stmt);
}
function getNumPkd($BDD, $IDPkm)
{
	$stmt = mysqli_prepare($BDD, "SELECT IDPkd_ FROM Pokemon WHERE IDPkm = ?");
	mysqli_stmt_bind_param($stmt, 'i', $IDPkm);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $res);
	while(mysqli_stmt_fetch($stmt));
	return $res;
}
function setAtk($BDD, $IDPkm)
{
	$IDPkd = getNumPkd($BDD, $IDPkm);
	$arrayAtk = array();
	$arrayAtk = getAtkPossible($BDD, $IDPkd);
	$taille = sizeof($arrayAtk);
	// print_r($arrayAtk);
	$tartenpion = $taille; // c'est un taille temporaire
	if ($tartenpion > 4) {
		$tartenpion = random_int(1, 4);
	}
	else {
		$tartenpion = random_int(1, $tartenpion);
	}
	$tmp = array();
	$i = 0;
	// echo "<br/>taille = ".$taille;
	// echo "<br/>tartenpion = ".$tartenpion;
	while ($i < $tartenpion) {
		$n = random_int(0, $taille-1);
	// echo "<br/>n = ".$n;
		if (!in_array($tmp, $tmp)) {
			// echo "<br/>attaque =  = ".$arrayAtk[$n];
			// echo "<br/>i = ".$i;
			array_push($tmp, $n);
			apprendAttaque($BDD, $IDPkm, $arrayAtk[$n]);
			$i = $i+1;
		}
	}
}
function getAtkPossible($BDD, $IDPkm) {
	$stmt = mysqli_prepare($BDD, "SELECT IDAtkPo from PoAtkPossible where IDPkmPo=?");
	mysqli_stmt_bind_param($stmt, 'i', $IDPkm);
	mysqli_execute($stmt);
	$res = mysqli_stmt_bind_result($stmt, $PoAtk);
	$arrayAtk = array();
	if($res) {
		while(mysqli_stmt_fetch($stmt)){
			array_push($arrayAtk, $PoAtk);
		}
	}
	// dans $arrayAtk il y a toutes les attaques possibles du pkm $IDPkm
	return $arrayAtk;
}

function displayPkd($BDD) {
	$res = mysqli_query($BDD, "SELECT * FROM Pokedex");
	
    $pkd = array(0);
    
    echo "<ul class='w3-ul'>";
	while($pkd=mysqli_fetch_row($res)){
        echo "<li class='w3-card-4'>Pokemon n° ".$pkd[0]." : ".$pkd[1]."</li><br/>";
	}
	echo "</ul>";
}

function getPkmSauvage($BDD)
{
	$stmt = mysqli_query($BDD, "SELECT IDPkm from Pokemon where sauvage=1");
	$t = array();
	while($a=mysqli_fetch_row($stmt)) 
	{
		array_push($t, $a[0]);
	}
	// print_r($t);
	return $t; // le tableau de pkm sauvages
}
function oponent($BDD)
{
	$p = array();
	$p = getPkmSauvage($BDD);
	if (!empty($p)) {
		$rand = random_int(0, sizeof($p)-1);
		$oponent = $p[$rand];
		$stmt = mysqli_prepare($BDD, "UPDATE Pokemon SET PV=100 WHERE IDPkm = ?");
		mysqli_stmt_bind_param($stmt, 'i', $oponent);
		mysqli_execute($stmt);
		return $p[$rand];
	}
	else
	{
		$ran = getRandomPkd($BDD);
		return newPkmSauvage($BDD, $ran);
	}
}

function getPC($BDD, $ID){
	$stmt = mysqli_prepare($BDD,"SELECT IDPkm, nom, PV 	from PC, Pokedex, Pokemon where IDPkm=PCPkm and IDPC=? and IDPkd_=IDPkd order by nom ASC");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	$res = mysqli_stmt_bind_result($stmt, $IDPkm, $nom, $PV);
	$equipe = array(0);
	
	if($res) {
		while(mysqli_stmt_fetch($stmt)){
			array_push($equipe, array('ID' => $IDPkm, 'nom' => $nom, 'pv' =>$PV));
		}
	}
	return $equipe;
}

function displayPC($PC) {
	$taille = count($PC);
	
	$tmp =  "<ul class='w3-ul'>";
	for ($i=1; $i < $taille; $i++) { 
	    $tmp = $tmp."<li class='w3-card-4 w3-deep-purple w3-hover-purple w3-padding-small'>".
	    "<header class='w3-container w3-black'>
  			<h1 class='w3-bold-pokefont'>".$PC[$i]['nom']."</h1>
		</header>".
		"<br/>Points de vie : ".$PC[$i]['pv']." pv".
		"<br/><input class='w3-btn w3-black w3-hover-grey w3-round-xxlarge' type='button' value ='Envoyer dans l&apos;équipe' onclick='send(4, ".$PC[$i]['ID'].")'>".
		"</li><br/>";
	}
    $tmp = $tmp."</ul>";

    return $tmp;
}

function fromEqToPC($BDD, $ID, $pkm){
    $stmt = mysqli_prepare($BDD,"INSERT INTO PC VALUES (?,?)");
	mysqli_stmt_bind_param($stmt, 'ii',$ID ,$pkm);
	mysqli_execute($stmt);    

    $stmt = mysqli_prepare($BDD,"SELECT position FROM Equipe WHERE IDPkmEq = ?");
	mysqli_stmt_bind_param($stmt, 'i' ,$pkm);
    mysqli_execute($stmt);
    mysqli_stmt_bind_result($stmt, $pos);
    while(mysqli_stmt_fetch($stmt));

    $stmt = mysqli_prepare($BDD,"UPDATE Equipe SET position = position-1 WHERE IDEq = ? AND position > ?");
	mysqli_stmt_bind_param($stmt, 'ii',$ID ,$pos);
	mysqli_execute($stmt);

    $stmt = mysqli_prepare($BDD,"DELETE FROM Equipe WHERE IDEq = ? AND IDPkmEq = ?");
	mysqli_stmt_bind_param($stmt, 'ii',$ID ,$pkm);
	mysqli_execute($stmt);

}

function fromPCToEq($BDD, $ID, $pkm){

    $stmt = mysqli_prepare($BDD,"DELETE FROM PC WHERE IDPC = ? AND PCPkm = ?");
	mysqli_stmt_bind_param($stmt, 'ii', $ID ,$pkm);
	mysqli_execute($stmt);

    $eq = getEquipe($BDD, $ID);
    $pos = count($eq);
    
    $stmt = mysqli_prepare($BDD,"INSERT INTO Equipe VALUES (?,?,?)");
	mysqli_stmt_bind_param($stmt, 'iii',$ID ,$pkm, $pos);
	mysqli_execute($stmt);    
}
?>
