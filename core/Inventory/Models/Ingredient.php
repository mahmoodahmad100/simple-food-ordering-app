<?php

namespace Core\Inventory\Models;

use Core\Base\Models\Base;

class Ingredient extends Base
{
    /**
     * get the products.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('qty', 'uom');
    }
}
