<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
        URL::forceScheme('https');

        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/spatula-2025/livewire/update', $handle)->name('customsetUpdateRoute');
        });

        Model::shouldBeStrict(! $this->app->isProduction());
    }
}
