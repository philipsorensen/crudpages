<?php

use Illuminate\Support\Facades\Route;
use PhilipSorensen\CrudPages\Controllers\CrudPagesController;

Route::group(['middleware' => 'web'], function () {
	Route::controller(CrudPagesController::class)->name('crudpages.')->prefix('crudpages')->group(function () {
		Route::get('', 'index')->name('index');
		Route::get('create', 'create')->name('create');
		Route::post('create', 'store')->name('store');
		Route::get('{id}/edit', 'edit')->name('edit');
		Route::post('{id}/edit', 'update')->name('update');
		Route::get('{id}/toggle', 'toggleActive')->name('toggle');
		Route::get('{id}/delete', 'delete')->name('delete');
	});
});