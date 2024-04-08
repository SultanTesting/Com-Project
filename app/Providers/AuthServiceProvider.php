<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;

use App\Models\ProductVariantItem;
use App\Policies\ProductPolicy;
use App\Policies\ProductVariantItemPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        ProductPolicy::class => Product::class,
        ProductVariantItemPolicy::class => ProductVariantItem::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
