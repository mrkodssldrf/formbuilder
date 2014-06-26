<?php namespace Derduesseldorf\Formbuilder;

use Derduesseldorf\Formbuilder\Utils\Formbuilder;
use Illuminate\Support\ServiceProvider;

class FormbuilderServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('derduesseldorf/formbuilder', null, __DIR__.'/');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['formbuilder'] = $this->app->share(function($app){
            return new Formbuilder();
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('formbuilder');
	}

}
