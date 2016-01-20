<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AppTest extends TestCase
{
    /**
     * Test that the application is a password protected.
     *
     * @return void
     */
    public function testAccess()
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(302, $response->status());
        $this->assertRedirectedTo('login');
        $response = $this->call('GET', '/login');
        $this->assertEquals(200, $response->status());
    }

    /**
     * Test that the Dashboard is accessible for logged in user
     */
    public function testDashboard()
    {
        $user = factory(App\User::class)->make();

        $this->actingAs($user)
            ->visit('/')
            ->see('Dashboard');
    }
}
