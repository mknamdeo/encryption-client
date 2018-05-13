<?php

namespace Mknamdeo\Test;

use Mknamdeo\Encrypt;
use Mknamdeo\MCrypt;

class EncryptTest extends \PHPUnit_Framework_TestCase
{
    // Original text and encrypted text should be different.
    public function testOriginalTextShouldNotMatchEncryptedText()
    {
        $crypto = new Encrypt(new \Mknamdeo\MCrypt);
        $decrypted_message = "This is a test string.";
        $encrypted_message = $crypto->encrypt($decrypted_message);

        $this->assertNotEquals($encrypted_message, $decrypted_message);
    }

    // Original text and decrypted text should be same. Reversable.
    public function testOriginalTextShouldMatchDecryptedText()
    {
        $crypto = new Encrypt(new \Mknamdeo\MCrypt);
        $original_message = "This is a test string.";
        $encrypted_message = $crypto->encrypt($original_message);
        $decrypted_message = $crypto->decrypt($encrypted_message);
        $this->assertEquals($original_message, $decrypted_message);
    }

    // Text encrypted with different keys should be different.
    public function testSameTextEncriptedWithDifferentKeysShouldNotMatch()
    {

        $original_message = "This is a test string.";

        $crypto_one = new Encrypt(new \Mknamdeo\MCrypt);
        $crypto_one->setKey("1234567890abcdef");

        $crypto_two = new Encrypt(new \Mknamdeo\MCrypt);
        $crypto_two->setKey("abcdefghijklmnop");

        $this->assertNotEquals($crypto_one->encrypt($original_message),
            $crypto_two->encrypt($original_message));
    }

    // Text encrypted with different keys when decrypted should be same.
    public function testSameEncryptedTextWhenRestoredDifferentKeysShouldMatch()
    {

        $original_message = "This is a test string.";

        $crypto_one = new Encrypt(new \Mknamdeo\MCrypt);
        $crypto_one->setKey("1234567890abcdef");

        $crypto_two = new Encrypt(new \Mknamdeo\MCrypt);
        $crypto_two->setKey("abcdefghijklmnop");

        $this->assertEquals(
            $crypto_one->decrypt(
                $crypto_one->encrypt($original_message)),
            $crypto_two->decrypt(
                $crypto_two->encrypt($original_message))
        );
    }

}
