<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the admin login page loads successfully.
     */
    public function test_login_page_loads()
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Admin Login');
    }

    /**
     * Test login fails with invalid credentials.
     */
    public function test_login_fails_with_invalid_credentials()
    {
        $response = $this->post('/admin/login', [
            'email' => 'wrong@example.com',
            'password' => 'wrongpass',
        ]);
        $response->assertSessionHasErrors('email');
    }

    /**
     * Test login succeeds for admin role and redirects to dashboard.
     */
    public function test_login_succeeds_for_admin_role()
    {
        $admin = Admin::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($admin, 'admin');
    }

    /**
     * Test login succeeds for ticket role and redirects to tiketing.
     */
    public function test_login_succeeds_for_ticket_role()
    {
        $ticket = Admin::factory()->create([
            'email' => 'ticket@example.com',
            'password' => bcrypt('password'),
            'role' => 'tiket',
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'ticket@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin/tiketing');
        $this->assertAuthenticatedAs($ticket, 'admin');
    }

    /**
     * Test login fails for unknown role.
     */
    public function test_login_fails_for_unknown_role()
    {
        $unknown = Admin::factory()->create([
            'email' => 'unknown@example.com',
            'password' => bcrypt('password'),
            'role' => 'unknown',
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'unknown@example.com',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest('admin');
    }

    /**
     * Test showLoginForm redirects if already authenticated.
     */
    public function test_show_login_form_redirects_if_authenticated()
    {
        $admin = Admin::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin, 'admin')->get('/admin/login');
        $response->assertRedirect('/admin/dashboard');
    }
}
