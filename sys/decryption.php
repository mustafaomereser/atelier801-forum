<?php
include("linkaccess.php");

class Decryption {

    public function generate_key($length=null) {
        $length = $length ?? rand(0x10, 0x20);
        $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!\"#$%&\'()*+,-./:;<=>?@[\\]^_`{|}~";
        $output = "";
        for ($i=0;$i < $length;$i++) {
            $output .= $chars[rand(0, strlen($chars)-1)];
        }
        return $output;
    }

    public function decrypt($value, $key="YORMOM48") {		
		
        $value = base64_decode($value);
        $decrypted = "";

        for ($i=0;$i < strlen($value);$i++) {
            $decrypted .= chr(ord($value[$i]) - ord($key[($i + 1) % strlen($key)]));
        }
        return $decrypted;
    }

    public function encrypt($value, $key="YORMOM48") {
		
        $encrypted = "";
        for ($i=0;$i < strlen($value);$i++) {
            $encrypted .= chr(ord($value[$i]) + ord($key[($i + 1) % strlen($key)]));
        }
        return base64_encode($encrypted);
    }
	
}
?>