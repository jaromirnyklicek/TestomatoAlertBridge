<?php

use jakubenglicky\SmsManager\Http\Client;
use jakubenglicky\SmsManager\Message\Message;

require_once __DIR__ . '/src/Bitrix/RestClient.php';
require_once __DIR__ . '/src/Bitrix/ChatBot.php';
require_once __DIR__ . '/vendor/autoload.php';

if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::create(__DIR__);
    $dotenv->load();
}


/*$msg = new Message();
$msg->setTo(['+420604985457']);
$msg->setBody('Test poslani SMS.');

$client = new Client('');
$client->send($msg);
*/

$bitrixEndpoint = getenv('BITRIX_ENDPOINT');

$client = new \TestomatoAlertBridge\Bitrix\RestClient($bitrixEndpoint);
$chatbot = new \TestomatoAlertBridge\Bitrix\ChatBot($client);
$chatbot->sendMessage('Test z monitoringu', 1060);