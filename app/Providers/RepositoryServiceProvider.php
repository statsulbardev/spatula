<?php

namespace App\Providers;

use App\Http\Livewire\Configuration\CreateEditService;
use App\Http\Livewire\Configuration\CreateEditUnit;
use App\Repositories\Interfaces\ConfigurationInterface;
use App\Repositories\ServiceRepository;
use App\Repositories\UnitRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /**
        * Contextual-Binding
        * https://laravel.com/docs/9.x/container#contextual-binding
        */

        // Service Configuration (Daftar Layanan)
       $this->app
            -> when(CreateEditService::class)
            -> needs(ConfigurationInterface::class)
            -> give(ServiceRepository::class);

        // Unit Configurtion (Daftar Satker)
        $this->app
            -> when(CreateEditUnit::class)
            -> needs(ConfigurationInterface::class)
            -> give(UnitRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() { }
}
