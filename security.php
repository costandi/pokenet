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

//Fonction qui encrypte des données avec un message a crypter & une clef.
//Source : https://openclassrooms.com/fr/courses/2644516-securisez-les-mots-de-passe-des-utilisateurs-avec-php
function encrypt($pure_string, $encryption_key) {

    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);

    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);

    return $encrypted_string;

}

//Fonction qui decrypte des données avec un message a décrypter & une clef.
//Source : https://openclassrooms.com/fr/courses/2644516-securisez-les-mots-de-passe-des-utilisateurs-avec-php
function decrypt($encrypted_string, $encryption_key) {

    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);

    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);

    return $decrypted_string;
}

function clef()
{
    return "faucibusturpisineumi";
}
?>
