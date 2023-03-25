<?php

namespace Core\Sale\Observers;

use Core\Sale\Models\Order;
use Core\Sale\Jobs\HandleNewOrder;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \Core\Sale\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        if ($this->routeName() == 'api.v1.orders.store') {
            $items = [];

            foreach (request()->products as $product) {
                $items[] = [
                    'product_id' => $product['product_id'],
                    'qty'        => $product['quantity'],
                ];
            }
    
            $order->items()->createMany($items);
            
            HandleNewOrder::dispatch($order);
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