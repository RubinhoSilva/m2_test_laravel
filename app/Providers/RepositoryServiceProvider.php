<?php

namespace App\Providers;

use App\Repositories\CampaignProductRepository;
use App\Repositories\CampaignRepository;
use App\Repositories\CityRepository;
use App\Repositories\GroupCitiesRepository;
use App\Repositories\Interfaces\CampaignInterface;
use App\Repositories\Interfaces\CampaignProductInterface;
use App\Repositories\Interfaces\CityInterface;
use App\Repositories\Interfaces\GroupCitiesInterface;
use App\Repositories\Interfaces\ProductInterface;
use App\Repositories\ProductRepository;
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

        $this->app->bind(
            ProductInterface::class,
            ProductRepository::class,
        );

        $this->app->bind(
            CampaignInterface::class,
            CampaignRepository::class,
        );

        $this->app->bind(
            CampaignProductInterface::class,
            CampaignProductRepository::class,
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
