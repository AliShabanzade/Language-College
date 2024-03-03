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
use App\Repositories\Classroom\ClassroomRepository;
use App\Repositories\Classroom\ClassroomRepositoryInterface;
use App\Repositories\College\CollegeRepository;
use App\Repositories\College\CollegeRepositoryInterface;
use App\Repositories\Course\CourseRepository;
use App\Repositories\Course\CourseRepositoryInterface;
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
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Session\SessionRepository;
use App\Repositories\Session\SessionRepositoryInterface;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepository;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use App\Repositories\SmsConfig\SmsConfigRepository;
use App\Repositories\SmsConfig\SmsConfigRepositoryInterface;
use App\Repositories\Term\TermRepository;
use App\Repositories\Term\TermRepositoryInterface;
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
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(OrderItemRepositoryInterface::class, OrderItemRepository::class);
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
        $this->app->bind(RoleRepositoryInterface::class,RoleRepository::class);
        $this->app->bind(CollegeRepositoryInterface::class,CollegeRepository::class);
        $this->app->bind(CourseRepositoryInterface::class,CourseRepository::class);
        $this->app->bind(TermRepositoryInterface::class,TermRepository::class);
        $this->app->bind(ClassroomRepositoryInterface::class,ClassroomRepository::class);
        $this->app->bind(SessionRepositoryInterface::class,SessionRepository::class);







    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
