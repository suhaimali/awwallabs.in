<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS only in production when not accessing via local development hosts
        $isLocalHost = false;
        try {
            if (! $this->app->runningInConsole()) {
                $host = request()->getHost();
                $isLocalHost = in_array($host, ['localhost', '127.0.0.1', '::1', '0.0.0.0'])
                    || str_ends_with($host, '.test')
                    || str_ends_with($host, '.local');
            }
        } catch (\Throwable $e) {
            $isLocalHost = true;
        }

        if (! $isLocalHost && ($this->app->environment('production') || env('FORCE_HTTPS', false))) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
