<?php

class DatalabSecurity
{

    private $public_key;
    private $private_key;


    function __construct()
    {
        $this->ci = &get_instance();
        //llave que se utiliza para encriptar el mensaje
        $this->private_key = '-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEA74bHo+pTi/iX/75hbu1QJ+XYReWOlTBw/3hT72a7S9Oo1NbG
bdH95bDyA3CrsumpTR6KIflXMOISUvWhIF8UVSZt05SsMfMRnCDgjzFBwtHrdtnO
F5OvId5myVQirgFrWd28uh6xyd9cTshp1hxuuDogN7/mu8O9grcbou1PUPJ3Q5u5
9viYTbwcGAuSfkgPuGdmSO3lcNtb/m1/0fuH0ZaX2X2Tw2X8xMmpsPYi5o/zPKSk
3ueGP4ppa1KWBRjHu+Uf0WnkHa3SDh1yuPYck0CR7S16kjfFIkPGPuMii58YpU5G
BE+k9Iw5GiPykBwrihS4X89HPawUcsB4bCQHJQIDAQABAoIBAQCoB94PgHghrkA7
ObwyTCq6AoTI6/QtdrEelrQTMvdbh11eClljezfpJUtx3F2nAkIxhqYSlU90THPc
XNIu2mRyI6ZSEm8GD2WgKHRAH6bpW8gaNUtdwM3QLavfurUlant7rJET5CqG2rlv
zypn+MQ3Wxd05JuhxvwwMfIiRuYoesRYTrhif82ubYRaIcM+4OJNPSnGlrLLkWR/
hA+WjalcrDDSI2rVv2noPZXMzFK9lZ0gXar9UWs61Iy03ZxLPwYSi68B3PSOKP6C
1fIB+6R9AoMNNz7/TkdKs7vGd7hZBs8WWs1s6YuX9nwVg4PsC+73wZ2xDo56+QNs
I+bd01d1AoGBAP8W3S2SuCR4wzlQsKjRb8RcVoxXLDm4Tv4k/VhcMc0+GUKF5lq/
Gik7tFRxbb4xhw9+6CyI4FwO7H4S28bYvx1QpCsykVkYNz0yIwG2cYumKBq/OnBj
93AsSsbymgC3y+Ns4coxjyfHygW2X61SCAj6JEISmRQ4GNH1SnP/55ZzAoGBAPBh
sUDOmqsLm1F9DrK5Y7HA3XqIrPGSscBc/YUnTV493RZv2/8KEEJYb7jZzN/MnUBi
vbn8V/T75HRwYMCoWnAa6p3qEUaK3TeZBIJ7vvrdKjHKIDVK4bUXUhprdw9ewHhZ
qUX/IvR4vKHaP///jbv2qiH47e0TfM5uKcm5UO4HAoGBAPxZYQrRh2tFMFQF+A25
yuilNFV3c1/SbgrLCvmbkwTodtKxZfXF8Zpy3u1enOM3WdZBhGtyKQnJFbmO7G5l
Q4M7oHy/dLx/0T2v2KO8Gc293RTAso42xrTojD0OCL3HFWNx9lgw+N6wrbFC/pmW
ei5vTukyPs+awysJjtL8iNzzAoGAJBeG9aQPtP7ZIzMTseIEBfxfRLagwOS1q5xK
tGNiSnQfbe79qR1ps4xzud151WBze+dXdUVeL3piotj8rfCZI5vm/i7WyTCwZlij
RLQvyJrMaw1eKKJFoVsPCMh55+TiIS/VKp1UMkCukd6jHVzRexdeFBu8HYx/gL8p
pxAcBqECgYAiJPJ8BimXAbBUsnpQgiPt4bSoYOcIysvZ9bK4iQTIiwUzd3/D9MWh
mO2pyvvgXFHX7/Mk6bA5UI1ee+hXjsuWQna70jOUure2sJVtA0D41+Iel93iXcNe
G6VE05PfvHKg4NjXvLyiolYGjAdiAaYHvw2IoIZB8OQZNZbpzPXwCA==
-----END RSA PRIVATE KEY-----';

        //llave que se utiliza para desencriptar el mensaje
        $this->public_key = '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA74bHo+pTi/iX/75hbu1Q
J+XYReWOlTBw/3hT72a7S9Oo1NbGbdH95bDyA3CrsumpTR6KIflXMOISUvWhIF8U
VSZt05SsMfMRnCDgjzFBwtHrdtnOF5OvId5myVQirgFrWd28uh6xyd9cTshp1hxu
uDogN7/mu8O9grcbou1PUPJ3Q5u59viYTbwcGAuSfkgPuGdmSO3lcNtb/m1/0fuH
0ZaX2X2Tw2X8xMmpsPYi5o/zPKSk3ueGP4ppa1KWBRjHu+Uf0WnkHa3SDh1yuPYc
k0CR7S16kjfFIkPGPuMii58YpU5GBE+k9Iw5GiPykBwrihS4X89HPawUcsB4bCQH
JQIDAQAB
-----END PUBLIC KEY-----';


    }

