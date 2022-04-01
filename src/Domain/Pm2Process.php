<?php

namespace SERFF\Pm2Manager\Domain;

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

    public function stop()
    {

    }

    public function delete()
    {

    }

    public function log()
    {

    }

    public function restart()
    {

    }
}
