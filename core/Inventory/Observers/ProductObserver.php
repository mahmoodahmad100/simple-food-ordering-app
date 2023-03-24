<?php

namespace Core\Inventory\Observers;

use Core\Inventory\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "saved" event.
     *
     * @param  \Core\Inventory\Models\Product  $product
     * @return void
     */
    public function saved(Product $product)
    {
        if (request()->ingredients) {
            $all_ingredients = [];

            foreach (request()->ingredients as $ingredient) {
                $all_ingredients[$ingredient['id']] = ['qty' => $ingredient['qty']];
            }

            $product->ingredients()->sync($all_ingredients);
        }
    }
}