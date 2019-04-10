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
function CreUser($BDD, $username, $MdP){
    
    $prepUser = mysqli_prepare($BDD, "INSERT INTO User(userName,userMDP, qtteThune) VALUES(?,?, 500)");
    mysqli_stmt_bind_param($prepUser, 'ss', $username, $MdP);
    mysqli_execute($prepUser);
    $ID = getIdNumber($BDD, $username);
    
    $newSac = mysqli_prepare($BDD, "INSERT INTO Sac VALUES(?, 5, 5)");
    mysqli_stmt_bind_param($newSac,'i', $ID);
    mysqli_execute($newSac);
    
    // $newEq = mysqli_prepare($BDD, "INSERT INTO Equipe VALUES(?, )");
    // mysqli_stmt_bind_param($newSac,'i', $ID);
    // mysqli_execute($newEq);


    // $UpUser = mysqli_prepare($BDD, "UPDATE User SET NumEq = ?, NumSac = ? WHERE ID_D = ?");
    // mysqli_stmt_bind_param($UpUser,'iii', $ID, $ID, $ID);
    // mysqli_execute($UpUser);
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



function getAtkName($BDD, $ID){
   
    $stmt = mysqli_prepare($BDD, "SELECT nomAtk FROM Attaques WHERE IDAtk = ?");
    mysqli_stmt_bind_param($stmt, 'i', $ID);
    mysqli_execute($stmt);
    mysqli_stmt_bind_result($stmt, $Atk);
    
    while(mysqli_stmt_fetch($stmt));
    return $Atk;    
}



function getPkmAtk($BDD, $ID){
    $stmt = mysqli_prepare($BDD, "SELECT * FROM PoAtk WHERE IDPkmPA = ?");
    mysqli_stmt_bind_param($stmt, 'i', $ID);
    mysqli_execute($stmt);
    mysqli_stmt_bind_result($stmt, $Atk1, $Atk2, $Atk3, $Atk4);
    while(mysqli_stmt_fetch($stmt));
    $AtkTab = array(
        "ID1" => $Atk1,
        "ID2" => $Atk2,
        "ID3" => $Atk3,
        "ID4" => $Atk4,
        "ATK1" => getAtkName($BDD, $Atk1),
        "ATK2" => getAtkName($BDD, $Atk2),
        "ATK3" => getAtkName($BDD, $Atk3),
        "ATK4" => getAtkName($BDD, $Atk4)
    );
    return $AtkTab; 
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



