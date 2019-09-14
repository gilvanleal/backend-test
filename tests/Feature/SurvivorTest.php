<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Item;

class SuvivorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testList()
    {
        $response = $this->get('/api/survivors');
        $response->assertStatus(200);
    }

    public function testCreateHappy()
    {
        //$this->withoutExceptionHandling();
        $data = ["name" => "Gilvan Leal",
        "birth" => "1990-10-19",
        "gender" => "male",
        "latitude" => "10.123456",
        "longitude" => "20.654321",
        "recourses" => [
              ["item_id" => Item::where('name', 'Water')->value('id'),"amount" => "4"], 
              ["item_id" => Item::where('name', 'Ammunition')->value('id'),"amount" => "50"], 
            ]
        ];
        $response = $this->json('POST', '/api/survivors', $data);
        $response->assertStatus(201);

        // Ony recorces void
        $data["recourses"] = [];
        $response = $this->json('POST', '/api/survivors', $data);
        $response->dump();
        $response->assertStatus(201);
    }

    public function testCreateValidate()
    {
        // request blank data array
        $response = $this->json('POST', '/api/survivors', []);
        $response->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'birth', 'gender', 'latitude', 'longitude', 'recourses']);
        
        // Null values
        $s = [
            "name" => Null,
            "birth" => Null,
            "gender" => Null,
            "latitude" => Null,
            "longitude"=> Null,
            "recourses"=> Null
        ];
        $response = $this->json('POST', '/api/survivors', $s);
        
        $response->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'birth', 'gender', 'latitude', 'longitude', 'recourses']);

        // Ony recorces void
        $s = [
            "name" => "Gilvan Leal",
            "birth" => "1990-10-19",
            "gender" => "male",
            "latitude" => "10.123456",
            "longitude"=> "20.654321",
            "recourses"=> []
        ];
        $response = $this->json('POST', '/api/survivors', $s);
        $response->assertStatus(201);
        
        // Sem inventario
        $s = [
            "name" => "Gilvan Leal",
            "birth" => "1990-10-19",
            "gender" => "male",
            "latitude" => "10.123456",
            "longitude"=> "20.654321"
        ];
        $response = $this->json('POST', '/api/survivors', $s);
        $response->assertStatus(422)
        ->assertJsonValidationErrors(['recourses']);

        // Inventario infomação incompletas
        $s = [
            "name" => "Gilvan Leal",
            "birth" => "1990-10-19",
            "gender" => "male",
            "latitude" => "10.123456",
            "longitude"=> "20.654321",
            "recourses" => [
                ["item_id" => Null,"amount" => "4"], 
                ["item_id" => Item::where('name', 'Ammunition')->value('id')], 
              ]
          ];
        $response = $this->json('POST', '/api/survivors', $s);
        $response->dump();
        $response->assertStatus(422)
        ->assertJsonValidationErrors(['recourses.0.item_id', 'recourses.1.amount']);
    }
}
