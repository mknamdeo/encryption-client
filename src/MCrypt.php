<?php

namespace Mknamdeo;

class MCrypt implements EncryptionInterface
{
    protected $iv = 'cg2x2hlisu9ol6f3';
    protected $key = "wss92am4877nwnxb";
    protected $isBinary = false;

    public function __construct($iv = null, $key = null, $isBinary = null)
    {
        if (!empty($iv)) {
            $this->iv = $iv;
        }
        if (!empty($key)) {
            $this->key = $key;
        }
        if (!empty($isBinary)) {
            $this->isBinary = $isBinary;
        }
    }

    public function encrypt($decryptedMessage)
    {
        $iv = $this->iv;
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
        $iv = $this->iv;
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

    public function setIv($iv)
    {
        $this->iv = $iv;
    }

    public function setIsBinary($isBinary)
    {
        $this->isBinary = $isBinary;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }
}

