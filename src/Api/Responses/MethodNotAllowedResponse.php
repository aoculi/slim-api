<?php

namespace Api\Responses;

use Psr\Http\Message\ResponseInterface;

class MethodNotAllowedResponse
{

    /**
     * @param ResponseInterface $response
     * @param null|string $message
     * @param int|null $status
     * @param array|null $methods
     * @return ResponseInterface
     */
    public static function send(
        ResponseInterface $response,
        ?string $message = 'This method is not supported for the requested resource.',
        ?int $status = 405,
        ?array $methods = []
    ): ResponseInterface {
        $res = [
            'error' => [
                'code' => $status,
                'message' => $message,
                'help' => ''
            ]
        ];

        $response = $response
            ->withStatus($status)
            ->withJson($res);

        if ($methods) {
            $response = $response->withHeader('Allow', implode(', ', $methods));
        }

        return $response;
    }
}
