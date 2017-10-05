<?php

namespace Api\Interfaces;

use Api\App;

interface EndpointInterface
{

    public function __construct(App $app);

    public function getApiVersion():string;

    public function render(): void;

    public function getMigration();

    public function getSeed();
}
