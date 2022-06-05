<?php

namespace App\Containers\ShippingUnit\Providers;

use App\Containers\Order\UI\WEB\Requests\GetAllOrdersRequest;
use App\Containers\ShippingUnit\Enums\EnumShipping;
use App\Containers\ShippingUnit\Business\Services\GHTKAPI;
use App\Containers\ShippingUnit\Business\Services\NinjaVanAPI;
use App\Containers\ShippingUnit\Business\ShippingUnitInterface;
use App\Ship\Parents\Providers\MainProvider;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 */
class MainServiceProvider extends MainProvider
{

    /**
     * Container Service Providers.
     *
     * @var array
     */
    public $serviceProviders = [];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [];

    /**
     * Register anything in the container.
     */
    public function register()
    {
        parent::register();
        $this->app->bind(ShippingUnitInterface::class, function(){
            switch(request('shipping_api', '')){
                case EnumShipping::GHTK:
                default:
                    return new GHTKAPI();
                case EnumShipping::NINJAVAN:
                    return new NinjaVanAPI();
            }
        });
    }
}
