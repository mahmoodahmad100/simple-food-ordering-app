<?php

namespace Core\Inventory\Database\Factories;

use Core\Inventory\Models\Ingredient as Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'           => $this->faker->text(10),
            'description'    => '',
            'qty'            => $this->faker->numberBetween(0, 100),
            'uom'            => $this->faker->randomElement(explode(',', config('core_inventory.uom'))),
            'allow_alerting' => $this->faker->boolean(),
        ];
    }
}
