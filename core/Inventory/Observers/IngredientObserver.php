<?php

namespace Core\Inventory\Observers;

use Core\Inventory\Models\Ingredient;
use Illuminate\Support\Facades\Mail;
use Core\Inventory\Mail\ShortageIngredient;

class IngredientObserver
{
    /**
     * Handle the Ingredient "saving" event.
     *
     * @param  \Core\Inventory\Models\Ingredient  $ingredient
     * @return void
     */
    public function saving(Ingredient $ingredient)
    {
        /**
         * to make sure that when the user is updating the quantity or creating a new ingredient,
         * original quantity is updated accordingly.
         */
        $routes = ['api.v1.ingredients.store', 'api.v1.ingredients.update'];

        if (in_array($this->routeName(), $routes) || !$ingredient->original_qty) {
            $ingredient->original_qty = $ingredient->qty;
        }
    }

    /**
     * Handle the Ingredient "updated" event.
     *
     * @param  \Core\Inventory\Models\Ingredient  $ingredient
     * @return void
     */
    public function updated(Ingredient $ingredient)
    {
        if ($this->routeName() == 'api.v1.ingredients.update' && $ingredient->wasChanged(['qty', 'uom'])) {
            $ingredient->allow_alerting = true;
            $ingredient->saveQuietly();
        }

        $ingredient_alert = config('core_inventory.alerting.ingredient');

        if($ingredient->allow_alerting && $ingredient->qty < $ingredient->original_qty) {
            $consumed_quantity = $ingredient->original_qty - $ingredient->qty;
            $threshold = $ingredient_alert['type'] == 'percentage' ? 
                         ($ingredient->original_qty * $ingredient_alert['threshold']) / 100 :
                         $ingredient_alert['threshold'];

            if ($consumed_quantity > $threshold) {
                Mail::to(env('MERCHANT_EMAIL'))->send(new ShortageIngredient($ingredient));
                $ingredient->allow_alerting = false;
                $ingredient->saveQuietly();
            }
        }
    }

    /**
     * Get the current route name.
     *
     * @return string
     */
    protected function routeName()
    {
        return request()->route() ? request()->route()->getName() : '';
    }
}