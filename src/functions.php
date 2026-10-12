<?php

declare(strict_types=1);

namespace Naf\Sanity;

function sanity(mixed $item): Sanity
{
    return Sanity::create($item);
}
