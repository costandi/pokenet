<?php
/**
* Met la variable dejaJoue d'un utilisateur a 1
* c'est un setter, pour savoir si le joueur a déjà lancé le jeu une fois
* @param $BDD
* @param int $ID l'ID de l'utilisateur
*/
function aBienJoue($BDD, $ID){
	$stmt = mysqli_prepare($BDD, "UPDATE User SET dejaJoue=1 WHERE IDD=?");
	mysqli_stmt_bind_param($stmt, "i", $ID);
	mysqli_execute($stmt);
}

/**
* Ajoute un pokemon dans l'équipe d'un dresseur
* @param $BDD
* @param int $IDD l'ID du dresseur
* @param int $IDPkm l'ID du pokemon
*/
function addInEquipe($BDD, $IDD, $IDPkm) {
	$stmt = mysqli_prepare($BDD, "UPDATE Pokemon set sauvage=0 where IDPkm= ?");
	mysqli_stmt_bind_param($stmt, 'i', $IDPkm);
	mysqli_execute($stmt);
	$pos = countEquipe($BDD, $IDD)+1;
	$newInEq = mysqli_prepare($BDD, "INSERT INTO Equipe(IDEq, IDPkmEq, position) VALUES(?,?,?)");
	mysqli_stmt_bind_param($newInEq, 'iii', $IDD, $IDPkm, $pos);
	mysqli_execute($newInEq);
}

/**
* Ajoute un pokemon dans le PC d'un dresseur
* @param $BDD
* @param int $IDD l'ID du dresseur
* @param int $IDPkm l'ID du pokemon
*/
function addInPC($BDD, $IDD, $IDPkm) {
	$stmt = mysqli_prepare($BDD, "UPDATE Pokemon set sauvage=0 where IDPkm= ?");
	mysqli_stmt_bind_param($stmt, 'i', $IDPkm);
	mysqli_execute($stmt);
	$newInPC = mysqli_prepare($BDD, "INSERT INTO PC(IDPC, PCPkm) VALUES(?,?)");
	mysqli_stmt_bind_param($newInPC, 'ii', $IDD, $IDPkm);
	mysqli_execute($newInPC);
}

/**
* Cette fonction permet d'appliquer des degats à l'ennemi
* @param $BDD
* @param int $damage
* @param int $IDennemi
*/
function applyDamage($BDD, $damage, $IDennemi) {
	$stmt = mysqli_prepare($BDD, "UPDATE Pokemon set PV=PV-? where IDPkm = ?");
	mysqli_stmt_bind_param($stmt, 'ii', $damage, $IDennemi);
	mysqli_execute($stmt);
}

/**
* permet d'apprendre une attaque à un pokemon en fonction de leurs identifiants respectifs
*/
function apprendAttaque($BDD, $IDPkm, $IDAtk) {
	$stmt = mysqli_prepare($BDD, "INSERT into PoAtk values (?, ?)");
	mysqli_stmt_bind_param($stmt, 'ii', $IDPkm, $IDAtk);
	mysqli_execute($stmt);
}

/**
* Cette fonction permet d'acheter des pokeballs
* @param $BDD la base de donnée
* @param int $ID l'ID de l'utilisateur
* @return boolean true si la transaction a été effectuée, false sinon
*/
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
/**
* Cette fonction permet d'acheter des potion
* @param $BDD la base de donnée
* @param int $ID l'ID de l'utilisateur
* @return boolean true si la transaction a été effectuée, false sinon
*/
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

