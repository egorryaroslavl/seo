<?php

	namespace Egorryaroslavl\Seo;

	use Illuminate\Support\ServiceProvider;

	class SeoServiceProvider extends ServiceProvider
	{

		public function boot()
		{
			$this->loadViewsFrom( __DIR__ . '/views', 'seo' );

			$this->loadRoutesFrom(__DIR__.'/routes.php');

			$this->publishes( [ __DIR__ . '/views' => resource_path( 'views/admin/seo' ) ], 'seo' );
			$this->publishes( [ __DIR__ . '/config/seo.php' => config_path( '/admin/seo.php' ) ], 'config' );
			$this->publishes([
				__DIR__ . '/migrations/2017_05_18_114330_create_seo_table.php' => base_path('database/migrations/2017_05_18_114330_create_seo_table.php')
			], '');



		}

		public function register()
		{

		 	$this->app->make( 'Egorryaroslavl\Seo\SeoController' );
			$this->mergeConfigFrom(__DIR__ . '/config/seo.php', 'seo');

		}

	}