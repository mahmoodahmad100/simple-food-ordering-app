<?php

namespace Core\Inventory\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Core\Inventory\Models\Ingredient;
use Core\Inventory\Models\Product;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = Ingredient::factory()->createMany([
            ['name' => 'Beef', 'qty' => 20.00, 'uom' => 'kg', 'allow_alerting' => true],
            ['name' => 'Cheese', 'qty' => 5.00, 'uom' => 'kg', 'allow_alerting' => true],
            ['name' => 'Onion', 'qty' => 1.00, 'uom' => 'kg', 'allow_alerting' => true]
        ]);
        
        // custom product
        $burger = Product::factory()->create(['name' => 'Burger']);
        $burger->ingredients()->sync([
            $ingredients[0]->id => ['qty' => 150],
            $ingredients[1]->id => ['qty' => 30],
            $ingredients[2]->id => ['qty' => 20]
        ]);

        // random products
        $products = Product::factory()->count(10)->create();

        foreach ($products as $product) {
            $product->ingredients()->sync([$ingredients[random_int(0, 2)]->id => ['qty' => random_int(1, 200)]]);
        }
    }
}