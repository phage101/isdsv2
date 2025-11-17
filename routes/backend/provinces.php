<?php

use App\Http\Controllers\Backend\ProvinceController;

use App\Models\Province;

Route::bind('province', function ($value) {
	$province = new Province;

	return Province::withTrashed()->where($province->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'provinces'], function () {
	Route::get(	'', 		[ProvinceController::class, 'index']		)->name('provinces.index');
    Route::get(	'create', 	[ProvinceController::class, 'create']	)->name('provinces.create');
	Route::post('store', 	[ProvinceController::class, 'store']		)->name('provinces.store');
    Route::get(	'deleted', 	[ProvinceController::class, 'deleted']	)->name('provinces.deleted');
});

Route::group(['prefix' => 'provinces/{province}'], function () {
	// Province
	Route::get('/', [ProvinceController::class, 'show'])->name('provinces.show');
	Route::get('edit', [ProvinceController::class, 'edit'])->name('provinces.edit');
	Route::patch('update', [ProvinceController::class, 'update'])->name('provinces.update');
	Route::delete('destroy', [ProvinceController::class, 'destroy'])->name('provinces.destroy');
	// Deleted
	Route::get('restore', [ProvinceController::class, 'restore'])->name('provinces.restore');
	Route::get('delete', [ProvinceController::class, 'delete'])->name('provinces.delete-permanently');
});