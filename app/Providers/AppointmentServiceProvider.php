<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AppointmentService;

class AppointmentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AppointmentService::class, function ($app) {
            return new AppointmentService();
        });
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

