<?php

use App\Http\Controllers\Backend\PriorityLevelController;

use App\Models\PriorityLevel;

Route::bind('priority_level', function ($value) {
	$priority_level = new PriorityLevel;

	return PriorityLevel::withTrashed()->where($priority_level->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'priority_levels'], function () {
	Route::get(	'', 		[PriorityLevelController::class, 'index']		)->name('priority_levels.index');
    Route::get(	'create', 	[PriorityLevelController::class, 'create']	)->name('priority_levels.create');
	Route::post('store', 	[PriorityLevelController::class, 'store']		)->name('priority_levels.store');
    Route::get(	'deleted', 	[PriorityLevelController::class, 'deleted']	)->name('priority_levels.deleted');
});

Route::group(['prefix' => 'priority_levels/{priority_level}'], function () {
	// PriorityLevel
	Route::get('/', [PriorityLevelController::class, 'show'])->name('priority_levels.show');
	Route::get('edit', [PriorityLevelController::class, 'edit'])->name('priority_levels.edit');
	Route::patch('update', [PriorityLevelController::class, 'update'])->name('priority_levels.update');
	Route::delete('destroy', [PriorityLevelController::class, 'destroy'])->name('priority_levels.destroy');
	// Deleted
	Route::get('restore', [PriorityLevelController::class, 'restore'])->name('priority_levels.restore');
	Route::get('delete', [PriorityLevelController::class, 'delete'])->name('priority_levels.delete-permanently');
});