<?php

namespace App\Providers;

use App\Repositories\EmpresaRepository;
use App\Services\EmpresaService;
use App\Repositories\Interfaces\IEmpresaRepository;
use App\Services\Interfaces\IEmpresaService;
use App\Services\Interfaces\IService;
use App\Services\Service;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        // Empresa
        $this->app->bind(IEmpresaService::class, EmpresaService::class);
        $this->app->bind(IEmpresaRepository::class, EmpresaRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
