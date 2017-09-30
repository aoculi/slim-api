<?php

namespace Api\Responses;

use Psr\Http\Message\ResponseInterface;

class DeletedResponse
{
    /**
     * @param ResponseInterface $response
     * @param int|null $status
     * @return ResponseInterface
     */
    static public function send(ResponseInterface $response, ?int $status = 204): ResponseInterface
    {
        return $response
            ->withStatus($status);
    }
}