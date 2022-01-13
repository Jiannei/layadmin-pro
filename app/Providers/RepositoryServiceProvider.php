<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Contracts\MenuRepository::class, \App\Repositories\MenuRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\PageRepository::class, \App\Repositories\PageRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\ActivityRepository::class, \App\Repositories\ActivityRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\ScheduleRepository::class, \App\Repositories\ScheduleRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\RoleRepository::class, \App\Repositories\RoleRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\PermissionRepository::class, \App\Repositories\PermissionRepositoryEloquent::class);
        //:end-bindings:
    }
}
