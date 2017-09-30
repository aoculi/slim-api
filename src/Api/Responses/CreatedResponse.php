<?php

namespace Api\Responses;

use Psr\Http\Message\ResponseInterface;

class CreatedResponse
{
    /**
     * @param ResponseInterface $response
     * @param array $data
     * @param int|null $status
     * @return ResponseInterface
     */
    static public function send(ResponseInterface $response, array $data, ?int $status = 201): ResponseInterface
    {
        return $response
            ->withStatus($status)
            ->withJson($data);
    }
}