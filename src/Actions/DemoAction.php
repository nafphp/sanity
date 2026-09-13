<?php

declare(strict_types=1);

namespace Naf\Sanity\Actions;

class DemoAction implements ActionInterface
{

    public const string NAME = 'naf:demo';

     public function isDue(): bool
     {
         return true;
     }

     public function execute(): string
     {
         return 'Demo';
     }

}