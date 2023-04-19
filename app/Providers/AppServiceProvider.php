<?php

namespace App\Providers;

use App\Helpers\StringHelper;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register the application's string-helper binding.
     *
     * This method binds a "string-helper" instance to the application container.
     * It creates a new instance of the StringHelper class and returns it.
     * The application container will then resolve any dependencies through this binding.
     */
    public function register()
    {
        $this->app->bind('string-helper', function ($app) {
            return new StringHelper();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Custom Blade directive to set active class on current URL/route
        Blade::directive('active', function ($expression) {
            return "<?php echo Route::current()->uri() === $expression ? 'active' : ''; ?>";
        });
    }
}
