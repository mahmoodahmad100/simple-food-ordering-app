<?php

namespace Core\Sale\Tests\Feature;

use Core\Base\Tests\ApiTestCase;
use Core\Sale\Models\Order as Model;
use Core\Inventory\Models\Product;
use Core\Inventory\Models\Ingredient;

class OrderTest extends ApiTestCase
{
    /**
     * setting up
     *
     * @throws \ReflectionException
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->base_url     = $this->getApiBaseUrl() . 'orders/';
        $this->model        = new Model();
        $this->data         = $this->model::factory()->make()->toArray();
        $this->json         = $this->getJsonStructure();
        $this->json['data'] = ['id'];

        foreach ($this->data as $key => $value) {
            $this->json['data'][] = $key;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function testItShouldStoreNewlyCreatedResource()
    {
        $product     = product::factory()->create();
        $ingredients = Ingredient::factory()->count(3)->create(['allow_alerting' => true]);
        $product->ingredients()->syncWithPivotValues($ingredients->pluck('id'), ['qty' => 3]);
        
        $this->data['products'] = [
            ['product_id' => $product->id, 'quantity' => 10]
        ];

        $this->json('POST', $this->base_url, $this->data, $this->getHeaders())
             ->assertStatus(201)
             ->assertJsonStructure($this->json);
    }
}
