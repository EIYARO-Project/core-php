<?php

declare(strict_types = 1);

namespace EIYARO;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class APIClientGuzzle implements APIClientInterface {
    private Client $client;
    private string $base_uri;
    private string|null $login;
    private string|null $password;
    private int $timeout;
    private int $statusCode;
    private string $statusMessage;

    public function __construct(string $base_uri, int $timeout, string|null $accessToken = null){
        $this->client = new Client(
            [
                "base_uri"=> $base_uri,
                "timeout"=> $timeout
            ]
        );
        $this->base_uri = $base_uri;
        $this->timeout = $timeout;
        $this->login = null;
        $this->password = null;
        if ($accessToken !== null && str_contains($accessToken, ":")){
            list($this->login, $this->password) = explode(":", $accessToken);
        }
    }

    public function get(string $endpoint): ResponseInterface {
        if ($this->login && $this->password){
            $response = $this->client->get(
                "/{$endpoint}",
                [
                    "auth"=> [
                        $this->login,
                        $this->password,
                        'basic',
                    ],
                ]
            );
        } else {
            $response = $this->client->get(
                "/{$endpoint}"
            );
        }
        return $response;
    }

    public function post(string $endpoint, string|null $body = null): ResponseInterface {
        if ($this->login && $this->password){
            $response = $this->client->post(
                "/{$endpoint}",
                [
                    "body" => $body,
                    "auth"=> [
                        $this->login,
                        $this->password,
                        'basic',
                    ],
                ]
            );
        } else {
            $response = $this->client->post(
                "/{$endpoint}",
                [
                    "body"=> $body,
                ]
            );
        }
        return $response;
    }
}