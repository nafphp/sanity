<?php

declare(strict_types=1);

namespace NixPHP\Sanity\Actions;

class DemoAction implements ActionInterface
{

    public const string NAME = 'nixphp:demo';

     public function isDue(): bool
     {
         return true;
     }

     public function execute(): string
     {
         return 'Demo';
     }

}