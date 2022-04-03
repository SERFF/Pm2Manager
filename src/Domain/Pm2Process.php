<?php

namespace SERFF\Pm2Manager\Domain;

use SERFF\Pm2Manager\Actions\DeleteProcessAction;
use SERFF\Pm2Manager\Actions\GetProcessLogAction;
use SERFF\Pm2Manager\Actions\RestartProcessAction;
use SERFF\Pm2Manager\Actions\StartProcessAction;
use SERFF\Pm2Manager\Actions\StopAction;

class Pm2Process
{
    private $id = null;
    private $name = null;
    private $namespace = null;
    private $version = null;
    private $mode = null;
    private $pid = null;
    private $uptime = null;
    private $restarts = null;
    private $status = null;
    private $cpu = null;
    private $mem = null;
    private $user = null;
    private $watching = null;

    public function __construct($args)
    {
        foreach ($args as $key => $value) {
            $this->$key = $value;
        }
    }

    public function __call($name, $arguments)
    {
        return $this->$name;
    }

    public function start()
    {
        return (new StartProcessAction($this))->run();
    }

    public function stop()
    {
        return (new StopAction($this))->run();
    }

    public function delete()
    {
        (new DeleteProcessAction($this))->run();

        return true;
    }

    public function log()
    {
        return (new GetProcessLogAction($this))->run();
    }

    public function restart()
    {
        return (new RestartProcessAction($this))->run();
    }
}
