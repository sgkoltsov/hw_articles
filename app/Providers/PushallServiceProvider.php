<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PushAllServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\App\Services\Pushall::class, function() {
            return new \App\Services\Pushall(config('services.pushall.api.key'), config('services.pushall.api.id'));
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
