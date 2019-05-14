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
class Chiffrement {
    
    // Algorithme utilisé pour le cryptage des blocs
    private static $cipher  = MCRYPT_RIJNDAEL_128;
    
    // Clé de cryptage         
    private static $key = "faucibusturpisineumi";
    
    // Mode opératoire (traitement des blocs)
    private static $mode    = 'cbc';
    
    public static function crypt($data){
        $keyHash = md5(self::$key);
        $key = substr($keyHash, 0, mcrypt_get_key_size(self::$cipher, self::$mode));
        $iv  = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode));
        
        $data = mcrypt_encrypt(self::$cipher, $key, $data, self::$mode, $iv);
        
        return base64_encode($data);
    }
    
    public static function decrypt($data){
        $keyHash = md5(self::$key);
        $key = substr($keyHash, 0,   mcrypt_get_key_size(self::$cipher, self::$mode) );
        $iv  = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode) );
        
        $data = base64_decode($data);
        $data = mcrypt_decrypt(self::$cipher, $key, $data, self::$mode, $iv);
        
        return rtrim($data);
    }
}

?>
