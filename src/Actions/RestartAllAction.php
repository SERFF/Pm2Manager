<?php

namespace SERFF\Pm2Manager\Actions;

use SERFF\Pm2Manager\Helpers\OutputHelper;
use Symfony\Component\Process\Process;

class RestartAllAction
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

        return OutputHelper::parse($process->getOutput());
    }

    private function buildCommand()
    {
        return [
            'pm2',
            'restart',
            'all',
        ];
    }
}
