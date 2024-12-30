<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Dotenv\Dotenv;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $dotenv = Dotenv::createImmutable($this->app->basePath());
        $dotenv->load();
    }
}
