<?php

namespace Core\Sale\Models;

use Core\Base\Models\Base;

class Order extends Base
{
    /**
     * get the items.
     */
    public function items()
    {
        return $this->hasMany(Item::class, 'order_id');
    }
}
