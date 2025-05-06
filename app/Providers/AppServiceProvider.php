<?php

namespace App\Providers;

use App\Repository\Api\V1\Read\Comment\CommentReadRepository;
use App\Repository\Api\V1\Read\Comment\CommentReadRepositoryInterface;
use App\Repository\Api\V1\Read\Post\PostReadRepository;
use App\Repository\Api\V1\Read\Post\PostReadRepositoryInterface;
use App\Repository\Api\V1\Read\User\UserReadRepository;
use App\Repository\Api\V1\Read\User\UserReadRepositoryInterface;
use App\Repository\Api\V1\Write\Comment\CommentWriteRepository;
use App\Repository\Api\V1\Write\Comment\CommentWriteRepositoryInterface;
use App\Repository\Api\V1\Write\Post\PostWriteRepository;
use App\Repository\Api\V1\Write\Post\PostWriteRepositoryInterface;
use App\Repository\Api\V1\Write\User\UserWriteRepository;
use App\Repository\Api\V1\Write\User\UserWriteRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public $bindings = [
        UserReadRepositoryInterface::class => UserReadRepository::class,
        UserWriteRepositoryInterface::class => UserWriteRepository::class,

        PostWriteRepositoryInterface::class => PostWriteRepository::class,
        PostReadRepositoryInterface::class => PostReadRepository::class,


        CommentWriteRepositoryInterface::class => CommentWriteRepository::class,
        CommentReadRepositoryInterface::class => CommentReadRepository::class,
    ];

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
    public function boot(): void
    {
        //
    }
}
