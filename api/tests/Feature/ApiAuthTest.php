<?php
namespace Tests\Feature;

use Tests\TestCase;

class ApiAuthTest extends TestCase
{
    public function test_health_is_public(): void
    {
        $response = $this->getJson('/api/health');
        $response->assertStatus(200)
            ->assertJson(['status' => 'ok']);
    }

    public function test_customers_requires_token(): void
    {
        $response = $this->getJson('/api/customers');
        $response->assertStatus(401);
    }

    public function test_customers_with_bearer_token(): void
    {
        $response = $this->withHeader('Authorization', 'Bearer rt-rw-net-secret-2026')
            ->getJson('/api/customers');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'current_page', 'data', 'links'
            ]);
    }

    public function test_customers_with_token(): void
    {
        $response = $this->withHeader('X-API-Token', 'rt-rw-net-secret-2026')
            ->getJson('/api/customers');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'current_page', 'data', 'links'
            ]);
    }
}
