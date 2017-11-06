<?php

namespace Api\Responses;

use Psr\Http\Message\ResponseInterface;

class NotFoundResponse extends ApiResponse
{
    /**
     * @param ResponseInterface $response
     * @param null|string $message
     * @param int|null $status
     * @return ResponseInterface
     */
    public static function send(
        ResponseInterface $response,
        ?string $message = 'The requested resource could not be found.',
        ?int $status = 404
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
