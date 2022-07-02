<?php

namespace App\Containers\BaseContainer\Providers;

use App\Ship\Parents\Providers\MainProvider;


class MainServiceProvider extends MainProvider
{
    public $serviceProviders = [
        DynamicMailServiceProvider::class
    ];

    public $aliases = [

    ];

    public function register()
    {
        parent::register();
        // $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    public function boot() {
        parent::boot();
    }
}
