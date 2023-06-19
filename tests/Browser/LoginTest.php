<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_cannot_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'eapdob@gmail.com',
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(2000)
                ->visit('/login')
                ->assertSee('Returning Customer')
                ->type('email', 'eapdob@gmail.com')
                ->type('password', 'wrong-password')
                ->press('Login')
                ->assertPathIs('/login')
                ->assertSee('credentials do not match');
        });
    }

    /** @test */
    public function a_user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'eapdob@gmail.com',
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(2000)
                ->visit('/login')
                ->assertSee('Returning Customer')
                ->type('email', 'eapdob@gmail.com')
                ->type('password', 'demo1234')
                ->press('Login')
                ->assertSee('Laravel');
        });
    }
}
