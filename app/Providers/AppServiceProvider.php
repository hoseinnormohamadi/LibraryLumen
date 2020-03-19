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
        \Log::listen(
            function ( $exception )
            {
                if( $exception instanceof \Exception )
                {
                    app('sentry')->captureException($exception);
                }
            }
        );
    }
}