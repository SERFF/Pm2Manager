<?php

namespace SERFF\Pm2Manager\Actions;

use Symfony\Component\Process\Process;

class PersistAllAction
{
    public function __construct()
    {
    }

    public function run()
    {
        $process = new Process($this->buildCommand());

        $process
            ->enableOutput()
            ->run();

        if (! $process->isSuccessful()) {
            throw new \Exception('Cannot run command');
        }

        return true;
    }

    private function buildCommand()
    {
        return [
            'pm2',
            'save',
        ];
    }
}
