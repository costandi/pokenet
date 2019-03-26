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
*/
//__________________________________________________________________________________


function GenerBDD(){
    $BDD=mysqli_connect("localhost","","","pokenet");
    if(!$BDD){
        die("<p>connexion impossible</p>");
    }
    else return $BDD;
    
}

function CreUser($BDD, $username, $MdP){
    
    $prepUser = mysqli_prepare($BDD, "INSERT INTO User(UserName,User_MDP) VALUES(?,?)");

    mysqli_stmt_bind_param($prepUser, 'ss', $username, $MdP);
    mysqli_execute($prepUser);
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

    echo "Vrai mdp= ".$MDPvalide."<br>MDP 2 look: ".$MDP2check."<br>";

    
    if ($MDPvalide == $MDP2check)
        return true;
    else
        return false;
    
}

?>
