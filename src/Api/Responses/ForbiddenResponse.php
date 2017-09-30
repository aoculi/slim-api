<?php

namespace Api\Responses;

use Psr\Http\Message\ResponseInterface;

class ForbiddenResponse
{
    /**
     * @param ResponseInterface $response
     * @param null|string $message
     * @param int|null $status
     * @return ResponseInterface
     */
    static public function send(ResponseInterface $response, ?string $message = 'You are not authorized to access this resource.', ?int $status = 403): ResponseInterface
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