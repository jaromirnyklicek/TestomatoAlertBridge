<?php

namespace TestomatoAlertBridge\Parser;

use Nette\Utils\Strings;

class BitrixParser
{
    public function parse($message)
    {
        $json = json_decode($message);
        $text = $json->text;

        $text = Strings::replace($text, '~:coffee:~', ':idea:');
        $text = Strings::replace($text, '~:fire:~', ':!:');
        $text = Strings::replace($text, '~[<>]~', '');
        $text = Strings::replace($text, '~\|plnapenezenka.cz:~', '');

        return $text;
    }
}