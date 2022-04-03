<?php

namespace Tests;

use SERFF\Pm2Manager\Pm2Manager;

class Pm2ProcessTest extends Pm2TestCase
{
    /** @test */
    public function it_can_stop_a_process(): void
    {
        $process = Pm2Manager::add('ping google.com')->stop();

        $this->assertEquals('stopped', $process->status());
    }

    /** @test */
    public function it_can_start_a_stopped_process(): void
    {
        $process = Pm2Manager::add('ping google.com')->stop();

        $this->assertEquals('stopped', $process->status());

        $process = $process->start();

        $this->assertEquals('online', $process->status());
    }

    /** @test */
    public function it_can_restart_a_process(): void
    {
        $process = Pm2Manager::add('ping google.com');

        $this->assertEquals('online', $process->status());

        $this->assertEquals(0, $process->restarts());

        $process = $process->restart();

        $this->assertEquals(1, $process->restarts());
    }

    /** @test */
    public function it_can_delete_a_process(): void
    {
        $process = Pm2Manager::add('ping google.com');
        $process2 = Pm2Manager::add('ping bing.com');

        $this->assertCount(2, Pm2Manager::list());

        $this->assertTrue($process->delete());

        $this->assertCount(1, Pm2Manager::list());

        $this->assertTrue($process2->delete());

        $this->assertCount(0, Pm2Manager::list());
    }

    /** @test */
    public function it_can_log_a_process()
    {
        $process = Pm2Manager::add('ping google.com');

        $logs = $process->log();

        $this->assertNotEmpty($logs);
    }
}
