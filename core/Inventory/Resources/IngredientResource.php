<?php

namespace Core\Inventory\Resources;

use Illuminate\Http\Resources\Json\JsonResource as Resource;

class IngredientResource extends Resource
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
            'id'             => $this->id,
            'name'           => $this->name,
            'description'    => $this->description,
            'qty'            => $this->qty,
            'uom'            => $this->uom,
            'allow_alerting' => $this->allow_alerting,
            $this->mergeWhen($request->route()->getName() == 'api.v1.ingredients.show', [

            ])
        ];
    }
}
