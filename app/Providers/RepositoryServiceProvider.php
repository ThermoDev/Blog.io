<?php

namespace App\Providers;

use App\Interfaces\ActivityRepositoryInterface;
use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\ActivityRepository;
use App\Repositories\BlogRepository;
use App\Repositories\UserRepository;
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
        $this->app->bind(ActivityRepositoryInterface::class, ActivityRepository::class);
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
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
