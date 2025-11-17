<?php

use App\Http\Controllers\Backend\OfficeTypeController;

use App\Models\OfficeType;

Route::bind('office_type', function ($value) {
	$office_type = new OfficeType;

	return OfficeType::withTrashed()->where($office_type->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'office_types'], function () {
	Route::get(	'', 		[OfficeTypeController::class, 'index']		)->name('office_types.index');
    Route::get(	'create', 	[OfficeTypeController::class, 'create']	)->name('office_types.create');
	Route::post('store', 	[OfficeTypeController::class, 'store']		)->name('office_types.store');
    Route::get(	'deleted', 	[OfficeTypeController::class, 'deleted']	)->name('office_types.deleted');
});

Route::group(['prefix' => 'office_types/{office_type}'], function () {
	// OfficeType
	Route::get('/', [OfficeTypeController::class, 'show'])->name('office_types.show');
	Route::get('edit', [OfficeTypeController::class, 'edit'])->name('office_types.edit');
	Route::patch('update', [OfficeTypeController::class, 'update'])->name('office_types.update');
	Route::delete('destroy', [OfficeTypeController::class, 'destroy'])->name('office_types.destroy');
	// Deleted
	Route::get('restore', [OfficeTypeController::class, 'restore'])->name('office_types.restore');
	Route::get('delete', [OfficeTypeController::class, 'delete'])->name('office_types.delete-permanently');
});