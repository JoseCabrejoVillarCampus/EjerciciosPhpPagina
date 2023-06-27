//?Instructions
//?Implement a simple shift cipher like Caesar and a more secure substitution cipher.
//?
//?Step 1
//?"If he had anything confidential to say, he wrote it in cipher, that is, by so changing the order of the letters of the alphabet, that not a word could be made out. If anyone wishes to decipher these, and get at their meaning, he must substitute the fourth letter of the alphabet, namely D, for A, and so with the others." —Suetonius, Life of Julius Caesar
//?
//?Ciphers are very straight-forward algorithms that allow us to render text less readable while still allowing easy deciphering. They are vulnerable to many forms of cryptanalysis, but we are lucky that generally our little sisters are not cryptanalysts.
//?
//?The Caesar Cipher was used for some messages from Julius Caesar that were sent afield. Now Caesar knew that the cipher wasn't very good, but he had one ally in that respect: almost nobody could read well. So even being a couple letters off was sufficient so that people couldn't recognize the few words that they did know.
//?
//?Your task is to create a simple shift cipher like the Caesar Cipher. This image is a great example of the Caesar Cipher:
//?
//?Caesar Cipher
//?
//?For example:
//?
//?Giving "iamapandabear" as input to the encode function returns the cipher "ldpdsdqgdehdu". Obscure enough to keep our message secret in transit.
//?
//?When "ldpdsdqgdehdu" is put into the decode function it would return the original "iamapandabear" letting your friend read your original message.
<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */


declare(strict_types=1);

class SimpleCipher
{
    public $key;

    public function __construct(string $key = null)
    {
        if ($key === null) {
            $key = $this->generateRandomKey();
        } else {
            $this->validateKey($key);
        }

        $this->key = $key;
    }

    public function encode(string $plainText): string
    {
        $plainText = $this->normalizeText($plainText);
        $key = $this->getKeyForText($plainText);

        $cipherText = '';
        $length = strlen($plainText);
        for ($i = 0; $i < $length; $i++) {
            $shift = ord($key[$i]) - ord('a');
            $cipherChar = chr((ord($plainText[$i]) - ord('a') + $shift) % 26 + ord('a'));
            $cipherText .= $cipherChar;
        }

        return $cipherText;
    }

    public function decode(string $cipherText): string
    {
        $cipherText = $this->normalizeText($cipherText);
        $key = $this->getKeyForText($cipherText);

        $plainText = '';
        $length = strlen($cipherText);
        for ($i = 0; $i < $length; $i++) {
            $shift = ord($key[$i]) - ord('a');
            $plainChar = chr((ord($cipherText[$i]) - ord('a') - $shift + 26) % 26 + ord('a'));
            $plainText .= $plainChar;
        }

        return $plainText;
    }

    private function generateRandomKey(): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $key = '';
        $length = mt_rand(100, 200); // Generate a key with length between 100 and 200 characters
        $charactersLength = strlen($characters);
        for ($i = 0; $i < $length; $i++) {
            $key .= $characters[mt_rand(0, $charactersLength - 1)];
        }

        return $key;
    }

    private function validateKey(string $key): void
    {
        if (!preg_match('/^[a-z]+$/', $key)) {
            throw new InvalidArgumentException('Invalid key. Only lowercase letters are allowed.');
        }
    }

    private function normalizeText(string $text): string
    {
        return preg_replace('/[^a-z]+/', '', strtolower($text));
    }

    private function getKeyForText(string $text): string
    {
        $keyLength = strlen($this->key);
        $textLength = strlen($text);

        // If the key is shorter than the text, repeat the key to match the text length
        if ($keyLength < $textLength) {
            $repeatedKey = str_repeat($this->key, (int) ceil($textLength / $keyLength));
            $this->key = substr($repeatedKey, 0, $textLength);
        }

        return $this->key;
    }
}