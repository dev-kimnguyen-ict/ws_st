<?php

namespace App\Providers;

use App\Models\Category;
use App\Observers\CategoryObserver;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(CategoryObserver::class);

        $this->logDatabaseQuery();
        $this->registerCustomValidationRules();
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton('globals', function () {
            return new Repository();
        });
    }

    /**
     * Log query string to log file.
     */
    protected function logDatabaseQuery()
    {
        if (env('APP_LOG_QUERY', false)) {
            DB::listen(function ($event) {
                Log::info($event->sql, $event->bindings);
            });
        }
    }

    /**
     * Add custom validation rules
     */
    protected function registerCustomValidationRules()
    {
        Validator::extend('phone_number', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^([0-9\s{1}\-\+\(\)]*)$/', $value) > 0;
        });

        Validator::extend('card_number', function ($attribute, $value, $parameters, $validator) {
            $cardRegex = '/^[0-9]+(\-?[0-9]+)*(\/?[0-9]+(\-?[0-9]+)*)(\,[0-9]+(\-?[0-9]+)*(\/?[0-9]+(\-?[0-9]+)*))*$/';
            return preg_match($cardRegex, $value);
        });

        Validator::extend('price_number', function ($attribute, $value, $parameters, $validator) {
            $priceRegex = '/^[0-9]*(\,[0-9]{3})*$/';
            return preg_match($priceRegex, $value);
        });
    }
}
