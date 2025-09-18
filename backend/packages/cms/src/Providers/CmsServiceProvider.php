<?php

declare(strict_types=1);

namespace User\LaravelCms\Providers;

use Inertia\Inertia;
use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider {
	
	protected static string $CMS_ROOT_PATH;

	/**
	 * Register any application services.
	 */
	public function register(): void {
		self::$CMS_ROOT_PATH = dirname(__DIR__, 2) . '/';
		$cmsAuth = require self::$CMS_ROOT_PATH . 'config/auth.php';
    config(['auth.guards.cms' => $cmsAuth['guards']['cms']]);
    config(['auth.providers.cms_users' => $cmsAuth['providers']['cms_users']]);
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void {
		Inertia::setRootView('cms::app');
		$this->loadRoutesFrom(self::$CMS_ROOT_PATH .'routes/web.php');
		$this->loadMigrationsFrom(self::$CMS_ROOT_PATH .'database/migrations');
		$this->loadViewsFrom(self::$CMS_ROOT_PATH .'resources/views', 'cms');
	}

}
