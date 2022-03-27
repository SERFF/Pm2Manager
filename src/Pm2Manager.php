<?php

namespace SERFF\Pm2Manager;

use SERFF\Pm2Manager\Actions\ListAction;
use SERFF\Pm2Manager\Actions\StartAction;
use SERFF\Pm2Manager\Domain\Pm2Process;

class Pm2Manager
{
    public static function list(): array
    {
        $list = (new ListAction())->run();
    }

    public static function add($command): Pm2Process
    {
        $start = (new StartAction($command))->run();
    }

    public function getProcessByName($name)
    {

    }

    public function stop(Pm2Process $process)
    {

    }

    public function delete(Pm2Process $process)
    {

    }

    public function log(Pm2Process $process)
    {

    }

    public function restart(Pm2Process $process)
    {

    }

    public function restartAll()
    {

    }
}
