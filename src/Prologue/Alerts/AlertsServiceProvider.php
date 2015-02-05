<?php namespace Prologue\Alerts;

use Illuminate\Support\ServiceProvider;

class AlertsServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->prepareResources();

		// Register the AlertsMessageBag class.
		$this->app['alerts'] = $this->app->share(function($app)
		{
			return new AlertsMessageBag($app['session.store'], $app['config']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('alerts');
	}

	/**
	 * Prepare the package resources.
	 *
	 * @return void
	 */
	protected function prepareResources()
	{
		$configPath = __DIR__ . '/../../config/config.php';
		$this->mergeConfigFrom($configPath, 'alerts');
		$this->publishes([
			$configPath => config_path('alerts.php'),
		]);
	}

}
