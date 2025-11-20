<?php

use App\Http\Controllers\Backend\MeetingController;

use App\Models\Meeting;

Route::bind('meeting', function ($value) {
	$meeting = new Meeting;

	return Meeting::withTrashed()->where($meeting->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'meetings'], function () {
	Route::get(	'', 		[MeetingController::class, 'index']		)->name('meetings.index');
    Route::get(	'create', 	[MeetingController::class, 'create']	)->name('meetings.create');
	Route::post('store', 	[MeetingController::class, 'store']		)->name('meetings.store');
	Route::get(	'events', 	[MeetingController::class, 'events']	)->name('meetings.events');
	Route::get(	'deleted', 	[MeetingController::class, 'deleted']	)->name('meetings.deleted');
});

Route::group(['prefix' => 'meetings/{meeting}'], function () {
	// Meeting
	Route::get('/', [MeetingController::class, 'show'])->name('meetings.show');
	Route::get('edit', [MeetingController::class, 'edit'])->name('meetings.edit');
	Route::patch('update', [MeetingController::class, 'update'])->name('meetings.update');
	Route::delete('destroy', [MeetingController::class, 'destroy'])->name('meetings.destroy');
	// Deleted
	Route::get('restore', [MeetingController::class, 'restore'])->name('meetings.restore');
	Route::get('delete', [MeetingController::class, 'delete'])->name('meetings.delete-permanently');
});