<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->isProduction()) {
            Livewire::setScriptRoute(function ($handle) {
                return Route::get('/public/vendor/livewire/livewire.js', $handle);
            });
            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/public/livewire/update', $handle);
            });
        }

    }
}
