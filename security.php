<?php
/**
*Fonction qui verifie que le mot de passe ne pose pas de probleme en échapant les caractères relous
* @param MdP1 un mot de passe a verifier
* @return 1 si le mot de passe pose probleme, 0 sinon
*/
function mdpValid($MdP1)
{
	
	$MdP2 = filter_var($MdP1, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	if($MdP2 == false || $MdP1 != $MdP2)
		return 1;
	
	else
		return 0;
}

/**
* Cette fonction sert a encrypter des données
* @param $data la donnée a crypter
* @return la donnée cryptée
*/
function cryptage($data){
	$key='faucibusturpisineumi';
	$method='ripemd160';

	$data = hash_hmac($method, $data, $key);

	return base64_encode($data);
}

/**
* Cette fonction sert a décrypter des données
* @param $mdpcrypte la donnée a décrypter
* @return la donnée décryptée
*/
function decrypt($mdpcrypte, $mdpentre){
	$key='faucibusturpisineumi';
	$method='ripemd160';

	$mdpcrypte = base64_decode($mdpcrypte);
	return password_verify($mdpcrypte, $mdpentre);
}

?>
