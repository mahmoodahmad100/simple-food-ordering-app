<?php

Route::namespace('Core\Inventory\Controllers\Web')->prefix('admin')->name('admin.')->group(function () {
    #*** Ex: START: Inventory ***#
    // Route::resource('inventories', 'InventoryController')->except([
    //    'store', 'update', 'destroy'
    // ]);
    #*** END: Inventory ***#
});
