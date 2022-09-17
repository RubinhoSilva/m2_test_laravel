<?php

namespace App\Providers;

use App\Http\PatternResponses\IPatternResponse;
use App\Http\PatternResponses\PatternResponseJson;
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
        $this->app->bind(
            IPatternResponse::class,
            PatternResponseJson::class,
        );
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
