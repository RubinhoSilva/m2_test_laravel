<?php

namespace App\Providers;

use App\Repositories\CityRepository;
use App\Repositories\GroupCitiesRepository;
use App\Repositories\Interfaces\CityInterface;
use App\Repositories\Interfaces\GroupCitiesInterface;
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
        $this->app->bind(
            GroupCitiesInterface::class,
            GroupCitiesRepository::class,
        );

        $this->app->bind(
            CityInterface::class,
            CityRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
