<?php

namespace Core\Sale\Resources;

use Illuminate\Http\Resources\Json\JsonResource as Resource;
use Core\Inventory\Resources\ProductResource;

class ItemResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'order_id'   => $this->order_id,
            'product_id' => $this->product_id,
            'qty'        => $this->qty,
            $this->mergeWhen($request->route()->getName() == 'api.v1.items.show', [
                'order'   => new OrderResource($this->order),
                'product' => new ProductResource($this->product),
            ])
        ];
    }
}
