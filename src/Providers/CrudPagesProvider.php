<?php

namespace PhilipSorensen\CrudPages\Providers;

use Illuminate\Support\ServiceProvider;

class CrudPagesProvider extends ServiceProvider
{
	/**
	 * Bootstrap services.
	 * 
	 * @return void
	 */
	public function boot()
	{
		$this->loadMigrationsFrom(__DIR__.'/../database/migrations');
		$this->loadViewsFrom(__DIR__.'/../resources/views', 'crudpages');

		$this->publishes([
			__DIR__ . '/../public' => public_path(''),
		], 'crudpages-assets');
	}
}