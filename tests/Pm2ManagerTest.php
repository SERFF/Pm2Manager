<?php

namespace Tests;

use SERFF\Pm2Manager\Pm2Manager;

class Pm2ManagerTest extends Pm2TestCase
{
    /** @test */
    public function it_can_run_list_actions(): void
    {
        $this->assertCount(0, Pm2Manager::list());
    }

    /** @test */
    public function it_can_add_an_action(): void
    {
        $process = Pm2Manager::add('ping google.com');

        $this->assertEquals('ping google', $process->name());
    }

    /** @test */
    public function it_returns_a_process_by_name(): void
    {
        Pm2Manager::add('ping google.com');
        $process = Pm2Manager::getProcessByName('ping google.com');

        $this->assertNotNull($process);
        $this->assertEquals('ping google', $process->name());
    }

    /** @test */
    public function it_deletes_all_processes(): void
    {
        Pm2Manager::add('ping google.com');
        Pm2Manager::add('ping bing.com');
        $this->assertCount(2, Pm2Manager::list());

        Pm2Manager::deleteAll();
        $this->assertCount(0, Pm2Manager::list());
    }

    /** @test */
    public function it_can_restart_all_processes()
    {
        $process = Pm2Manager::add('ping google.com');
        $process2 = Pm2Manager::add('ping bing.com');

        $this->assertEquals(0, $process->restarts());
        $this->assertEquals(0, $process2->restarts());

        Pm2Manager::restartAll();

        $processes = Pm2Manager::list();

        $this->assertCount(2, $processes);

        foreach ($processes as $processData) {
            $process = Pm2Manager::getProcessByName($processData['name']);
            $this->assertEquals(1, $process->restarts());
        }
    }

    /** @test */
    public function it_can_persist_all_actions(): void
    {
        Pm2Manager::add('ping google.com');

        $processes = Pm2Manager::list();

        $this->assertCount(1, $processes);

        Pm2Manager::persist();

        $processes = Pm2Manager::list();

        $this->assertCount(1, $processes);
    }
}
