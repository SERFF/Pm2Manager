<?php

namespace SERFF\Pm2Manager\Actions;

use SERFF\Pm2Manager\Domain\Pm2Process;
use Symfony\Component\Process\Exception\ProcessTimedOutException;
use Symfony\Component\Process\Process;

class GetProcessLogAction
{
    /**
     * @var \SERFF\Pm2Manager\Domain\Pm2Process
     */
    private Pm2Process $process;

    public function __construct(Pm2Process $process)
    {
        $this->process = $process;
    }

    public function run(): array
    {
        $process = new Process($this->buildCommand((string) $this->process->id()));

        try {
            $process
                ->enableOutput()
                ->setTimeout(1)
                ->run();
        } catch (ProcessTimedOutException $timedOutException) {
            return explode(PHP_EOL, $process->getOutput());
        }

        return [];
    }

    private function buildCommand(string $id)
    {
        return [
            'pm2',
            'log',
            $id,
        ];
    }
}
