<?php

declare(strict_types=1);

namespace User\LaravelCms\Providers;

use Inertia\Inertia;
use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider {
	
	/**
	 * Register any application services.
	 */
	public function register(): void {
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void {
		Inertia::setRootView('cms::app');
		$cmsRootPath = dirname(__DIR__, 2);

		$this->loadRoutesFrom($cmsRootPath .'/routes/web.php');
		$this->loadMigrationsFrom($cmsRootPath .'/database/migrations');
		$this->loadViewsFrom($cmsRootPath .'/resources/views', 'cms');
	}

}
