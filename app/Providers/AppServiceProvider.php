<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        View::composer('back.*', function (\Illuminate\View\View $view) {
            $translates = Setting::pluck('value_' . app()->getLocale(), 'key')->toArray();
            $view->with('translates', $translates);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
