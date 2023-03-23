<?php

namespace Core\Inventory\Controllers\API\V1;

use Core\Inventory\Requests\IngredientRequest as FormRequest;
use Core\Inventory\Models\Ingredient as Model;
use Core\Inventory\Resources\IngredientResource as Resource;

class IngredientController extends \Core\Base\Controllers\API\Controller
{
    /**
     * Init.
     * @param FormRequest $request
     * @param Model       $model
     * @param string      $resource
     */
    public function __construct(FormRequest $request, Model $model, $resource = Resource::class)
    {
        parent::__construct($request, $model, $resource);
    }
}
