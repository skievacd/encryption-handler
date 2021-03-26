<?php

namespace EncryptionHandler\Encryption;

class Encryption 
{
    protected $key;
    protected $method;
    protected $data;
    protected $iv;

    function __construct($key = '', $InitialVector = '') {
        $this->key = $this->passwordDeriveBytes($key, null);
        $this->iv = $InitialVector;
    }

    function passwordDeriveBytes($password, $salt, $iterations = 100, $len = 32) {
        $key = $password . $salt;
        for($i = 0; $i < $iterations; $i++) {
            $key = sha1($key, true);
        }
        if (strlen($key) < $len) {
            $hx = $this->passwordDeriveBytes($password, $salt, $iterations - 1, 20);
            $counter = 0;
            while (strlen($key) < $len) {
                $counter += 1;
                $key .= sha1($counter . $hx, true);
            }
        }
        return substr($key, 0, $len);
    }

    function encrypt($data = ""): string {
        return openssl_encrypt($data, "aes-256-cbc", $this->key, 0, $this->iv);
    }

    function decrypt($encrypted_data = ""): string {
        return openssl_decrypt($encrypted_data, "aes-256-cbc", $this->key, 0, $this->iv);
    }
}