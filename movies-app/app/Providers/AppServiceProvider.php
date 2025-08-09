<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\MovieList;
use App\Policies\MovieListPolicy;

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
        //
    }

    protected $polices = [
        MovieList::class => MovieListPolicy::class,
    ];
}
