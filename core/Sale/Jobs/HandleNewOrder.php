<?php

namespace Core\Sale\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Core\Sale\Models\Order;

class HandleNewOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * order
     * 
     * @var Order
     */
    protected $order;

    /**
     * Create a new job instance.
     *
     * @param  Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->order->items as $item) {
            foreach ($item->product->ingredients as $ingredient) {
                $current_qty = uom_converter($ingredient->pivot->uom, $ingredient->uom, $ingredient->pivot->qty);
                $ingredient->update(['qty' => $ingredient->qty - $current_qty * $item->qty]);
            }
        }
    }
}