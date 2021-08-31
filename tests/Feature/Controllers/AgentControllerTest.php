<?php

namespace Tests\Feature\Controllers;

use App\Models\Agent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function Symfony\Component\Translation\t;

class AgentControllerTest extends TestCase
{
    use WithFaker;

    /** @var User */
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_page()
    {
        $response = $this
            ->actingAs($this->user)
            ->get('/agent');

        $response->assertStatus(200);
    }

    public function test_create_page()
    {
        $response = $this
            ->actingAs($this->user)
            ->get('/agent/create');

        $response->assertStatus(200);
    }

    public function test_store_agent()
    {
        $_agent = Agent::factory()->makeOne()->toArray();

        $response = $this
            ->actingAs($this->user)
            ->post('/agent', $_agent);

        $response->assertRedirect(route('agent.index'));
        $this->assertDatabaseCount('agents', 1);
    }

    public function test_edit_page()
    {
        $_agent = Agent::factory()->create();

        $response = $this
            ->actingAs($this->user)
            ->get("/agent/$_agent->id/edit");

        $response->assertStatus(200);
    }

    public function test_update_agent()
    {
        $_agent = Agent::factory()->create();

        $_mat = $this->faker->numberBetween(1, 9000000);
        $_nom = $this->faker->lastName;
        $_prenom = $this->faker->firstName;

        $response = $this
            ->actingAs($this->user)
            ->put("/agent/$_agent->id", [
                'matricule' => $_mat,
                'nom' => $_nom,
                'prenom' => $_prenom
            ]);

        $response->assertRedirect(route('agent.index'));
        $this->assertDatabaseCount('agents', 1);
        $this->assertDatabaseHas('agents',[
            'id' => $_agent->id,
            'matricule' => $_mat,
            'nom' => $_nom,
            'prenom' => $_prenom
        ]);
    }
}
