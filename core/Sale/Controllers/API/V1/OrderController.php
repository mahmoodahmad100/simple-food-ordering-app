<?php

namespace Core\Sale\Controllers\API\V1;

use Core\Sale\Requests\OrderRequest as FormRequest;
use Core\Sale\Models\Order as Model;
use Core\Sale\Resources\OrderResource as Resource;

class OrderController extends \Core\Base\Controllers\API\Controller
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
