<?php

namespace Core\Inventory\Models;

use Core\Base\Models\Base;

class Product extends Base
{
    /**
     * get the ingredients.
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
}
