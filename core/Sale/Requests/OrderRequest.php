<?php

namespace Core\Sale\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'description'           => 'nullable',
                    'products'              => 'required|array',
                    'products.*.product_id' => 'required|integer',
                    'products.*.quantity'   => 'required|integer',
                ];
            }
            case 'PUT': {
                return [
                    'description'           => 'nullable',
                    'products'              => 'nullable|array',
                    'products.*.product_id' => 'required|integer',
                    'products.*.quantity'   => 'required|integer',
                ];
            }
        }
    }
}
