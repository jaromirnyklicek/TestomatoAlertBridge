<?php
namespace TestomatoAlertBridge\Bitrix;

/**
 * Bitrix24 chat bot
 * @author David Hubner
 */
class ChatBot
{

    const DEFAULT_CHAT_ID = 1;

    /**
     * @var RestClient
     */
    private $client;

    /**
     * Dependency injection
     * @param int $chatId
     * @param \Pp\Bitrix\RestClient $client
     */
    public function __construct(RestClient $client)
    {
        $this->client = $client;
    }

    /**
     * Sends message to Bitrix
     * @param  string $message
     * @param  int $chatId - chat ID, default 1
     * @param  bool $system - system message, default true
     * @return bool
     */
    public function sendMessage(string $message, int $chatId = self::DEFAULT_CHAT_ID, bool $system = false)
    {
        try {
            $this->client->call('im.message.add', [
                'CHAT_ID' => ($chatId ? $chatId : $this->chatId),
                'MESSAGE' => $message,
                'SYSTEM' => ($system ? 'Y' : 'N')
            ]);
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }
}
