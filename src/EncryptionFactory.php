<?php

namespace Mknamdeo;

class EncryptionFactory extends AbstractEncryptionFactory
{
    protected $crypto;

    // Simple Factory
    public function createEncryptor($encryptionType)
    {
        switch ($encryptionType) {
            case 'MCrypt':
                $this->crypto = new \Mknamdeo\MCrypt;
                break;
            default:
                $this->crypto = null;
        }
        return $this->crypto;
    }
}