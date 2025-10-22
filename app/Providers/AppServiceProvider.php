<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Genre;

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
        // Настройка пагинации для Bootstrap
        Paginator::useBootstrap();

        // Глобальные переменные для шаблонов
        view()->composer('games.*', function ($view) {
            $view->with('genres', Genre::query()->orderBy('name')->get());
        });
    }
}
