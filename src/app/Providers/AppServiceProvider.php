<?php

namespace App\Providers;

use App\Domain\Repositories\IBallparkRepository;
use App\Domain\Repositories\IShopRepository;
use App\Infrastructure\BallparkRepository;
use App\Infrastructure\ShopRepository;
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
        $this->app->bind(IBallparkRepository::class, BallparkRepository::class);
        $this->app->bind(IShopRepository::class, ShopRepository::class);
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
