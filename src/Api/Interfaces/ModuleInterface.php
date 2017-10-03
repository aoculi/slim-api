<?php

namespace Api\Interfaces;

use Api\App;

interface ModuleInterface
{
    public function __construct(App $app);
}
