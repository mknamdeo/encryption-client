<?php

namespace Mknamdeo;

use Mknamdeo\EncryptionInterface;

class Encrypt
{
    protected $encryptor;

    public function __construct(EncryptionInterface $encryptor)
    {
        $this->encryptor = $encryptor;
    }

    public function encrypt($message)
    {
        return $this->encryptor->encrypt($message);
    }

    public function decrypt($message)
    {
        return $this->encryptor->decrypt($message);
    }

    public function setKey($key)
    {
        $this->encryptor->key = $key;
    }
}
