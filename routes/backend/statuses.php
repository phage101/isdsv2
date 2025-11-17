<?php

use App\Http\Controllers\Backend\StatusController;

use App\Models\Status;

Route::bind('status', function ($value) {
	$status = new Status;

	return Status::withTrashed()->where($status->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'statuses'], function () {
	Route::get(	'', 		[StatusController::class, 'index']		)->name('statuses.index');
    Route::get(	'create', 	[StatusController::class, 'create']	)->name('statuses.create');
	Route::post('store', 	[StatusController::class, 'store']		)->name('statuses.store');
    Route::get(	'deleted', 	[StatusController::class, 'deleted']	)->name('statuses.deleted');
});

Route::group(['prefix' => 'statuses/{status}'], function () {
	// Status
	Route::get('/', [StatusController::class, 'show'])->name('statuses.show');
	Route::get('edit', [StatusController::class, 'edit'])->name('statuses.edit');
	Route::patch('update', [StatusController::class, 'update'])->name('statuses.update');
	Route::delete('destroy', [StatusController::class, 'destroy'])->name('statuses.destroy');
	// Deleted
	Route::get('restore', [StatusController::class, 'restore'])->name('statuses.restore');
	Route::get('delete', [StatusController::class, 'delete'])->name('statuses.delete-permanently');
});