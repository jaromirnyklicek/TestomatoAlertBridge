<?php

use jakubenglicky\SmsManager\Http\Client;
use jakubenglicky\SmsManager\Message\Message;

require_once __DIR__ . '/src/Bitrix/RestClient.php';
require_once __DIR__ . '/src/Bitrix/ChatBot.php';
require_once __DIR__ . '/src/Parser/BitrixParser.php';
require_once __DIR__ . '/src/Parser/SmsParser.php';
require_once __DIR__ . '/vendor/autoload.php';

if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::create(__DIR__);
    $dotenv->load();
}

$message = file_get_contents("php://input");

if ($message) {
    $bitrixText = (new \TestomatoAlertBridge\Parser\BitrixParser())->parse($message);
    $smsText = (new \TestomatoAlertBridge\Parser\SmsParser())->parse($message);

    $msg = new Message();
    $msg->setTo(['+420604985457']);
    $msg->setBody($smsText);

    $client = new Client(getenv('SMS_API_KEY'));
    $client->send($msg);

    $bitrixEndpoint = getenv('BITRIX_ENDPOINT');

    $client = new \TestomatoAlertBridge\Bitrix\RestClient($bitrixEndpoint);
    $chatbot = new \TestomatoAlertBridge\Bitrix\ChatBot($client);
    $chatbot->sendMessage($bitrixText, 1060);
}