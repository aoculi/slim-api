<?php

namespace Api\Responses;

use Psr\Http\Message\ResponseInterface;

class UnProcessableEntityResponse
{
    /**
     * @param ResponseInterface $response
     * @param string $message
     * @param int|null $status
     * @return ResponseInterface
     */
    static public function send(ResponseInterface $response, string $message, ?int $status = 422):ResponseInterface
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