<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\SiteRepository::class, \App\Repositories\SiteRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DomainRepository::class, \App\Repositories\DomainRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ClusterInfoRepository::class, \App\Repositories\ClusterInfoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\LayerRepository::class, \App\Repositories\LayerRepositoryEloquent::class);
        //:end-bindings:
    }
}
