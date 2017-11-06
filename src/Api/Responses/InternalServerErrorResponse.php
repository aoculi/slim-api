<?php

namespace Api\Responses;

use Psr\Http\Message\ResponseInterface;

class InternalServerErrorResponse extends ApiResponse
{
    /**
     * @param ResponseInterface $response
     * @param null|string $message
     * @param int|null $status
     * @return ResponseInterface
     */
    public static function send(
        ResponseInterface $response,
        ?string $message = 'Internal Server Error. '.
        'The server encountered an internal error or misconfiguration and was unable to complete your request.',
        ?int $status = 500
    ): ResponseInterface {
        $res = [
            'error' => [
                'code' => $status,
                'message' => $message
            ]
        ];

        return $response
            ->withStatus($status)
            ->withJson($res);
    }
}
