<?php

namespace SERFF\Pm2Manager\Actions;

use SERFF\Pm2Manager\Domain\Pm2Process;
use SERFF\Pm2Manager\Helpers\OutputHelper;

class GetProcessByNameAction
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function run(): ?Pm2Process
    {
        $processes = (new ListAction())->run();

        $name = OutputHelper::parseName($this->name);

        foreach ($processes as $process) {
            if ($process['name'] === $name) {
                return new Pm2Process($process);
            }
        }

        return null;
    }
}
