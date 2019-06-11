<?php
namespace TestomatoAlertBridge\Bitrix;

/**
 * Bitrix24 REST client
 * @author David Hubner
 */
class RestClient
{

    /**
     * @var string
     */
    private $endpoint;

    /**
     * Create client
     * @param string $endpoint
     */
    public function __construct(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     *
     * @param  string $method
     * @param  array $params
     * @return array
     * @throws \RuntimeException
     */
    public function call(string $method, array $params = null)
    {
        $url = rtrim($this->endpoint . '/') . '/' . $method . '/';

        if ($params) {
            $url .= '?' . http_build_query($params);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('API response not well-formed (' . json_last_error() . ')');
        }

        return $result;
    }
}
