<?php

namespace Core\Inventory\Controllers\API\V1;

use Core\Inventory\Requests\ProductRequest as FormRequest;
use Core\Inventory\Models\Product as Model;
use Core\Inventory\Resources\ProductResource as Resource;

class ProductController extends \Core\Base\Controllers\API\Controller
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
