<?php

namespace Helpers;

use SERFF\Pm2Manager\Helpers\OutputHelper;
use PHPUnit\Framework\TestCase;

class OutputHelperTest extends TestCase
{
    /** @test */
    public function it_parses_the_output()
    {
        $output = "┌─────┬────────┬─────────────┬─────────┬─────────┬──────────┬────────┬──────┬───────────┬──────────┬──────────┬──────────┬──────────┐
│ id  │ name   │ namespace   │ version │ mode    │ pid      │ uptime │ ↺    │ status    │ cpu      │ mem      │ user     │ watching │
├─────┼────────┼─────────────┼─────────┼─────────┼──────────┼────────┼──────┼───────────┼──────────┼──────────┼──────────┼──────────┤
│ 0   │ top    │ default     │ N/A     │ fork    │ 69394    │ 7m     │ 2    │ online    │ 0%       │ 8.3mb    │ testuser │ disabled │
└─────┴────────┴─────────────┴─────────┴─────────┴──────────┴────────┴──────┴───────────┴──────────┴──────────┴──────────┴──────────┘
";
        $parsedOutput = OutputHelper::parse($output);
        $this->assertCount(1, $parsedOutput);
        $this->assertEquals(0, $parsedOutput[0]['id']);
        $this->assertEquals('top', $parsedOutput[0]['name']);
        $this->assertEquals('default', $parsedOutput[0]['namespace']);
        $this->assertEquals('N/A', $parsedOutput[0]['version']);
        $this->assertEquals('fork', $parsedOutput[0]['mode']);
        $this->assertEquals('69394', $parsedOutput[0]['pid']);
        $this->assertEquals('7m', $parsedOutput[0]['uptime']);
        $this->assertEquals('2', $parsedOutput[0]['restarts']);
        $this->assertEquals('online', $parsedOutput[0]['status']);
        $this->assertEquals('0%', $parsedOutput[0]['cpu']);
        $this->assertEquals('8.3mb', $parsedOutput[0]['mem']);
        $this->assertEquals('testuser', $parsedOutput[0]['user']);
        $this->assertEquals('disabled', $parsedOutput[0]['watching']);
    }

    /** @test */
    public function it_parses_the_name_correct()
    {
        $this->assertEquals('ping google', OutputHelper::parseName('ping google.com'));
    }
}
