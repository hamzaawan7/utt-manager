<?php

namespace App\Providers;

use App\Repositories\CustomerBookingRepositoryInterface;
use App\Repositories\DiscountRepositoryInterface;
use App\Repositories\Eloquent\CustomerBookingRepository;
use App\Repositories\Eloquent\DiscountRepository;
use App\Repositories\Eloquent\LateAvailabilityRepository;
use App\Repositories\LateAvailabilityRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PropertyCategoryRepositoryInterface;
use App\Repositories\Eloquent\PropertyCategoryRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\PriceCategoryRepository;
use App\Repositories\PriceCategoryRepositoryInterface;
use App\Repositories\PriceSeasonRepositoryInterface;
use App\Repositories\Eloquent\PriceSeasonRepository;
use App\Repositories\PriceRepositoryInterface;
use App\Repositories\Eloquent\PriceRepository;
use App\Repositories\FeatureRepositoryInterface;
use App\Repositories\Eloquent\FeatureRepository;
use App\Repositories\Eloquent\PropertyRepository;
use App\Repositories\PropertyRepositoryInterface;
use App\Repositories\OwnerRepositoryInterface;
use App\Repositories\Eloquent\OwnerRepository;
use App\Repositories\Eloquent\ReviewRepository;
use App\Repositories\ReviewRepositoryInterface;
use App\Repositories\CustomerRepositoryInterface;
use App\Repositories\Eloquent\CustomerRepository;
use App\Repositories\TypeRepositoryInterface;
use App\Repositories\Eloquent\TypeRepository;

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
        $this->app->bind(PriceCategoryRepositoryInterface::class, PriceCategoryRepository::class);
        $this->app->bind(PriceSeasonRepositoryInterface::class, PriceSeasonRepository::class);
        $this->app->bind(PriceRepositoryInterface::class, PriceRepository::class);
        $this->app->bind(FeatureRepositoryInterface::class, FeatureRepository::class);
        $this->app->bind(PropertyRepositoryInterface::class, PropertyRepository::class);
        $this->app->bind(OwnerRepositoryInterface::class, OwnerRepository::class);
        $this->app->bind(ReviewRepositoryInterface::class, ReviewRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(TypeRepositoryInterface::class, TypeRepository::class);
        $this->app->bind(DiscountRepositoryInterface::class, DiscountRepository::class);
        $this->app->bind(CustomerBookingRepositoryInterface::class, CustomerBookingRepository::class);
        $this->app->bind(LateAvailabilityRepositoryInterface::class, LateAvailabilityRepository::class);
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
