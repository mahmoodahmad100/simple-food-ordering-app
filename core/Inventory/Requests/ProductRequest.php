<?php

namespace Core\Inventory\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $uom = config('core_inventory.uom');

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name'              => 'string|required',
                    'description'       => 'nullable',
                    'ingredients'       => 'required|array',
                    'ingredients.*.id'  => 'required|integer',
                    'ingredients.*.qty' => 'numeric|required',
                    'ingredients.*.uom' => "string|nullable|in:{$uom}",
                ];
            }
            case 'PUT': {
                return [
                    'name'              => 'string|nullable',
                    'description'       => 'nullable',
                    'ingredients'       => 'nullable|array',
                    'ingredients.*.id'  => 'required|integer',
                    'ingredients.*.qty' => 'numeric|required',
                    'ingredients.*.uom' => "string|nullable|in:{$uom}",
                ];
            }
        }
    }
}
