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
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
		$this->loadTranslationsFrom(__DIR__ . '/../lang', 'crudpages');
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'crudpages');
		$this->mergeConfigFrom(
			__DIR__.'/../config/crudpages.php', 'crudpages'
		);

		$this->publishes([
			__DIR__ . '/../public' => public_path(''),
		], 'crudpages-assets');
	}
}