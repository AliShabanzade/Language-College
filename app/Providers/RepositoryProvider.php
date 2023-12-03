<?php

namespace App\Providers;

use App\Repositories\ActivationCode\ActivationCodeRepository;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use App\Repositories\Book\BookRepository;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
        $this->app->bind(ActivationCodeRepositoryInterface::class,ActivationCodeRepository::class);
        $this->app->bind(BookRepositoryInterface::class,BookRepository::class);
        $this->app->bind(RoleRepositoryInterface::class,RoleRepository::class);

        $this->app->bind(CategoryRepositoryInterface::class , CategoryRepository::class);



    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
