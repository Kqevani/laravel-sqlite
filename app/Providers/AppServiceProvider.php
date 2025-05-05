<?php

namespace App\Providers;

use App\Repositories\Doctor\DoctorRepository;
use App\Repositories\Doctor\DoctorRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
