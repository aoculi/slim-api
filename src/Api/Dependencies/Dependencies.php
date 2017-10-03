<?php

namespace Api\Dependencies;

use Api\Provider;

class Dependencies extends Provider
{
    public function render(): array
    {
        return [
            NotAllowedHandler::class,
            //ErrorHandler::class,
            PhpErrorHandler::class,
            notFoundHandler::class,
            Flash::class,
            Event::class,
            HttpCache::class,
            DB::class
        ];
    }
}
