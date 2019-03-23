<?php
/*
//Preparation de la BDD
//Fonction personelle. A modifier
      function GenerBDD();

//CreUser est une fonction qui insere un tuple dans la table User avec une base de donnée, un username et un mot de passe crypter
//Fonction personelle.
       function CreUser($BDD, $username, $MdP);

//Fermeture de la BDD
//fonction personelle pour les test.

       function fermerBDD();
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


?>
