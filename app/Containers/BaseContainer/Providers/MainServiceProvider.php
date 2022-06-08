<?php

namespace App\Containers\BaseContainer\Providers;

use App\Containers\BaseContainer\UI\WEB\Components\FrontEnd\BreadcrumbComponent;
use App\Containers\BaseContainer\UI\WEB\Components\FrontEnd\CommentBoxComponent;
use App\Containers\BaseContainer\UI\WEB\Components\FrontEnd\FooterComponent;
use App\Containers\BaseContainer\UI\WEB\Components\FrontEnd\HeaderComponent;
use App\Containers\BaseContainer\UI\WEB\Components\FrontEnd\ModalAuthComponent;
use Illuminate\Support\Facades\Blade;
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
        // do your binding here..
        // $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    public function boot() {
        parent::boot();
        Blade::component('header-component', HeaderComponent::class);
        Blade::component('footer-component', FooterComponent::class);
        Blade::component('modal-auth-component', ModalAuthComponent::class);
        Blade::component('comment-component', CommentBoxComponent::class);
        Blade::component('breadcrumb-component', BreadcrumbComponent::class);
    }
}
