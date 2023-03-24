<?php

namespace Core\Inventory\Tests\Feature;

use Core\Base\Tests\ApiTestCase;
use Core\Inventory\Models\Product as Model;
use Core\Inventory\Models\Ingredient;

class ProductTest extends ApiTestCase
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

        $this->base_url            = $this->getApiBaseUrl() . 'products/';
        $this->model               = new Model();
        $this->data                = $this->model::factory()->make()->toArray();
        $this->data['ingredients'] = $this->handleIngredients();
        $this->json                = $this->getJsonStructure();
        $this->json['data']        = ['id'];

        foreach ($this->data as $key => $value) {
            if ($key == 'ingredients') {
                continue;
            }

            $this->json['data'][] = $key;
        }
    }

    /**
     * handle ingredients data
     * 
     * @return array
     */
    protected function handleIngredients()
    {
        $data = [];

        $ingredients = Ingredient::factory()->count(5)->create();

        foreach ($ingredients as $ingredient) {
            $data[] = [
                'id'  => $ingredient->id,
                'qty' => random_int(1, 200),
            ];
        }

        return $data;
    }
}
