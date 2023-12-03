<?php

namespace App\Providers;

use App\Repositories\ActivationCode\ActivationCodeRepository;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use App\Repositories\Blog\BlogRepository;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Repositories\Book\BookRepository;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Faq\FaqRepository;
use App\Repositories\Faq\FaqRepositoryInterface;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Notice\NoticeRepository;
use App\Repositories\Notice\NoticeRepositoryInterface;
use App\Repositories\Opinion\OpinionRepository;
use App\Repositories\Opinion\OpinionRepositoryInterface;
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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ActivationCodeRepositoryInterface::class, ActivationCodeRepository::class);
        $this->app->bind(SmsConfigRepositoryInterface::class, SmsConfigRepository::class);
        $this->app->bind(FaqRepositoryInterface::class, FaqRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(ActivationCodeRepositoryInterface::class,ActivationCodeRepository::class);
        $this->app->bind(SmsConfigRepositoryInterface::class,SmsConfigRepository::class);
        $this->app->bind(OpinionRepositoryInterface::class,OpinionRepository::class);
        $this->app->bind(CommentRepositoryInterface::class,CommentRepository::class);
        $this->app->bind(NoticeRepositoryInterface::class,NoticeRepository::class);
        $this->app->bind(NoticeRepositoryInterface::class , NoticeRepository::class);
        $this->app->bind(BlogRepositoryInterface::class , BlogRepository::class);
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
