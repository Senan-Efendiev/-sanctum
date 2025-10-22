<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Перенесите сюда ваши Gate определения из AppServiceProvider
        Gate::define('create-games', function($user) {
            return $user->email === 'admin@mail.ru';
        });

        Gate::define('delete-games', function($user) {
            return $user->email === 'admin@mail.ru';
        });

        Gate::define('edit-games', function($user) {
            return $user->email === 'admin@mail.ru';
        });

        // Дополнительные политики доступа
        Gate::define('manage-developers', function($user) {
            return $user->email === 'admin@mail.ru';
        });

        Gate::define('manage-genres', function($user) {
            return $user->email === 'admin@mail.ru';
        });

        Gate::define('view-reviews', function($user) {
            return auth()->check(); // Любой авторизованный пользователь
        });
    }
}
