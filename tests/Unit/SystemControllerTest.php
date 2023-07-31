<?php

namespace Tests\Unit;

use App\Models\System;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class SystemControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_index_method_returns_valid_response()
    {
        $response = $this->get('/admin/systems');
        $response->assertStatus(200);
    }

    public function test_show_system_method_returns_valid_response()
    {
        $system = System::factory()->create();
        $response = $this->get('/admin/systems/' . $system->id);
        $response->assertStatus(200);
    }
    public function test_store_system_method_creates_new_system()
    {
        $systemData = System::factory()->make()->toArray();
        $response = $this->post('/admin/systems', $systemData);
        $this->assertDatabaseHas('systems', $systemData);
    }
    public function test_destroy_system_method_deletes_system()
    {
        $system = System::factory()->create();
        $response = $this->delete('/admin/systems/' . $system->id);
        $this->assertDatabaseMissing('systems', ['id' => $system->id]);
    }
}
