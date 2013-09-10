<?php namespace Artdarek\GameAnalytics;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use \Config;

class GameAnalyticsServiceProvider extends ServiceProvider {

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
		$this->package('artdarek/ga-4-laravel');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
	    // Register 'gameanalytics' instance container to our 'gameanalytics' object
		    $this->app['gameanalytics'] = $this->app->share(function($app)
		    {

		    	// connection credentials loaded from config

		    		// if gameanalytics key exists in database.php config use this one
		    		if ( Config::get('gameanalytics.game.key') != null ) {
		                $key = Config::get('gameanalytics.game.key');
		                $secret = Config::get('gameanalytics.game.secret');
		            	$version = Config::get('gameanalytics.api.version');		            	
		            	$handler = Config::get('gameanalytics.handler');		            	
	                // esle try to find config in packages configs
		    		} else {
		                $key = Config::get('ga-4-laravel::game.key');
		                $secret = Config::get('ga-4-laravel::game.secret');
		            	$version = Config::get('ga-4-laravel::api.version');
						$handler = Config::get('ga-4-laravel::handler');		            	

		    		}

        		// create mew gameanalytics node

        			$handlerName = 'Artdarek\GameAnalytics\Handlers\\'.$handler;

        			$ga = new GameAnalytics( new $handlerName );
        			$ga->setSecret( $secret );
        			$ga->setVersion( $version );
        			$ga->setKey( $key );

        		// return ga
		        	return $ga;

		    });


	    // Shortcut so developers don't need to add an Alias in app/config/app.php
		    $this->app->booting(function()
		    {
		        $loader = AliasLoader::getInstance();
		        $loader->alias('GameAnalytics', 'Artdarek\GameAnalytics\Facades\GameAnalytics');
		    });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}