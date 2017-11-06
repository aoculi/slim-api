<?php

namespace Api\Responses;


class ApiResponse
{
    /**
     * @var array
     */
    static $metadata = ["metadata" => []];

    /**
     * @return array
     */
    public static function getMetadata(): array
    {
        return self::$metadata;
    }

    /**
     * @param array|null $data
     * @return array
     */
    public static function addMetadata(?array $data = []): array
    {
        self::$metadata = array_merge(self::$metadata['metadata'], $data);
        return self::$metadata;
    }
}
