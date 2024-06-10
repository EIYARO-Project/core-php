<?php
declare(strict_types = 1);

namespace EIYARO;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface for an HTTP Client
 */
interface APIClientInterface {
    /**
     * Make a request using the GET method
     * 
     * @param string $endpoint The endpoint name
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get(string $endpoint): ResponseInterface;

    /**
     * Make a request using the POST method
     * 
     * @param string $endpoint The endpoint name
     * @param string|null $body The body for the POST request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post(string $endpoint, string|null $body = null): ResponseInterface;
}
