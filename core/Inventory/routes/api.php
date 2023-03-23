<?php

Route::group(['prefix' => 'api', 'middleware' => ['api']], function () {
    # V1
    Route::namespace('Core\Inventory\Controllers\API\V1')->prefix('v1')->name('api.v1.')->group(function () {
        Route::apiResource('products', 'ProductController');
        Route::apiResource('ingredients', 'IngredientController');
    });
});
