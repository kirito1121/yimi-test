<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // if (env('APP_ENV') === 'local') {
        \DB::listen(function ($query) {
            \Log::info(
                $query->sql,
                $query->bindings,
                $query->time
            );
        });
        // }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
