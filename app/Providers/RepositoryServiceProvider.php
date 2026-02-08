<?php

namespace App\Providers;

use App\Interfaces\StoreBallanceHistoryRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Interfaces\StoreRepositoryInterface;
use App\Repositories\StoreRepository;
use App\Interfaces\StoreBallanceRepositoryInterface;
use App\Interfaces\WithdrawalRepositoryInterface;
use App\Repositories\StoreBallanceHistoryRepository;
use App\Repositories\StoreBallanceRepository;
use App\Repositories\WithdrawalRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            StoreRepositoryInterface::class,
            StoreRepository::class
        );

        $this->app->bind(
            StoreBallanceRepositoryInterface::class,
            StoreBallanceRepository::class
        );
        $this->app->bind(
            StoreBallanceHistoryRepositoryInterface::class,
            StoreBallanceHistoryRepository::class
        );
        $this->app->bind(
            WithdrawalRepositoryInterface::class,
            WithdrawalRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
