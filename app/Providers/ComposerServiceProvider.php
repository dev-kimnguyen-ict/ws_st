<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->shareDataToAllView();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function shareDataToAllView()
    {
        View::composer('*', function (\Illuminate\View\View $view) {
            $view->with([
                '_page' => app('globals'),
                '_auth' => Auth::user(),
            ]);
        });
    }
}
