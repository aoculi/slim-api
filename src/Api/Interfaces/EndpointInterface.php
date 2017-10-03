<?php

namespace Api\Interfaces;

use Api\App;

interface EndpointInterface
{

    public function __construct(App $app);

    public function render(): void;
}
