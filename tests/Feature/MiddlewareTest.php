<?php

namespace Tests\Feature;

use App\Models\admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin middleware allows admin role.
     */
    public function test_isadmin_middleware_allows_admin_role()
    {
        $admin = Admin::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin, 'admin')->get('/admin/dashboard');
        $response->assertStatus(200);
    }

    /**
     * Test admin middleware denies ticket role.
     */
    public function test_isadmin_middleware_denies_ticket_role()
    {
        $ticket = Admin::factory()->create(['role' => 'tiket']);

        $response = $this->actingAs($ticket, 'admin')->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    /**
     * Test admin middleware denies unauthenticated.
     */
    public function test_isadmin_middleware_denies_unauthenticated()
    {
        $response = $this->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    /**
     * Test ticket middleware allows ticket role.
     */
    public function test_isticket_middleware_allows_ticket_role()
    {
        $ticket = admin::factory()->create(['role' => 'tiket']);

        $response = $this->actingAs($ticket, 'admin')->get('/admin/tiketing/penonton');
        $response->assertStatus(200);
    }

    /**
     * Test ticket middleware denies admin role.
     */
    public function test_isticket_middleware_denies_admin_role()
    {
        $admin = admin::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin, 'admin')->get('/admin/tiketing/penonton');
        $response->assertStatus(403);
    }

    /**
     * Test ticket middleware denies unauthenticated.
     */
    public function test_isticket_middleware_denies_unauthenticated()
    {
        $response = $this->get('/admin/tiketing/penonton');
        $response->assertStatus(403);
    }

    /**
     * Test dashboard routes are protected by isadmin.
     */
    public function test_dashboard_routes_protected_by_isadmin()
    {
        $admin = admin::factory()->create(['role' => 'admin']);
        $ticket = admin::factory()->create(['role' => 'tiket']);

        // Admin can access
        $response = $this->actingAs($admin, 'admin')->get('/admin/dashboard/acara');
        $response->assertStatus(200);

        // Ticket cannot access
        $response = $this->actingAs($ticket, 'admin')->get('/admin/dashboard/acara');
        $response->assertStatus(403);
    }

    /**
     * Test tiketing routes are protected by isticket.
     */
    public function test_tiketing_routes_protected_by_isticket()
    {
        $admin = admin::factory()->create(['role' => 'admin']);
        $ticket = admin::factory()->create(['role' => 'tiket']);

        // Ticket can access
        $response = $this->actingAs($ticket, 'admin')->get('/admin/tiketing/penonton');
        $response->assertStatus(200);

        // Admin cannot access
        $response = $this->actingAs($admin, 'admin')->get('/admin/tiketing/penonton');
        $response->assertStatus(403);
    }
}
