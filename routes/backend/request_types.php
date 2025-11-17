<?php

use App\Http\Controllers\Backend\RequestTypeController;

use App\Models\RequestType;

Route::bind('request_type', function ($value) {
	$request_type = new RequestType;

	return RequestType::withTrashed()->where($request_type->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'request_types'], function () {
	Route::get(	'', 		[RequestTypeController::class, 'index']		)->name('request_types.index');
    Route::get(	'create', 	[RequestTypeController::class, 'create']	)->name('request_types.create');
	Route::post('store', 	[RequestTypeController::class, 'store']		)->name('request_types.store');
    Route::get(	'deleted', 	[RequestTypeController::class, 'deleted']	)->name('request_types.deleted');
});

Route::group(['prefix' => 'request_types/{request_type}'], function () {
	// RequestType
	Route::get('/', [RequestTypeController::class, 'show'])->name('request_types.show');
	Route::get('edit', [RequestTypeController::class, 'edit'])->name('request_types.edit');
	Route::patch('update', [RequestTypeController::class, 'update'])->name('request_types.update');
	Route::delete('destroy', [RequestTypeController::class, 'destroy'])->name('request_types.destroy');
	// Deleted
	Route::get('restore', [RequestTypeController::class, 'restore'])->name('request_types.restore');
	Route::get('delete', [RequestTypeController::class, 'delete'])->name('request_types.delete-permanently');
});