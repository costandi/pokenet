<?php
//Fonction qui verifie que le mot de passe nepose pas de probleme en échapant les caractères relous
//Fonction personelle
function mdpValid($MdP1)
{
	
	$MdP2 = filter_var($MdP1, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	if($MdP2 == false || $MdP1 != $MdP2)
		return 1;
	
	else
		return 0;
}

//Source : https://openclassrooms.com/fr/courses/2091901-protegez-vous-efficacement-contre-les-failles-web/2873202-protegez-les-donnees

	// Clé de cryptage         
	
	// Mode opératoire (traitement des blocs)
	
	function cryptage($data){
		$key='faucibusturpisineumi';
		$method='ripemd160';

		$data = hash_hmac($method, $data, $key);

		return base64_encode($data);
	}
	
	function decrypt($mdpcrypte, $mdpentre){
		$key='faucibusturpisineumi';
		$method='ripemd160';

		$mdpcrypte = base64_decode($mdpcrypte);
		return password_verify($mdpcrypte, $mdpentre);
	}


?>
