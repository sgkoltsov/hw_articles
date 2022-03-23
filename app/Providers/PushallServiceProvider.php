<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Pushall;

class PushAllServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Pushall::class, function() {
            return new Pushall(config('services.pushall.api.key'), config('services.pushall.api.id'));
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
