<?php

namespace Core\Sale\Models;

use Core\Base\Models\Base;

class Item extends Base
{
    /**
     * get the order.
     */
    public function order()
    {
        return $this->belongsTo(Item::class, 'order_id');
    }

    /**
     * get the product.
     */
    public function product()
    {
        return $this->belongsTo(\Core\Inventory\Models\Product::class, 'product_id');
    }
}
