<?php

declare(strict_types=1);

namespace Naf\Sanity\Actions;

interface ActionInterface
{
    public const string NAME = '';

    public function isDue();

    public function execute();
}
