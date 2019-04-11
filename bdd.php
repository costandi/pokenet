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
    $BDD=mysqli_connect("localhost","","","pokenet");
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
    $stmt = mysqli_prepare($BDD, "SELECT IDAtkPA, nomAtk 
                                  FROM PoAtk NATURAL JOIN Attaque 
                                  WHERE IDPkmPA = ?");
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
    $newPkm = mysqli_prepare($BDD, "INSERT INTO Pokemon(IDPkd_, niveau, PV, etat, KO, 
                                                          vitesse, sauvage) 
                                      VALUES(?, 1, 500, -1, 0, 5, 1)");
    mysqli_stmt_bind_param($newPkm, 'i', $ID);
    mysqli_execute($newPkm);
}

function starter($BDD, $IDPkm, $IDUser){

    newPkm($BDD, $IDUser);
    
    $newEq = mysqli_prepare($BDD, "INSERT INTO Equipe(IDEq, IDPkmEq) VALUES(?,?)");
    mysqli_stmt_bind_param($newEq, 'ii', $IDUser, $IDPkm);
    mysqli_execute($newPkm);    
    
}




// function vaChercherUnPkmnStp($BDD)
// {

// 	$resultat=mysqli_query($BDD,"SELECT Nom, Niveau, PV, Nom_T as type1 FROM Pokemon, Pokedex, Type where Pokemon.ID_Pkd=Pokedex.ID_Pkd and Pokedex.type=Type.Id_T");


// 	// $type=mysqli_query($BDD,"SELECT Nom_T as type FROM Pokemon, Pokedex, Type where Pokemon.ID_Pkd=Pokedex.ID_Pkd and Pokedex.type=Type.Id_T");

// 	// $type2=mysqli_query($BDD,"SELECT Nom_T as type2 FROM Pokemon, Pokedex, Type where Pokemon.ID_Pkd=Pokedex.ID_Pkd and Pokedex.type=Type.Id_T");


// 	$stmt = mysqli_prepare($BDD, "SELECT Nom_T FROM Type, Pokedex, Pokemon WHERE Pokemon.ID_Pkd=Pokedex.ID_Pkd and Pokedex.type2=Type.Id_T");
	
// 	if (!$stmt) die("pb");

// 	mysqli_execute($stmt);

// 	$res = mysqli_stmt_get_result($stmt);

// 	while ($aaa = mysqli_fetch_assoc($res)){
// 			echo "Type 2 = ".$aaa['Nom_T']."<br/>";
// 		}

// 	echo "quelque chose";

	

// 	// mysqli_stmt_bind_result($type, $a);
// 	// while(mysqli_stmt_fetch($a));

// 	// echo $a;
	

// 	if($resultat)
// 	{
// 		echo "<ul>";
// 		foreach($resultat as $enr)
// 		{
// 			echo "<li>nom : ".$enr['Nom']."<br/>niv : ".$enr['Niveau']."<br/>type : ".$enr['type1']."<br/>type 2 : ".$aaa['Nom_T']."<br/>PV : ".$enr['PV']."</li><br/>";

// 		}
// 		echo "</ul>";
// 	}


// 	/*
// 	$stmt = mysqli_prepare($BDD, "SELECT * FROM Pokemon WHERE ID_Pkm = ?");
// 	mysqli_stmt_bind_param($stmt, 's', $ID);
// 	mysqli_execute($stmt);

// 	mysqli_stmt_bind_result($stmt, $pokm);
// 	while(mysqli_stmt_fetch($stmt));
// 	*/

// 	//return $pokm;  
// }




?>



