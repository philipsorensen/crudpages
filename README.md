

## Requirements
The package views uses Bootstrap 5. 

The package assumes you have a layout-file `layout.app` that can be extended. In your layout-file you also have the following sections: 

* content
  * The main content of the webpage.
* css
  * Section in the header to inject CSS scripts. 
* meta_description
  * The description of your webpage.
* meta_title
  * The title of your webpage. 
* scripts
  * Section in the bottom of the webpage for Javascript and other stuff.

## Installation

> composer require philipsorensen/crudpages

Add the following in your `config/app.php` under providers. 

```
PhilipSorensen\CrudPages\Providers\CrudPagesProvider::class
```

> php artisan vendor:publish --tag=crudpages-assets

## Usage

Add something like this to your `routes/web.php`:
```
<?php
use PhilipSorensen\CrudPages\Controllers\AdminCrudPageController;
use PhilipSorensen\CrudPages\Controllers\CrudPageController;

Route::controller(AdminCrudPageController::class)->middleware('can:page crud')->name('admin.crudpages.')->prefix('pages')->group(function () {
	Route::get('', 'index')->name('index');
	Route::get('create', 'create')->name('create');
	Route::post('create', 'store');
	Route::get('{id}/delete', 'delete')->name('delete');
	Route::get('{id}/edit', 'edit')->name('edit');
	Route::post('{id}/edit', 'update');
	Route::get('{id}/toggle', 'toggleActive')->name('toggle');
});

Route::controller(CrudPageController::class)->group(function () {
	Route::get('{slug}', 'show')->name('page.show');
	Route::get('{slug1}/{slug2}', 'show2');
	Route::get('{slug1}/{slug2}/{slug3}', 'show3');
});
```

Both `AdminCrudPageController` and `CrudPageController` can be extended with custom controllers. 