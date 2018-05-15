<?php

namespace Mknamdeo;

abstract class AbstractEncryptionFactory
{
    abstract public function createEncryptor($encryptionType);
}