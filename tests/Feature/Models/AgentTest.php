<?php

namespace Tests\Feature\Models;

use App\Models\Agent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AgentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_factory()
    {
        Agent::factory()->count(50)->create();
        $this->assertDatabaseCount('agents', 50);
    }
}
