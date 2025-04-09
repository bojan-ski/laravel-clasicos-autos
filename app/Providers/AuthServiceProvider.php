<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
use App\Models\CarListing;
use App\Policies\CarListingPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        CarListing::class => CarListingPolicy::class
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
