<?php

use App\Http\Controllers\Backend\CategoryController;

use App\Models\Category;

Route::bind('category', function ($value) {
	$category = new Category;

	return Category::withTrashed()->where($category->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'categories'], function () {
	Route::get(	'', 		[CategoryController::class, 'index']		)->name('categories.index');
    Route::get(	'create', 	[CategoryController::class, 'create']	)->name('categories.create');
	Route::post('store', 	[CategoryController::class, 'store']		)->name('categories.store');
    Route::get(	'deleted', 	[CategoryController::class, 'deleted']	)->name('categories.deleted');
});

Route::group(['prefix' => 'categories/{category}'], function () {
	// Category
	Route::get('/', [CategoryController::class, 'show'])->name('categories.show');
	Route::get('edit', [CategoryController::class, 'edit'])->name('categories.edit');
	Route::patch('update', [CategoryController::class, 'update'])->name('categories.update');
	Route::delete('destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
	// Deleted
	Route::get('restore', [CategoryController::class, 'restore'])->name('categories.restore');
	Route::get('delete', [CategoryController::class, 'delete'])->name('categories.delete-permanently');
});