<?php
namespace TestomatoAlertBridge\Parser;

use Nette\Utils\Strings;

class SmsParser
{
    public function parse($message)
    {
        $json = json_decode($message);
        $text = $json->text;

        $text = Strings::replace($text, '~:coffee:~', 'RESOLVED: ');
        $text = Strings::replace($text, '~:fire:~', 'ERROR: ');
        $text = Strings::replace($text, '~[<>]~', '');
        $text = Strings::replace($text, '~\|plnapenezenka.cz:~', '');

        return substr($text, 0, 160);
    }
}