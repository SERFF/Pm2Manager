<?php

namespace SERFF\Pm2Manager;

use SERFF\Pm2Manager\Actions\DeleteAllAction;
use SERFF\Pm2Manager\Actions\GetProcessByNameAction;
use SERFF\Pm2Manager\Actions\ListAction;
use SERFF\Pm2Manager\Actions\PersistAllAction;
use SERFF\Pm2Manager\Actions\RestartAllAction;
use SERFF\Pm2Manager\Actions\StartAction;
use SERFF\Pm2Manager\Domain\Pm2Process;

class Pm2Manager
{
    public static function list(): array
    {
        return (new ListAction())->run();
    }

    public static function add($command): Pm2Process
    {
        return (new StartAction($command))->run();
    }

    public static function getProcessByName($name): ?Pm2Process
    {
        return (new GetProcessByNameAction($name))->run();
    }

    public static function deleteAll()
    {
        try {
            (new DeleteAllAction())->run();

            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    public static function restartAll()
    {
        try {
            (new RestartAllAction())->run();

            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    public static function persist()
    {
        return (new PersistAllAction())->run();
    }
}
