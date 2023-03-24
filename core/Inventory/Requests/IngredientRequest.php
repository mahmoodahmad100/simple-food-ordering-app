<?php

namespace Core\Inventory\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngredientRequest extends FormRequest
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
                    'name'           => 'string|required',
                    'description'    => 'nullable',
                    'qty'            => 'numeric|required',
                    'uom'            => "string|required|in:{$uom}",
                    'allow_alerting' => 'required|boolean',
                ];
            }
            case 'PUT': {
                return [
                    'name'           => 'string|nullable',
                    'description'    => 'nullable',
                    'qty'            => 'numeric|nullable',
                    'uom'            => "string|nullable|in:{$uom}",
                    'allow_alerting' => 'nullable|boolean',
                ];
            }
        }
    }
}
