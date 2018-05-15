<?php

namespace Mknamdeo;

interface EncryptionInterface
{
    public function encrypt($message);

    public function decrypt($message);
}