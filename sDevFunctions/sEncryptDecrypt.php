<?php
/**
 * Created by Stratusolve (Pty) Ltd in South Africa.
 * @author     johangriesel <info@stratusolve.com>
 *
 * Copyright (C) 2017 Stratusolve (Pty) Ltd - All Rights Reserved
 * Modification or removal of this script is not allowed. In order
 * to include this script within your solution you require express
 * permission from Stratusolve (Pty) Ltd.
 * Please reference the sDev SaaS Subscription license agreement. A
 * copy of this agreement can be obtained by sending an email to
 * info@stratusolve.co
 *
 *
 * THIS FILE SHOULD NOT BE EDITED. sDev assumes the integrity of this file. If you edit this file, it could be overridden by a future sDev update
 */
class sEncryptDecrypt {
    protected $key;
    protected $encryptedData,$decryptedData;

    public function __construct($decryptPhrase = 'password'){
        $this->key = hash("SHA256", $decryptPhrase, true); //we want a 32 byte binary blob;
    }

    public function encryptData($data) {
        # show key size use either 16, 24 or 32 byte keys for AES-128, 192
        # and 256 respectively
        $key_size =  strlen($this->key);

        $plaintext = $data;

        # create a random IV to use with CBC encoding
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

        # creates a cipher text compatible with AES (Rijndael block size = 128)
        # to keep the text confidential
        # only suitable for encoded input that never ends with value 00h
        # (because of default zero padding)
        $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key,
            $plaintext, MCRYPT_MODE_CBC, $iv);
        $hashedCipher = hash("SHA256", $ciphertext, true);
        # prepend the IV for it to be available for decryption
        $ciphertext = $iv . $hashedCipher . $ciphertext;

        # encode the resulting cipher text so it can be represented by a string
        $ciphertext_base64 = base64_encode($ciphertext);
        $this->encryptedData = $ciphertext_base64;

        return $this->encryptedData;
    }
    public function decryptData($data) {
        # === WARNING ===

        # Resulting cipher text has no integrity or authenticity added
        # and is not protected against padding oracle attacks.

        # --- DECRYPTION ---

        $ciphertext_dec = base64_decode($data);

        # retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $iv_dec = substr($ciphertext_dec, 0, $iv_size);
        $hashedCipher = substr($ciphertext_dec,$iv_size,32);

        # retrieves the cipher text (everything except the $iv_size in the front)
        $ciphertext_dec = substr($ciphertext_dec, $iv_size+32);

        set_error_handler(function() {
            /* ignore errors */
            $this->decryptedData = '';
            return $this->decryptedData;
        });
        # may remove 00h valued characters from end of plain text
        $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key,
            $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
        restore_error_handler();

        $cleanedPlainText = htmlspecialchars(trim(strip_tags($plaintext_dec)));
        if (base64_encode(hash("SHA256", $ciphertext_dec, true)) == base64_encode($hashedCipher)) {
            // Success
            $this->decryptedData = $cleanedPlainText;
        } else {
            // Fail... Not the correct data...
            $this->decryptedData = $cleanedPlainText.'

___________________________________________________________
This message might have been altered during transmission...';
            //$this->decryptedData = $cleanedPlainText;
        }
        return $this->decryptedData;
    }
}
?>
