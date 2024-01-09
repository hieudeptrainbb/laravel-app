<?php

namespace App\Providers;

use App\Repositories\Repository\TuRepository;
use App\Repositories\TuRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\PassportServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(PassportServiceProvider::class);
        $this->app->bind(TuRepositoryInterface::class, TuRepository::class);
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
