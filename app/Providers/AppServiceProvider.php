<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\WorkManagment\Services\WorkManagmentService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('workManagmentService', WorkManagmentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
