<?php
 
namespace Tests\Feature;
 
use Tests\TestCase;
 
class RouteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_route_path()
    {
        $response = $this->get('/path');
 
        $response->assertStatus(200);
    }
}