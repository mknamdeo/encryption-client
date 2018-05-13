<?php

namespace Mknamdeo;

interface Encryption
{
    public function encrypt($message);

    public function decrypt($message);
}

class MCrypt implements Encryption
{
    const iv = 'cg2x2hlisu9ol6f3';
    public $key = "wss92am4877nwnxb";
    public $isBinary = false;

    public function encrypt($decryptedMessage)
    {
        $iv = self::iv;
        $str = $this->isBinary ? $decryptedMessage : utf8_decode($decryptedMessage);
        $td = mcrypt_module_open('rijndael-128', ' ', 'cbc', $iv);
        mcrypt_generic_init($td, $this->key, $iv);
        $encrypted = mcrypt_generic($td, $str);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return $this->isBinary ? $encrypted : bin2hex($encrypted);
    }

    public function decrypt($encryptedMessage)
    {
        $encryptedMessage = $this->isBinary ? $encryptedMessage : self::hex2bin($encryptedMessage);
        $iv = self::iv;
        $td = mcrypt_module_open('rijndael-128', ' ', 'cbc', $iv);
        mcrypt_generic_init($td, $this->key, $iv);
        $decrypted = mdecrypt_generic($td, $encryptedMessage);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return $this->isBinary ? trim($decrypted) : utf8_encode(trim($decrypted));
    }

    private static function hex2bin($hexdata)
    {
        $bindata = '';
        for ($i = 0; $i < strlen($hexdata); $i += 2) {
            $bindata .= chr(hexdec(substr($hexdata, $i, 2)));
        }
        return $bindata;
    }

}

