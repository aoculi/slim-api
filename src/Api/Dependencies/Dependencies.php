<?php

namespace Api\Dependencies;

use Api\Provider;

class Dependencies extends Provider
{
    public function get(): array
    {
        return [
            ErrorHandler::class,
            PhpErrorHandler::class,
            notFoundHandler::class,
            NotAllowedHandler::class,
            Flash::class,
            Event::class,
            HttpCache::class,
            DB::class
        ];
    }
}