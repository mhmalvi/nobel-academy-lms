<?php
namespace App\Http\Helpers;


class AppCryption{
    protected $options = 0;

    // Store the cipher method 
    protected $ciphering = "AES-256-CBC";

    // Non-NULL Initialization Vector for encryption 
    protected $encryption_iv = '1234567891234567';

    // Store the encryption key 
    protected $encryption_key = "akternashidrajin";

    /**
     * This will encrypt the given value
     */
    public function encrypt($value){
        $encryption = openssl_encrypt(
            $value,
            $this->ciphering,
            $this->encryption_key,
            $this->options,
            $this->encryption_iv
        );

        return base64_encode($encryption);
    }



    /**
     * This will decrypt the given value
     */
    public function decrypt($value){
        $decrypt = openssl_decrypt(
            base64_decode($value),
            $this->ciphering,
            $this->encryption_key,
            $this->options,
            $this->encryption_iv
        );

        return $decrypt;
    }
}
