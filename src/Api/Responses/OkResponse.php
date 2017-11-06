<?php

namespace Api\Responses;

use Psr\Http\Message\ResponseInterface;

class OkResponse extends ApiResponse
{

    /**
     * @param ResponseInterface $response
     * @param array $data
     * @param int|null $status
     * @param array|null $pagination
     * @return ResponseInterface
     */
    public static function send(ResponseInterface $response, array $data, ?int $status = 200, ?array $pagination = []): ResponseInterface
    {

        // Add metadata in response
        if($pagination && !empty($pagination)){
            $metadata = self::addMetadata($pagination);
            $data = array_merge($data, $metadata);
        }

        return $response
            ->withStatus($status)
            ->withJson($data);
    }
}
