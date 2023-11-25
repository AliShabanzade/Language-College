<?php

namespace App\Providers;

use App\Repositories\ActivationCode\ActivationCodeRepository;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use App\Repositories\Book\BookRepository;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\SmsToken\SmsTokenRepository;
use App\Repositories\SmsToken\SmsTokenRepositoryInterface;
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



    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
