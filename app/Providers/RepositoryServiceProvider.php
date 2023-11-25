<?php

namespace App\Providers;

use App\Repositories\ActivationCode\ActivationCodeRepository;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use App\Repositories\Notice\NoticeRepository;
use App\Repositories\Notice\NoticeRepositoryInterface;
use App\Repositories\Opinion\OpinionRepository;
use App\Repositories\Opinion\OpinionRepositoryInterface;
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
        $this->app->bind(NoticeRepositoryInterface::class , NoticeRepository::class);
        $this->app->bind(OpinionRepositoryInterface::class,OpinionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
