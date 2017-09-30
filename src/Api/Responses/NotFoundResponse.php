<?php

namespace Api\Responses;

use Psr\Http\Message\ResponseInterface;

class NotFoundResponse
{
    /**
     * @param ResponseInterface $response
     * @param null|string $message
     * @param int|null $status
     * @return ResponseInterface
     */
    static public function send(ResponseInterface $response, ?string $message = 'The requested resource could not be found.', ?int $status = 404): ResponseInterface
    {
        $res = array(
            'error' => array(
                'code' => $status,
                'message' => $message
            )
        );

        return $response
            ->withStatus($status)
            ->withJson($res);
    }
}