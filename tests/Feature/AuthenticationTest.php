<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_from_obat_index(): void
    {
        $this->get(route('obat.index'))
            ->assertRedirect(route('login'));
    }

    public function test_admin_can_login_with_username_and_password(): void
    {
        $admin = User::factory()->create([
            'username' => 'admin1',
            'is_admin' => true,
            'password' => 'admin1',
        ]);

        $this->post(route('login.store'), [
            'username' => 'admin1',
            'password' => 'admin1',
        ])->assertRedirect(route('obat.index'));

        $this->assertAuthenticatedAs($admin);
    }

    public function test_invalid_password_does_not_authenticate(): void
    {
        User::factory()->create([
            'username' => 'admin1',
            'is_admin' => true,
            'password' => 'admin1',
        ]);

        $this->from(route('login'))
            ->post(route('login.store'), [
                'username' => 'admin1',
                'password' => 'wrong-password',
            ])
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors('username');

        $this->assertGuest();
    }

    public function test_non_admin_is_forbidden_from_managing_obat(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)
            ->get(route('obat.index'))
            ->assertForbidden();
    }

    public function test_admin_is_authorized_for_every_gate_ability(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->assertTrue($admin->can('manage-users'));
    }

    public function test_logout_ends_the_admin_session(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->post(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }
}
