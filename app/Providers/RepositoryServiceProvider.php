<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\PropertyCategoryRepositoryInterface;
use App\Repositories\Eloquent\PropertyCategoryRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PropertyCategoryRepositoryInterface::class, PropertyCategoryRepository::class);
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
