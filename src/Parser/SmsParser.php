<?php
namespace TestomatoAlertBridge\Parser;

class SmsParser
{
    public function parse($message)
    {
        return substr($message, 0, 160);
    }
}