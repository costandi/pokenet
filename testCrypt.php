<?php

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


$messageAChiffrer = "Coucou je suis Guillaume";
$cleSecrete = "MaCleEstIncassable";


// On chiffre le message
$messageChiffre = encrypt($messageAChiffrer, $cleSecrete);

// Pour le lire
$messageDechiffrer = decrypt($messageChiffre, $cleSecrete);
?>
