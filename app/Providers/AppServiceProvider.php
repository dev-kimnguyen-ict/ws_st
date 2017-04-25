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
        $this->listenDb();
        $this->registerCustomValidationRules();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('globals', function () {
            return new Repository();
        });
    }

    protected function listenDb()
    {
        if(env('APP_LOG_QUERY', false)) {
            DB::listen(function ($event) {
                Log::info($event->sql, $event->bindings);
            });
        }
    }

    protected function registerCustomValidationRules()
    {
        Validator::extend('phone_number', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^([0-9\s{1}\-\+\(\)]*)$/', $value) > 0;
        });

        Validator::extend('card_number', function ($attribute, $value, $parameters, $validator) {
            $cardRegex = '/^[0-9]+(\-?[0-9]+)*(\/?[0-9]+(\-?[0-9]+)*)(\,[0-9]+(\-?[0-9]+)*(\/?[0-9]+(\-?[0-9]+)*))*$/';
            return preg_match($cardRegex, $value);
        });
    }
}
