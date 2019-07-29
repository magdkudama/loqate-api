<?php

namespace MagdKudama\Loqate\Api;

abstract class BaseApiClient
{
    protected $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    private function checkResponse($response, $handle)
    {
        if ($response === false || curl_errno($handle) !== 0) {
            throw new ClientException('Invalid response from API');
        }

        $info = curl_getinfo($handle);
        if ($info['http_code'] > 300) {
            throw new ClientException('Invalid response. Code is: '.$info['http_code']);
        }
    }

    /**
     * @param string $uri
     * @return array
     * @throws ClientException
     */
    protected function executeGet(string $uri)
    {
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
        curl_setopt($handle, CURLOPT_URL, 'https://api.addressy.com/' . $uri);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        $curlResponse = curl_exec($handle);
        $this->checkResponse($curlResponse, $handle);
        curl_close($handle);

        $response = json_decode($curlResponse, true);
        if (!is_array($response)){
            throw new ClientException('Unable to decode value');
        }

        return $response;
    }
}
