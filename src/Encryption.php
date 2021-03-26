<?php

namespace EncryptionHandler\Encryption;

class Encryption 
{
    protected $key;
    protected $method;
    protected $data;
    protected $iv;

    function __construct($data, $key = '', $method = 'AES-256-CBC', $InitialVector = '') {
        $this->data = $data;
        $this->key = $this->passwordDeriveBytes($key, null);
        $this->method = $method;
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

    function encrypt(): string {
        return openssl_encrypt($this->data, "aes-256-cbc", $this->key, 0, $this->iv);
    }

    function decrypt($encrypted_data = ""): string {
        return openssl_decrypt($encrypted_data, "aes-256-cbc", $this->key, 0, $this->iv);
    }
}