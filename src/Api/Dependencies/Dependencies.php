<?php

namespace Api\Dependencies;

use Api\AbstractProvider;

class Dependencies extends AbstractProvider
{
    public function render(): array
    {
        return [
            NotAllowedHandler::class,
            //ErrorHandler::class,
            PhpErrorHandlerAbstract::class,
            notFoundHandler::class,
            Flash::class,
            Event::class,
            HttpCache::class,
            DB::class
        ];
    }
}
