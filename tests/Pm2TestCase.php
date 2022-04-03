<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use SERFF\Pm2Manager\Pm2Manager;

abstract class Pm2TestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Pm2Manager::deleteAll();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        Pm2Manager::deleteAll();
    }
}
