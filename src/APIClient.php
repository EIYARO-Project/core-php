<?php

declare(strict_types = 1);

namespace EIYARO;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class APIClient{
    private $client;
    private string $base_uri;
    private string|null $login;
    private string|null $password;
    private int $timeout;

    function __construct(string $base_uri, int $timeout, string|null $login = null, string|null $password = null){
        $this->client = new Client(
            [
                "base_uri"=> $base_uri,
                "timeout"=> $timeout
            ]
        );
        $this->base_uri = $base_uri;
        $this->timeout = $timeout;
        $this->login = $login;
        $this->password = $password;
    }

    function get(string $method): ResponseInterface {
        if ($this->login && $this->password){
            $response = $this->client->get(
                "/{$method}",
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
                "/{$method}"
            );
        }
        return $response;
    }

    function post(string $method, string|null $body = null): ResponseInterface {
        if ($this->login && $this->password){
            $response = $this->client->post(
                "/{$method}",
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
                "/{$method}",
                [
                    "body"=> $body,
                ]
            );
        }
        return $response;
    }

}
