<?php

namespace App\Providers;

use App\Repositories\ActivationCode\ActivationCodeRepository;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use App\Repositories\Fav\FavRepository;
use App\Repositories\Fav\FavRepositoryInterface;
use App\Repositories\Publication\PublicationRepository;
use App\Repositories\Publication\PublicationRepositoryInterface;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Repositories\SmsConfig\SmsConfigRepository;
use App\Repositories\SmsConfig\SmsConfigRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(ActivationCodeRepositoryInterface::class,ActivationCodeRepository::class);
        $this->app->bind(SmsConfigRepositoryInterface::class,SmsConfigRepository::class);
        $this->app->bind(PublicationRepositoryInterface::class,PublicationRepository::class);
        $this->app->bind(FavRepositoryInterface::class,FavRepository::class);
        $this->app->bind(SettingRepositoryInterface::class,FavRepository::class);



    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
