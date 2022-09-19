<?php

namespace Tests\Feature;

use Tests\TestCase;

class CityOnlyGroupCitiesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_city_only_group_cities()
    {
        $cities = [];

        $responseCity = $this->postJson(env('APP_URL', 'http://localhost:8003') . '/api/cities',
            [
                'name' => 'São Paulo',
            ],
        );
        $responseCity->assertStatus(201);
        $cities[] = $responseCity->json('data')['id'];

        $responseCity = $this->postJson(env('APP_URL', 'http://localhost:8003') . '/api/cities',
            [
                'name' => 'Rio de Janeiro',
            ],
        );
        $responseCity->assertStatus(201);
        $cities[] = $responseCity->json('data')['id'];

        $responseCity = $this->postJson(env('APP_URL', 'http://localhost:8003') . '/api/cities',
            [
                'name' => 'Curitiba',
            ],
        );
        $responseCity->assertStatus(201);
        $cities[] = $responseCity->json('data')['id'];


        $responseGroupCities = $this->postJson(env('APP_URL', 'http://localhost:8003') . '/api/group_cities',
            [
                'name' => 'Grupo de cidades 1',
                'description' => 'Descrição do grupo',
                'cities' => $cities
            ],
        );
        $responseGroupCities->assertStatus(201);
        $groupCitiesID = $responseGroupCities->json('data')['id'];

        $responseCity1 = $this->get(env('APP_URL', 'http://localhost:8003') . '/api/cities/' . $cities[0]);
        $responseCity1->assertStatus(200);
        $responseCity1->assertJsonPath('data.group_city.id', $groupCitiesID);

        $responseGroupCities = $this->postJson(env('APP_URL', 'http://localhost:8003') . '/api/group_cities',
            [
                'name' => 'Grupo de cidades 2',
                'description' => 'Descrição do grupo 2',
                'cities' => [$cities[0]]
            ],
        );
        $responseGroupCities->assertStatus(201);
        $groupCitiesID = $responseGroupCities->json('data')['id'];

        $responseCity2 = $this->get(env('APP_URL', 'http://localhost:8003') . '/api/cities/' . $cities[0]);
        $responseCity2->assertStatus(200);
        $responseCity2->assertJsonPath('data.group_city.id', $groupCitiesID);
    }
}
