<?php

namespace SERFF\Pm2Manager\Actions;

use SERFF\Pm2Manager\Domain\Pm2Process;
use Symfony\Component\Process\Process;

class StartProcessAction
{
    /**
     * @var \SERFF\Pm2Manager\Domain\Pm2Process
     */
    private Pm2Process $process;

    public function __construct(Pm2Process $process)
    {
        $this->process = $process;
    }

    public function run(): ?Pm2Process
    {
        $process = new Process($this->buildCommand((string) $this->process->id()));

        $process
            ->enableOutput()
            ->run();

        if (! $process->isSuccessful()) {
            throw new \Exception('Cannot run command');
        }

        return (new GetProcessById($this->process->id()))->run();
    }

    private function buildCommand(string $id)
    {
        return [
            'pm2',
            'start',
            $id,
        ];
    }
}
