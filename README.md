

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

Add these routes to the end of your `routes/web.php` (end because they are wildcard routes).

```
use PhilipSorensen\CrudPages\Controllers\PageController;

Route::controller(PageController::class)->name('page.')->group(function () {
	Route::get('{slug}', 'show')->name('show');
	Route::get('{slug1}/{slug2}', 'show2');
	Route::get('{slug1}/{slug2}/{slug3}', 'show3');
});
```

## Usage

> ???