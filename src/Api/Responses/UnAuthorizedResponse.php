<?php

namespace Api\Responses;

use Psr\Http\Message\ResponseInterface;

class UnAuthorizedResponse
{
    /**
     * @param ResponseInterface $response
     * @param null|string $message
     * @param int|null $status
     * @return ResponseInterface
     */
    static public function send(ResponseInterface $response, ?string $message = 'Authentication is required and has failed or has not yet been provided.', ?int $status = 401): ResponseInterface
    {
        $res = array(
            'error' => array(
                'code' => $status,
                'message' => $message,
                'help' => ''
            )
        );

        return $response
            ->withStatus($status)
            ->withJson($res);
    }
}