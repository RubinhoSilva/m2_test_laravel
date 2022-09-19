<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupCitiesOnlyCampaignActiveTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_group_cities_only_campaign_active()
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

        $responseProduct = $this->postJson(env('APP_URL', 'http://localhost:8003') . '/api/products',
            [
                'name' => 'Produto 1',
                'price' => 100
            ],
        );
        $responseProduct->assertStatus(201);
        $productID = $responseProduct->json('data')['id'];

        $responseCampaign = $this->postJson(env('APP_URL', 'http://localhost:8003') . '/api/campaigns',
            [
                'active' => 1,
                'group_cities_id' => $groupCitiesID,
                'products' => [
                    [
                        'product_id' => $productID,
                        'discount' => 10
                    ]
                ]
            ],
        );
        $responseCampaign->assertStatus(201);
        $campaignID = $responseCampaign->json('data')['id'];

        $responseCampaign = $this->postJson(env('APP_URL', 'http://localhost:8003') . '/api/campaigns',
            [
                'active' => 1,
                'group_cities_id' => $groupCitiesID,
                'products' => [
                    [
                        'product_id' => $productID,
                        'discount' => 10
                    ]
                ]
            ],
        );
        $responseCampaign->assertStatus(400);
        $responseCampaign->assertJsonPath('data.message', 'There is already an active campaign for this group of cities!');


        //REMOVER TUDO QUE CRIEI
        foreach ($cities as $city){
            $response = $this->delete(env('APP_URL', 'http://localhost:8003') . '/api/cities/' . $city);
            $response->assertStatus(200);
        }

        $response = $this->delete(env('APP_URL', 'http://localhost:8003') . '/api/group_cities/' . $groupCitiesID);
        $response->assertStatus(200);


        $response = $this->delete(env('APP_URL', 'http://localhost:8003') . '/api/products/' . $productID);
        $response->assertStatus(200);

        $response = $this->delete(env('APP_URL', 'http://localhost:8003') . '/api/campaigns/' . $campaignID);
        $response->assertStatus(200);

    }
}
