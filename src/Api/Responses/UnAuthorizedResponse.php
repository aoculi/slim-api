<?php

namespace Api\Responses;

use Psr\Http\Message\ResponseInterface;

class UnAuthorizedResponse extends ApiResponse
{
    /**
     * @param ResponseInterface $response
     * @param null|string $message
     * @param int|null $status
     * @return ResponseInterface
     */
    public static function send(
        ResponseInterface $response,
        ?string $message = 'Authentication is required and has failed or has not yet been provided.',
        ?int $status = 401
    ): ResponseInterface {
        $res = [
            'error' => [
                'code' => $status,
                'message' => $message,
                'help' => ''
            ]
        ];

        return $response
            ->withStatus($status)
            ->withJson($res);
    }
}
