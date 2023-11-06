<?php

namespace App\Providers;

use App\Models\ActivationCode;
use App\Repositories\ActivationCode\ActivationCodeRepository;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use App\Repositories\SmsConfig\SmsConfigRepository;
use App\Repositories\SmsConfig\SmsConfigRepositoryInterface;
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
        $this->app->bind(ActivationCodeRepositoryInterface::class,ActivationCodeRepository::class);
        $this->app->bind(SmsConfigRepositoryInterface::class,SmsConfigRepository::class);


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
