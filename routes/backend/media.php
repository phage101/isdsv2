<?php

use App\Http\Controllers\Backend\MediumController;

use App\Models\Medium;

Route::bind('medium', function ($value) {
	$medium = new Medium;

	return Medium::withTrashed()->where($medium->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'media'], function () {
	Route::get(	'', 		[MediumController::class, 'index']		)->name('media.index');
    Route::get(	'create', 	[MediumController::class, 'create']	)->name('media.create');
	Route::post('store', 	[MediumController::class, 'store']		)->name('media.store');
    Route::get(	'deleted', 	[MediumController::class, 'deleted']	)->name('media.deleted');
});

Route::group(['prefix' => 'media/{medium}'], function () {
	// Medium
	Route::get('/', [MediumController::class, 'show'])->name('media.show');
	Route::get('edit', [MediumController::class, 'edit'])->name('media.edit');
	Route::patch('update', [MediumController::class, 'update'])->name('media.update');
	Route::delete('destroy', [MediumController::class, 'destroy'])->name('media.destroy');
	// Deleted
	Route::get('restore', [MediumController::class, 'restore'])->name('media.restore');
	Route::get('delete', [MediumController::class, 'delete'])->name('media.delete-permanently');
});