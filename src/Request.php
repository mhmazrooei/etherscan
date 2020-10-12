<?php

namespace Etherscan\Api;

use GuzzleHttp\Client;

class Request
{
    private $apiKey;
    private $network;
    private $baseUrl;
    private $request;
    private $query;

    public function __construct($apiKey, $network = 'api')
    {
        $this->apiKey = $apiKey;
        $this->network = $network;

        if (!in_array($network, ['api', 'ropsten'])) {
            return $this->response([
                'message' => 'Network is not valid!'
            ], 500);
        }

        $this->baseUrl = 'https://' . $network . '.etherscan.io/api';

        $this->request = new Client();
        $this->query['apikey'] = $this->apiKey;
    }

    protected function send()
    {
        try {
            $data = http_build_query($this->query);

            $url = $this->baseUrl . '?' . $data;

            $response = $this->request->get($url);

            $data = json_decode($response->getBody())->result;

            return $this->response($data);
        } catch (\Exception $e) {
            return $this->response([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function response($data, $status = 200)
    {
        header_remove();

        header('Content-Type: application/json; charset=utf-8');

        http_response_code($status);

        echo json_encode($data);

        exit();
    }

    public function setQuery(array $query)
    {
        $this->query = array_merge($this->query, $query);
    }
}