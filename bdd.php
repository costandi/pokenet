<?php
/*
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

//Verifier si un MDP donné et un Nom d'utilisateur donné existent dans la BDD: return true si l'utilisateut et le MDP est correct et false sinon. Prend en parametre une base de donnée, un nom utilisateur a verifier et un mot de passe crypté a verifier
//Fonction personelle
       function checkUserBDD($BDD, $UNcheck, $MDP2check);
//_____________________________________________________________________________
*/

function GenerBDD(){
    $BDD=mysqli_connect("localhost","","","pokenet");
    if(!$BDD){
        die("<p>connexion impossible</p>");
    }
    else return $BDD;
    
}

function CreUser($BDD, $username, $MdP){
    
    $prepUser = mysqli_prepare($BDD, "INSERT INTO User(UserName,User_MDP,NumEq, NumSac, QteThune) VALUES(?,?, 0, 0, 500)");

    mysqli_stmt_bind_param($prepUser, 'ss', $username, $MdP);
    mysqli_execute($prepUser);

    $ID = getIdNumber($BDD, $username);
    
    $newSac = mysqli_prepare($BDD, "INSERT INTO Sac VALUES(?, 0, 0)");
    mysqli_stmt_bind_param($newSac,'i', $ID);
    mysqli_execute($newSac);

    $UpUser = mysqli_prepare($BDD, "UPDATE User SET NumSac = ? WHERE ID_D = ?");
    mysqli_stmt_bind_param($UpUser,'ii', $ID, $ID);
    mysqli_execute($UpUser);

    
    $newEq = mysqli_prepare($BDD, "INSERT INTO Equipe VALUES(?, null, null, null, null, null, null)");
    mysqli_stmt_bind_param($newSac,'i', $ID);
    mysqli_execute($newEq);

    $UpUser = mysqli_prepare($BDD, "UPDATE User SET NumEq = ? WHERE ID_D = ?");
    mysqli_stmt_bind_param($UpUser,'ii', $ID, $ID);
    mysqli_execute($UpUser);
}

function fermerBDD($BDD){
    mysqli_close($BDD);
}

function checkUserBDD($BDD, $UNcheck, $MDP2check){
    $stmt = mysqli_prepare($BDD, "SELECT User_MDP FROM User WHERE UserName = ?");
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
    $stmt = mysqli_prepare($BDD, "SELECT ID_D FROM User WHERE UserName = ?");
    mysqli_stmt_bind_param($stmt, 's', $User);
    mysqli_execute($stmt);
    mysqli_stmt_bind_result($stmt, $ID);

    while(mysqli_stmt_fetch($stmt));
    
    return $ID;
    
}
function getUsername($BDD, $ID)
{
    $stmt = mysqli_prepare($BDD, "SELECT Username FROM User WHERE ID_D = ?");
    mysqli_stmt_bind_param($stmt, 'i', $ID);
    mysqli_execute($stmt);
    mysqli_stmt_bind_result($stmt, $User);

    while(mysqli_stmt_fetch($stmt));
    
    return $User;
    
}

?>
