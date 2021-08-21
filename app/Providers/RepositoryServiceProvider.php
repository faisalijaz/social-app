<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\User\UserRepository::class,
            \App\Repositories\User\EloquentUser::class
        );

        $this->app->singleton(
            \App\Repositories\Post\PostRepository::class,
            \App\Repositories\Post\EloquentPost::class
        );

        $this->app->singleton(
            \App\Repositories\PostComment\PostCommentRepository::class,
            \App\Repositories\PostComment\EloquentPostComment::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
