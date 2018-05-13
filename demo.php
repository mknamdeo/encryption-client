<?php

require 'vendor/autoload.php';

use Mknamdeo\Encrypt;

$crypto = new Encrypt(new Mknamdeo\MCrypt);
$encrypted_message = $crypto->encrypt("Manish");

print "<br/>Encrypted Message " . $encrypted_message;

$decrypted_message = $crypto->decrypt($encrypted_message);

print "<br/>Decrypted Message " . $decrypted_message;
