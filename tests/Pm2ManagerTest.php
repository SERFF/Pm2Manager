<?php

use PHPUnit\Framework\TestCase;
use SERFF\Pm2Manager\Pm2Manager;

class Pm2ManagerTest extends TestCase
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

    /** @test */
    public function it_can_run_list_actions()
    {
        $this->assertCount(0, Pm2Manager::list());
    }

    /** @test */
    public function it_can_add_an_action()
    {
        $process = Pm2Manager::add('ping google.com');

        $this->assertEquals('ping google', $process->name());
    }

    /** @test */
    public function it_returns_a_process_by_name()
    {
        Pm2Manager::add('ping google.com');
        $process = Pm2Manager::getProcessByName('ping google.com');

        $this->assertNotNull($process);
        $this->assertEquals('ping google', $process->name());
    }

    /** @test */
    public function it_deletes_all_items()
    {
        Pm2Manager::add('ping google.com');
        $this->assertCount(1, Pm2Manager::list());

        Pm2Manager::deleteAll();
        $this->assertCount(0, Pm2Manager::list());
    }
}
