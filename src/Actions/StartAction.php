<?php

namespace SERFF\Pm2Manager\Actions;

use Symfony\Component\Process\Process;

class StartAction
{
    private string $command;

    public function __construct(string $command)
    {
        $this->command = $command;
    }

    public function run()
    {
        $process = new Process($this->buildCommand($this->command));

        $process
            ->enableOutput()
            ->run();

        if (! $process->isSuccessful()) {
            throw new \Exception('Cannot run command');
        }

        var_dump($process->getOutput());
        exit;
    }

    private function buildCommand(string $command)
    {
        return [
            'pm2',
            'start',
            $command,
        ];
    }
}
