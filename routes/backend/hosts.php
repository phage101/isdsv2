<?php

use App\Http\Controllers\Backend\HostController;

use App\Models\Host;

Route::bind('host', function ($value) {
	$host = new Host;

	return Host::withTrashed()->where($host->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'hosts'], function () {
	Route::get(	'', 		[HostController::class, 'index']		)->name('hosts.index');
    Route::get(	'create', 	[HostController::class, 'create']	)->name('hosts.create');
	Route::post('store', 	[HostController::class, 'store']		)->name('hosts.store');
    Route::get(	'deleted', 	[HostController::class, 'deleted']	)->name('hosts.deleted');
});

Route::group(['prefix' => 'hosts/{host}'], function () {
	// Host
	Route::get('/', [HostController::class, 'show'])->name('hosts.show');
	Route::get('edit', [HostController::class, 'edit'])->name('hosts.edit');
	Route::patch('update', [HostController::class, 'update'])->name('hosts.update');
	Route::delete('destroy', [HostController::class, 'destroy'])->name('hosts.destroy');
	// Deleted
	Route::get('restore', [HostController::class, 'restore'])->name('hosts.restore');
	Route::get('delete', [HostController::class, 'delete'])->name('hosts.delete-permanently');
});