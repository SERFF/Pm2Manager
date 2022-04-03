<?php

namespace SERFF\Pm2Manager\Actions;

use SERFF\Pm2Manager\Domain\Pm2Process;

class GetProcessById
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function run(): ?Pm2Process
    {
        $processes = (new ListAction())->run();

        foreach ($processes as $process) {
            if ((int) $process['name'] === (int) $this->id) {
                return new Pm2Process($process);
            }
        }

        return null;
    }
}
