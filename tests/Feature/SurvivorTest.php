<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/api/survivors');
        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this->json(
            'POST', '/api/survivors',
            ["name"=> "Gilvan Leal",
            "birth"=> "1990-10-19",
            "gender" => "male",
            "latitude"=> "10.123456",
            "longitude"-> "20.654321",
            "recourses"=> [[
                "item_id"=> "1",
                "amount"=> "3"
            ]]
        );
        $response->assertStatus(200);
    }
}
