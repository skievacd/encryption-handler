# Encryption Handler

_Provee los métodos de encriptar y desencriptar información utilizando el esquema de cifrado aes-256-cbc_

### Instalación 

```
composer require skievacd/encryption-handler
```

### Uso 

_Para encriptación de información primero instancie la clase pasando como argumento el password y el vector inicial que debe ser una cadena de texto de 16 bytes. Utilice el método "encrypt(), el mismo devolverá la información encriptada"_


```
use EncryptionHandler\Encryption\Encryption;

 $encryption = new Encryption("password", "texto como vector inicial de 16 bytes");
 $encrypted_data = $encryption->encrypt("data a encriptar");

```

_Puede generar una cadena aleatoria de 16 bytes en https://passwordsgenerator.net/"_


_Para desencriptar información primero instancie la clase pasando como argumento el password y el vector inicial que debe ser una cadena de texto de 16 bytes. Utilice el método "decrypt(), el mismo devolverá la información original desencriptada"_


```
use EncryptionHandler\Encryption\Encryption;

 $encryption = new Encryption("password", "texto como vector inicial de 16 bytes");
 $data = $encryption->decrypt($encrypted_data);

```




