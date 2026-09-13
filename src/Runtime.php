<?php

declare(strict_types=1);

namespace Naf\Sanity;

use Naf\Sanity\Actions\ActionInterface;

class Runtime
{

    private array $actions = [];

    public function run(): void
    {
        $this->loadActions();
        var_dump($this->actions);
    }

    private function loadActions(): void
    {
        $actions = glob(__DIR__ . '/Actions/*.php');
        $actions = array_filter($actions, function ($action) {
            return !str_contains($action, 'ActionInterface');
        });

        $namespace = 'Naf\Sanity\Actions';

        foreach ($actions as $action) {
            $res = str_replace(__DIR__ . '/Actions/', '', $action);
            $res = str_replace('.php', '', $res);
            $res = $namespace . '\\' . $res;
            $obj = new $res();
            if ($obj instanceof ActionInterface) {
                $this->actions[$obj::NAME] = $obj;
            }
        }
    }

}