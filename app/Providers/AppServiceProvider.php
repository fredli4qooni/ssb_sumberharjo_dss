<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        try {
            $settings = \App\Models\Setting::first() ?? new \App\Models\Setting([
                'app_name' => 'SSB Sumberharjo',
                'theme_color' => 'orange',
            ]);
            \Illuminate\Support\Facades\View::share('app_settings', $settings);
        } catch (\Exception $e) {
            // DB not yet migrated or other issue
            \Illuminate\Support\Facades\View::share('app_settings', new \App\Models\Setting([
                'app_name' => 'SSB Sumberharjo',
                'theme_color' => 'orange',
            ]));
        }
    }
}
