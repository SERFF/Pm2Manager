<?php

namespace SERFF\Pm2Manager;

use SERFF\Pm2Manager\Actions\DeleteAllAction;
use SERFF\Pm2Manager\Actions\ListAction;
use SERFF\Pm2Manager\Actions\StartAction;
use SERFF\Pm2Manager\Domain\Pm2Process;
use SERFF\Pm2Manager\Helpers\OutputHelper;

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
        $processes = self::list();

        $name = OutputHelper::parseName($name);

        foreach ($processes as $process) {
            if ($process['name'] === $name) {
                return new Pm2Process($process);
            }
        }

        return null;
    }

    public static function restartAll()
    {

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

}
