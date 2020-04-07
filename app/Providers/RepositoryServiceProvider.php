<?php

namespace App\Providers;

use App\Repositories\Api\Interfaces\UserRepositoryInterface;
use App\Repositories\Api\UserRepository;
use Illuminate\Support\ServiceProvider;

/**
* Class RepositoryServiceProvider
* @package App\Providers
*/
class RepositoryServiceProvider extends ServiceProvider
{
   /**
    * Register services.
    *
    * @return void
    */
   public function register()
   {
       $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
   }
}
