<?php

namespace App\Providers;

use App\Models\Goal;
use App\Observers\GoalObserver;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Goal::observe(GoalObserver::class);
    }
}
