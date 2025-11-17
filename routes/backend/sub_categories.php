<?php

use App\Http\Controllers\Backend\SubCategoryController;

use App\Models\SubCategory;

Route::bind('sub_category', function ($value) {
	$sub_category = new SubCategory;

	return SubCategory::withTrashed()->where($sub_category->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'sub_categories'], function () {
	Route::get(	'', 		[SubCategoryController::class, 'index']		)->name('sub_categories.index');
    Route::get(	'create', 	[SubCategoryController::class, 'create']	)->name('sub_categories.create');
	Route::post('store', 	[SubCategoryController::class, 'store']		)->name('sub_categories.store');
    Route::get(	'deleted', 	[SubCategoryController::class, 'deleted']	)->name('sub_categories.deleted');
});

Route::group(['prefix' => 'sub_categories/{sub_category}'], function () {
	// SubCategory
	Route::get('/', [SubCategoryController::class, 'show'])->name('sub_categories.show');
	Route::get('edit', [SubCategoryController::class, 'edit'])->name('sub_categories.edit');
	Route::patch('update', [SubCategoryController::class, 'update'])->name('sub_categories.update');
	Route::delete('destroy', [SubCategoryController::class, 'destroy'])->name('sub_categories.destroy');
	// Deleted
	Route::get('restore', [SubCategoryController::class, 'restore'])->name('sub_categories.restore');
	Route::get('delete', [SubCategoryController::class, 'delete'])->name('sub_categories.delete-permanently');
});