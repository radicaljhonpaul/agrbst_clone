<?php

namespace App\Providers;

use App\Interfaces\InventoryAndOrdersInterface;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\UserAccountsInterface;
use App\Repositories\UserAccountsRepository;
use App\Interfaces\SupplyAndDemandInterface;
use App\Repositories\SupplyAndDemandRepository;
use App\Interfaces\SalesAndTransactionsInterface;
use App\Repositories\InventoryAndOrdersRepository;
use App\Interfaces\WidgetsRepositoryInterface;
use App\Repositories\SalesAndTransactionsRepository;
use App\Repositories\WidgetsRepository;

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
        $this->app->bind(UserAccountsInterface::class, UserAccountsRepository::class);
        $this->app->bind(SupplyAndDemandInterface::class, SupplyAndDemandRepository::class);
        $this->app->bind(SalesAndTransactionsInterface::class, SalesAndTransactionsRepository::class);
        $this->app->bind(InventoryAndOrdersInterface::class, InventoryAndOrdersRepository::class);
        $this->app->bind(WidgetsRepositoryInterface::class, WidgetsRepository::class);
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
