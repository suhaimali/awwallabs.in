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

        $isSecureRequest = false;
        try {
            if (! $this->app->runningInConsole()) {
                $req = request();
                $isSecureRequest = $req->isSecure()
                    || $req->header('x-forwarded-proto') === 'https'
                    || $req->server('HTTP_X_FORWARDED_PROTO') === 'https'
                    || $req->server('HTTPS') === 'on'
                    || $req->header('x-forwarded-ssl') === 'on';
            }
        } catch (\Throwable $e) {
            $isSecureRequest = false;
        }

        if ($isSecureRequest || (! $isLocalHost && ($this->app->environment('production') || env('FORCE_HTTPS', false) || str_starts_with((string) config('app.url'), 'https://')))) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
