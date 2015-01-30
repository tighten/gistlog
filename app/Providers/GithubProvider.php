<?php namespace Gistlog\Providers;

use Github\Client;
use Github\HttpClient\CachedHttpClient;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class GithubProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
//		$this->app['Github\Client'] = new Client(
//			new CachedHttpClient(['cache_dir' => '/tmp/github-api-cache'])
//		);
		$this->app['Github\Client'] = new Client;
	}

}