    public function procesar_datos_entrada($texto_cifrado){ //texto cifrado is array
        
        $output = '';
        foreach($texto_cifrado as $item){
            $desencriptado_rsa = $this->decifrar_rsa($item);            
            $separated_desencriptado_rsa = explode("<-->",$desencriptado_rsa);            
            $encriptado_aes = $separated_desencriptado_rsa[0];           
            $estructura_desencriptado = $separated_desencriptado_rsa[1];           
            $cadena_texto_plano_respuesta = $this->decifrar_aes($encriptado_aes,$estructura_desencriptado);            
            $output.=$cadena_texto_plano_respuesta;
        }
        
        return json_decode($output);
    }

    public function procesar_datos_salida($json_entrada){

        $max_length = 64; //bloques de 64 bytes   

        $offset = 0;
        $output = [];
        while($offset < strlen($json_entrada)){
            $subcadena = substr($json_entrada,$offset,$max_length);
            $offset +=$max_length;
           
            //proceso de cifrado por bloques
            $llave_cifrado = $this->get_key_128_bits();

            $estructura_cifrado = json_decode($this->cifrar_aes($llave_cifrado,$subcadena));
            $estructura_decifrado = ['salt'=>$estructura_cifrado->salt,'iv'=>$estructura_cifrado->iv,'key'=>$llave_cifrado];
            $cadena_aes = $estructura_cifrado->ciphertext.'<-->'.json_encode($estructura_decifrado);            
            $texto_encriptado_rsa = $this->cifrar_rsa($cadena_aes,$this->public_key);  
            
            $output[] = $texto_encriptado_rsa;            

        }

        
        return $output;
    }

    private function get_key_128_bits()
    {
        $longitud_cadena = 16; //16 bytes = 128 bits
        $alfabeto = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $cadena = "";
        for ($i = 0; $i < $longitud_cadena; $i++) {
            $index = rand(0, strlen($alfabeto) - 1);
            $cadena .= $alfabeto[$index];
        }
        return $cadena;
    }

    private function decifrar_aes($passphrase, $jsonString){

        //viene cifrado desde javascript

        $jsondata = json_decode($jsonString, true);
        $key = $jsondata['key'];
        try {
            $salt = hex2bin($jsondata["salt"]);
            $iv  = hex2bin($jsondata["iv"]);
        } catch(Exception $e) { return null; }

        $ciphertext = base64_decode($passphrase);
        $iterations = 999; //same as js encrypting

        $key = hash_pbkdf2("sha512", $key, $salt, $iterations, 64);

        $decrypted= openssl_decrypt($ciphertext , 'aes-256-cbc', hex2bin($key), OPENSSL_RAW_DATA, $iv);

        return $decrypted;

    }

    private function cifrar_aes($passphrase, $plain_text){

        //cifrado para ser leido en javascript
        $salt = openssl_random_pseudo_bytes(4);
        $iv = openssl_random_pseudo_bytes(16);
        //on PHP7 can use random_bytes() istead openssl_random_pseudo_bytes()
        //or PHP5x see : https://github.com/paragonie/random_compat

        $iterations = 999;
        $key = hash_pbkdf2("sha512", $passphrase, $salt, $iterations, 64);

        $encrypted_data = openssl_encrypt($plain_text, 'aes-256-cbc', hex2bin($key), OPENSSL_RAW_DATA, $iv);

        $data = array("ciphertext" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "salt" => bin2hex($salt));
        return json_encode($data);
    }


    private function cifrar_rsa($texto_plano){
        openssl_public_encrypt($texto_plano, $texto_encriptado, $this->public_key);
        return base64_encode($texto_encriptado);
    }

    private function  decifrar_rsa($texto_cifrado){
        openssl_private_decrypt(base64_decode($texto_cifrado), $texto_desencriptado, $this->private_key);
        return $texto_desencriptado;
    }




}
