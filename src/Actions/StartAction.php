<?php

namespace SERFF\Pm2Manager\Actions;

use SERFF\Pm2Manager\Domain\Pm2Process;
use SERFF\Pm2Manager\Helpers\OutputHelper;
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

        return new Pm2Process(['name' => $name = OutputHelper::parseName($this->command)]);
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
