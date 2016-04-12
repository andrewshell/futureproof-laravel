<?php

namespace App\Providers;

use Blog\Data\Gateway\PostEloquent;
use Blog\Data\Gateway\PostMemory;
use Blog\Domain\Entity\Post as PostEntity;
use Blog\Domain\Gateway\Post as PostGateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PostGateway::class, function ($app) {
            // return new PostEloquent();
            $postGateway = new PostMemory();
            $postGateway->savePost(new PostEntity(
                'Sample Post 1', 'This is the first sample post.', '', '1'
            ));
            $postGateway->savePost(new PostEntity(
                'Sample Post 2', 'This is the second sample post.', '', '2'
            ));
            $postGateway->savePost(new PostEntity(
                'Sample Post 3', 'This is the third sample post.', '', '3'
            ));
            return $postGateway;
        });
    }
}
