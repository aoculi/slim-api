<?php

namespace Api\Interfaces;

use Api\App;

interface ProviderInterface
{

    public function __construct(App $app);

    public function render(): array;
}
