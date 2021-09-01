<?php

namespace Tests\Browser;

use App\Models\Agent;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AgentCreateTest extends DuskTestCase
{
    use DatabaseMigrations;

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * A Dusk test example.
     * @return void
     */
    public function testAccessToPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/agent/create')
                ->assertRouteIs('agent.create')
                ->assertSee('Matricule')
                ->assertSee('Nom')
                ->assertSee('Prenom');
        });
    }

    public function testCreateAgent()
    {
        $_agent = Agent::factory()->make()->toArray();

        $this->browse(function (Browser $browser) use ($_agent) {
            $browser->loginAs($this->user)
                ->visit('/agent/create')
                ->type('matricule', $_agent['matricule'])
                ->type('nom', $_agent['nom'])
                ->type('prenom', $_agent['prenom'])
                ->press('Valider');
        });

        $this->assertDatabaseHas('agents', $_agent);
    }
}