/**
* Permet de capturer un pokemon sauvage
* @param $BDD
* @param int $IDD l'ID du dresseur
* @param int $IDPkm l'ID du pokemon sauvage
*/
function capture($BDD, $IDD, $IDPkm) {
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

/**
* Cette fonction sert a soigner tout les pokemons de l'équipe
* @param $BDD
* @param int $ID l'ID du dresseur
*/
function centrePkm($BDD, $ID){
	$stmt = mysqli_prepare($BDD, "UPDATE Pokemon, Equipe SET PV=100 WHERE IDPkm = Equipe.IDPkmEq AND IDEq = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);

    $stmt = mysqli_prepare($BDD, "UPDATE Pokemon, Equipe SET KO = 0 WHERE IDPkm = Equipe.IDPkmEq AND IDEq = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
}

/**
* Cette fonction sert a verifier si le nom d'utilisateur et le mot de passe correspondent
* @param $BDD la base de donnée
* @param string $UNcheck le nom d'utilisateur a verifier
* @param string $MDP2check le mot de passe a verifier
* @return boolean true si le mot de passe correspond a l'utilisateurs, false sinon
*/
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

/**
* Permet de recuperer le nombre d'attaques d'un pokemon
* @param $BDD
* @param int $ID l'ID du pokemon
* @return int le nombre d'attaques du pokemon
*/
function countAttaque($BDD, $ID) {
	$stmt = mysqli_prepare($BDD, "SELECT count(IDAtkPA) from PoAtk where IDPkmPA=?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $nb);
	while(mysqli_stmt_fetch($stmt));
	return $nb;
}

/**
* Permet de recuperer le nombre de pokemon dans une équipe
* @param $BDD
* @param int $ID l'ID du dresseur
* @return int le nombre de pokemon dans une équipe
*/
function countEquipe($BDD, $ID) {
	$stmt = mysqli_prepare($BDD, "SELECT count(*) from Equipe where IDEq = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $nb);
	while(mysqli_stmt_fetch($stmt));
	return $nb;
}

/**
* Permet de recuperer le nombre de pokemon existants dans la base de donnée
* @param $BDD
* @return int le nombre de pokemon dans la base de donnée
*/
function countPokemon($BDD) {
	$stmt = mysqli_query($BDD, "SELECT count(*) from Pokemon");
	while($nb = mysqli_stmt_fetch($stmt));
	return $nb;
}

/**
* Cette fonction permet de créer un utlisateur
* @param $BDD une base de donnée active
* @param string $username un nom d'utilisateur
* @param string $MdP un mot de passe
* @return int le numero d'ID de l'utilisateur créer ou de l'utilisateur si il existe deja
*/
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

/**
* Recupere la variable dejaJoue d'un utilisateur
* c'est un getter qui permet de savoir si le joueur a déjà joué
* @param $BDD
* @param int $ID l'ID du dresseur
* @return int la variable dejaJoue de l'utilisateur
*/
function dejaJoue($BDD, $ID) {
	$stmt = mysqli_prepare($BDD, "SELECT dejaJoue FROM User WHERE IDD = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $res);
	while(mysqli_stmt_fetch($stmt));
	return $res;
}

/**
* Cette fonction permet d'affichier les attaques d'un Pokemon
* @param $BDD la base de donnée
* @param array $pok un tableau d'attaques
*/
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

/**
* Permet d'affichier une équipe
* @param array $eq l'équipe a afficher
*/
function displayEquipe($eq) {
	$taille = count($eq);

    
	$tmp =  "<ul class='w3-ul'>";
	for ($i=1; $i < $taille; $i++) { 
	    $tmp = $tmp."<li class='w3-card-4 w3-deep-purple w3-hover-purple w3-padding-small'>".
	    "<header class='w3-container w3-black'>";
	    if($eq[$i]['surnom'] != null){
  			$tmp = $tmp."<h1 class='w3-bold-pokefont'>".$eq[$i]['surnom']." (".$eq[$i]['nom'].")</h1>";
		} else {
			$tmp = $tmp."<h1 class='w3-bold-pokefont'>".$eq[$i]['nom']."</h1>";
		}
		$tmp = $tmp."</header>".
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


/**
* Affiche les pokemon d'un PC
* @param $PC le tableau d'un PC
*/
function displayPC($PC) {
	$taille = count($PC);
	
	$tmp =  "<ul class='w3-ul'>";
	for ($i=1; $i < $taille; $i++) { 
	    $tmp = $tmp."<li class='w3-card-4 w3-deep-purple w3-hover-purple w3-padding-small'>".
	    "<header class='w3-container w3-black'>";
  		if($PC[$i]['surnom'] != null){
  			$tmp = $tmp."<h1 class='w3-bold-pokefont'>".$PC[$i]['surnom']." (".$PC[$i]['nom'].")</h1>";
		} else {
			$tmp = $tmp."<h1 class='w3-bold-pokefont'>".$PC[$i]['nom']."</h1>";
		}
		$tmp = $tmp."</header>".
		"<br/>Points de vie : ".$PC[$i]['pv']." pv".
		"<br/><input class='w3-btn w3-black w3-hover-grey w3-round-xxlarge' type='button' value ='Envoyer dans l&apos;équipe' onclick='send(4, ".$PC[$i]['ID'].")'>".
		"</li><br/>";
	}
    $tmp = $tmp."</ul>";

    return $tmp;
}

/**
* Affiche le pokedex
* @param $BDD
*/
function displayPkd($BDD) {
	$res = mysqli_query($BDD, "SELECT * FROM Pokedex");
    $pkd = array(0);
    $i = 0;
    
    echo "<ul class='w3-container w3-center w3-ul'>";
	while($pkd = mysqli_fetch_row($res)){
		echo "<li class='w3-row'>";
        	echo "<div class='w3-card-2 w3-margin w3-padding-small w3-deep-purple w3-hover-purple w3-col w3-xlarge'><p>[".$pkd[0]."] ".$pkd[1]."</p></div>";
        echo "</li>";
	}
	echo "</ul>";
}

/**
* Affiche les informations liées a un pokemon
* @param $BDD
* @param int $pok l'ID du pokemon
*/
function displayPokemonInfo($BDD, $pok) {
	$stmt = mysqli_prepare($BDD, "SELECT nom, niveau from Pokedex, Pokemon where IDPkd=IDPkd_ and IDPkm=?");
	mysqli_stmt_bind_param($stmt, 'i', $pok);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $nom, $niveau);
	while(mysqli_stmt_fetch($stmt));
	echo "<p id=stat>".$nom." niveau ". $niveau."</p>";
}

/**
* Sert a faire changer deux pokemon de place dans une équipe
* @param $BDD
* @param int $ID l'ID du dresseur 
* @param int $pos1 la premiere position
* @param int $pos2 la 2eme position
*/
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

/**
* Cette fonction permet de fermer une base de donnée
* @param $BDD la base de donnée a fermer.
*/
function fermerBDD($BDD){
	mysqli_close($BDD);
}

/**
* Envoie un pokemon dans une équipe dans le PC
* @param $BDD
* @param int $ID l'ID du dresseur
* @param int $pkm l'ID du pokemon
*/
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

/**
* Envoie un pokemon du PC dans l'équipe
* @param $BDD
* @param int $ID l'ID du dresseur
* @param int $pkm l'ID du pokemon
*/
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

/**
* Cette fonction permet de générer une base de donnée.
* @return un lien vers la base de donnée, rien sinon
*/
function GenerBDD(){
	$BDD=mysqli_connect("dwarves.iut-fbleau.fr","costandi","sqldwarves","costandi");
	if(!$BDD){
		die("<p>connexion impossible</p>");
	}
	else return $BDD;
}

/**
* Permet de recuperer les attaques qu'un pokeon peut lancer
* @param $BDD
* @param int $attaque l'ID du pokemon
* @return array les attaques du pokemon en question
*/
function getArrayIDAtk($BDD, $ID) {
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

/**
* Permet de recuperer tout les pokemons
* @param $BDD
* @return array tous les pokemons
*/
function getArrayIDPkm($BDD) {
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

/**
* @param $BDD
* @param int $attaque l'ID du pokemon
* @return array toutes les attaques que le pokemon peut apprendre
*/
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

/**
* Permet de recuperer les dégats d'une attaque si elle figure dans le tableau
* @param $BDD
* @param int $attaque l'ID de l'attaque
* @param $array
* @return int le nombre de degats de l'attaque
*/
function getDamage($BDD, $attaque, $array){
	if (in_array($attaque, $array)) {
		$stmt = mysqli_prepare($BDD, "SELECT degats FROM Attaque WHERE IDAtk = ?");
		mysqli_stmt_bind_param($stmt, 'i', $attaque);
		mysqli_execute($stmt);
		mysqli_stmt_bind_result($stmt, $degats);
		while(mysqli_stmt_fetch($stmt));
		return $degats;
	}
}

/**
* Permet de recuperer la date de la dernière déconnexion
* @param $BDD
* @param int $ID l'ID du dresseur
* @return int (timestamp) la date de deconnexion 
*/
function getDateDeconnexion($BDD, $ID){
	$stmt = mysqli_prepare($BDD, "SELECT dateDeconnexion FROM User WHERE IDD=?");
	mysqli_stmt_bind_param($stmt, "i", $ID);
	mysqli_execute($stmt);
	$res = mysqli_stmt_bind_result($stmt, $DD);
	
	while(mysqli_stmt_fetch($stmt));
	return $DD;
}

/**
* Permet de recuperer les dégats d'une attaque
* @param $BDD
* @param int $attaque l'ID de l'utilisateur
* @return array un tableau contenant tout les pokemons de l'équipe
*/
function getEquipe($BDD, $ID){
	$stmt = mysqli_prepare($BDD, "SELECT IDPkmEq, position, nom, PV, surnom from User, Equipe, Pokedex, Pokemon where IDEq=? and IDPkm=IDPkmEq and IDPkd_=IDPkd and IDEq = IDD order by position");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	$res = mysqli_stmt_bind_result($stmt, $IDPkm, $pos, $nom, $PV, $surnom);
	$equipe = array(0);
	
	if($res) {
		while(mysqli_stmt_fetch($stmt)){
			array_push($equipe, array('ID' => $IDPkm, 'nom' => $nom, 'pv' =>$PV, 'pos' => $pos, 'surnom' => $surnom));
		}
	}
	return $equipe;
}

/**
* Permet de recuperer l'ID du pokemon en tete d'équipe
* @param $BDD
* @param int $ID l'ID du joueur
* @return int l'ID du pokemon en tete d'equipe
*/
function getFirstPkm($BDD, $IDEq){
	$stmt = mysqli_prepare($BDD, "SELECT IdPkmEq from Equipe where IDEq= ? and position=1");
	mysqli_stmt_bind_param($stmt, 'i', $IDEq);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $first);
	while(mysqli_stmt_fetch($stmt));
	return $first;
}

/**
* Cette fonction permet de recuperer l'ID d'un utilisateur
* @param $BDD la base de donnée
* @param string $User le nom d'utilisateur
* @return int -1 si il n'y a pas d'utilisateur a ce nom, l'ID sinon
*/
function getIdNumber($BDD, $User) {
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

/**
* Permet de recuperer la somme d'argent d'une personne a partir de son ID
* @param $BDD
* @param int $ID l'ID de l'utilisateur 
* @return int la somme d'argent de l'utilisateur
*/
function getMoney($BDD, $ID){
	$stmt = mysqli_prepare($BDD, "SELECT qtteThune FROM User WHERE IDD = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $Thune);
	while(mysqli_stmt_fetch($stmt));
	return $Thune;
}

/**
* Recupere le nom d'une attaque a partir de son ID
* @param $BDD
* @param int $ID l'ID de l'attaque 
* @return string le nom de l'attaque, -1 sinon
*/
function getNomAttaque($BDD, $ID) {
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

/**
* Recupere l'ID du pokedex en fonction d'un pokemon
* @param $BDD
* @param int $IDPkm l'ID du pokemon
* @return l'id du pokedex
*/
function getNumPkd($BDD, $IDPkm) {
	$stmt = mysqli_prepare($BDD, "SELECT IDPkd_ FROM Pokemon WHERE IDPkm = ?");
	mysqli_stmt_bind_param($stmt, 'i', $IDPkm);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $res);
	while(mysqli_stmt_fetch($stmt));
	return $res;
}

/**
* Renvoie le tableau des pokemon d'un dresseur qui sont dans le PC
* @param $BDD
* @param int $ID l'ID du dresseur
* @return un tableau de pokemon
*/
function getPC($BDD, $ID){
	$stmt = mysqli_prepare($BDD,"SELECT IDPkm, nom, PV, surnom from PC, Pokedex, Pokemon where IDPkm=PCPkm and IDPC=? and IDPkd_=IDPkd order by nom ASC");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	$res = mysqli_stmt_bind_result($stmt, $IDPkm, $nom, $PV, $surnom);
	$equipe = array(0);
	
	if($res) {
		while(mysqli_stmt_fetch($stmt)){
			array_push($equipe, array('ID' => $IDPkm, 'nom' => $nom, 'pv' =>$PV, 'surnom' => $surnom));
		}
	}
	return $equipe;
}

/**
* Renvoie le tableau des pokemons sauvages
* @param $BDD
* @return un tableau de pokemon
*/


/**
* Renvoie un tableau d'attaque d'un pokemon via son ID
* @param $BDD
* @param int $ID l'ID du pokemon dont on veut les attaques
* @return array un tableau d'attaques
*/
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

function getPkmSauvage($BDD) {
	$stmt = mysqli_query($BDD, "SELECT IDPkm from Pokemon where sauvage=1");
	$t = array();
	while($a=mysqli_fetch_row($stmt)) 
	{
		array_push($t, $a[0]);
	}
	// print_r($t);
	return $t; // le tableau de pkm sauvages
}


/**
* Cette fonction permet de récuperer le nombre de pokeballs depuis l'ID d'un utilisateur
* @param $BDD la base de donnée
* @param int $ID l'ID de l'utilisateur
* @return int le nombre de pokeballs liée à cet ID
*/
function getPokeball($BDD, $ID){
	$stmt = mysqli_prepare($BDD, "SELECT pokeball FROM Sac WHERE IDSac = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $Pokeball);
	while(mysqli_stmt_fetch($stmt));
	
	return $Pokeball;
}

/**
* Cette fonction permet de récuperer le nombre de potions depuis l'ID d'un utilisateur
* @param $BDD la base de donnée
* @param int $ID l'ID de l'utilisateur
* @return int le nombre de potions liée à cet ID
*/
function getPotion($BDD, $ID){
	$stmt = mysqli_prepare($BDD, "SELECT potion FROM Sac WHERE IDSac = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $Potion);
	while(mysqli_stmt_fetch($stmt));
	
	return $Potion;
}

/**
* Sert a recuperer le nombre de PV d'un Pokemon
* @param $BDD
* @param int $pok l'ID du pokemon
* @return int le nombre de PV du pokemon
*/
function getPV($BDD, $pok){
	$stmt = mysqli_prepare($BDD, "SELECT PV from  Pokemon where IDPkm=?");
	mysqli_stmt_bind_param($stmt, 'i', $pok);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $PV);
	while(mysqli_stmt_fetch($stmt));
	return $PV;
}

/**
* Recupere l'ID d'un pokemon au hazard
* @param $BDD
* @return int l'ID du pokemon choisis
*/
function getRandomPkd($BDD) {
	$tab = getArrayIDPkm($BDD);
	$ran = random_int(0, sizeof($tab)-1);
	return $tab[$ran];
}

/**
* Renvoie le surnom d'un pokemon
* @param $BDD
* @param int $IDPkm l'ID du pokemon
*/
function getSurnom($BDD, $IDPkm){
	$stmt = mysqli_prepare($BDD,"SELECT surnom FROM Pokemon WHERE IDPkm = ?");
	mysqli_stmt_bind_param($stmt, 'i', $IDPkm);
	mysqli_stmt_bind_result($stmt, $res);

	while(mysqli_stmt_fetch($stmt));
	return($res);
}

/**
* Cette fonction sert a recuperer le type d'un pokemon a partir de son ID
* @param $BDD la base de donnée
* @param int $pok l'ID du pokemon
* @return array un tableau de type
*/
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

/**
* Cette fonction permet de récuperer un nom d'utilisateur depuis l'ID d'un utilisateur
* @param $BDD la base de donnée
* @param int $ID l'ID de l'utilisateur
* @return string le nom d'utilisateur liée à cet ID
*/
function getUsername($BDD, $ID){
	$stmt = mysqli_prepare($BDD, "SELECT username FROM User WHERE IDD = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $User);
	while(mysqli_stmt_fetch($stmt));
	return $User;
}

/**
* Cette fonction permet de récuperer la vitesse d'un pokemon
* @param $BDD la base de donnée
* @param int $ID l'ID du pokemon
* @return int la vitesse du pokemon
*/
function getVitesse($BDD, $ID) {
	$stmt = mysqli_prepare($BDD, "SELECT vitesse from Pokemon, Equipe where IDPkm=IDPkmEq and IDEq=? and position=1");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
	mysqli_stmt_bind_result($stmt, $first);
	while(mysqli_stmt_fetch($stmt));
	return $first;
}

/**
* Permet de soigner un pokemon
* @param $BDD
* @param int IDPkm le pokemon a soigner
* @param int $ID l'ID du dresseur
* @return 1 si il y a eu un probleme
*/
function heal($BDD, $IDPkm, $ID) {
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

/**
* Donne les recompences chaque jours
* @param $BDD
* @param int $ID l'id du joueur
*/
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

/**
* Crée un nouveau pokemon sauvage
* @param $BDD
* @param int $IDPkd
* @return int l'ID du nouveau pokemon créé
*/
function newPkmSauvage($BDD, $IDPkd) {
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
	return $IDaleatPkm;
}

/**
* si il reste au moins un pokemon sauvage, on l'affronte, sinon on en crée un nouveau et on l'affronte
* @param $BDD
* @return int identifiant du pokemon ennemi
*/
function oponent($BDD) {
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

/**
* Met la date actuelle a la dernière date de deconnexion d'un utilisateur
* @param $BDD
* @param int $ID l'utilisateur a modifier
*/
function setDateDeconnexion($BDD, $ID){
    $time = time();
	$stmt = mysqli_prepare($BDD, "UPDATE User SET dateDeconnexion=? WHERE IDD=?");
	mysqli_stmt_bind_param($stmt, "ii", $time, $ID);
	mysqli_execute($stmt);
}

/**
* attribue des attaques aléatoires à un pokemon lors de sa création
* @param $BDD
* @param $IDPkm
*/
function setAtk($BDD, $IDPkm){
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

/**
* permet de mettre KO un pokemon
* @param $BDD
* @param $pok
*/
function setKO($BDD, $pok){
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
/**
* Ajoute un starteur dans l'équipe d'un joueur
* @param $BDD
* @param int $IDPkm l'ID du starteur
* @param int $IDD l'ID de l'utilisateur
*/
function starter($BDD, $IDPkm, $IDD) {
	$starter = newPkmSauvage($BDD, $IDPkm);
	addInEquipe($BDD, $IDD, $starter);
}

/**
* Sert a utiliser une pokeball
* @param $BDD
* @param int $ID l'ID du dresseur
*/
function usePokeball($BDD, $ID) {
	$stmt = mysqli_prepare($BDD, "UPDATE Sac SET pokeball = pokeball - '1' WHERE IDSac = ?");
	mysqli_stmt_bind_param($stmt, 'i', $ID);
	mysqli_execute($stmt);
}

/** 
* détermine quel pokemon est le plus rapide
*/
function whoStart($BDD, $Pkm1, $Pkm2){
	
	$pok1 = getVitesse($BDD, $Pkm1);
	$pok2 = getVitesse($BDD, $Pkm2);
	if ($pok1 < $pok2) {
		return $Pkm1;
	}
	else
		return $Pkm2;
}

/**
* détermine quel pokemon est le plus lent
*/

function whofinish($BDD, $Pkm1, $Pkm2){
	$pok1 = getVitesse($BDD, $Pkm1);
	$pok2 = getVitesse($BDD, $Pkm2);
	if ($pok1 > $pok2) {
		return $Pkm1;
	}
	else
		return $Pkm2;
}
?>
