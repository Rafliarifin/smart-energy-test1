<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

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
    // app/Providers/AppServiceProvider.php
    public function boot(): void
    {   
        Gate::define('update-post', function (User $user, Post $post) {
        return $user->id === $post->user_id || $user->role === 'admin';
    });


        Gate::define('delete-post', function (User $user, Post $post) {
        return $user->id === $post->user_id || $user->role === 'admin';
    });
    }
}
