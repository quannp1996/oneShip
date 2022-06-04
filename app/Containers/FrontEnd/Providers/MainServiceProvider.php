<?php

namespace App\Containers\FrontEnd\Providers;

use Illuminate\Support\Facades\Blade;
use App\Ship\Parents\Providers\MainProvider;
use App\Containers\FrontEnd\UI\WEB\Components\BannerComponent;

class MainServiceProvider extends MainProvider
{
    public $serviceProviders = [];

    public $aliases = [

    ];

    public function register()
    {
        parent::register();
    }

    public function boot() {
        parent::boot();
        Blade::component('banner-component', BannerComponent::class);
    }
}
