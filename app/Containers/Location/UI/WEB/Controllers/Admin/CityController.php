<?php

namespace App\Containers\Location\UI\WEB\Controllers\Admin;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Controllers\AdminController;
use App\Containers\Location\UI\WEB\Requests\DeleteLocationRequest;
use App\Containers\Location\UI\WEB\Requests\GetAllLocationsRequest;
use App\Containers\Location\UI\WEB\Requests\UpdateLocationRequest;
use App\Containers\Location\UI\WEB\Requests\StoreLocationRequest;
use App\Containers\Location\UI\WEB\Requests\DeleteCityRequest;
use App\Containers\Location\UI\WEB\Requests\StoreCityRequest;
use App\Containers\Location\UI\WEB\Requests\UpdateCityRequest;
use Apiato\Core\Foundation\Facades\FunctionLib;
use App\Containers\Location\Models\City;

/**
 * Class Controller
 *
 * @package App\Containers\Location\UI\WEB\Controllers
 */
class CityController extends LocationController
{
    /**
     * Show all entities
     *
     * @param GetAllLocationsRequest $request
     */
    public function __construct()
    {
        $this->title = __('location::admin.city.title');
        parent::__construct();
    }
    public function listCity(GetAllLocationsRequest $request)
    {
        $cities = Apiato::call('Location@GetAllCitiesAction', [true,20,'id desc', [], $request->all()]);
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['list', $this->title]);
        return view('location::Admin.city', [
            'cities' => $cities,
            'search_data' => $request
        ]);
    }

    /**
     * Add a new entity
     *
     * @param StoreLocationRequest $request
     */
    public function storeCity(StoreCityRequest $request)
    {   
        Apiato::call('Location@CreateCityAction', [$request]);
        return redirect(route('location.city_list'));
    }


    /**
     * Update a given entity
     *
     * @param UpdateLocationRequest $request
     */
    public function updateCity(UpdateCityRequest $request)
    {
        $location = Apiato::call('Location@UpdateCityAction', [$request]);
        return redirect(route('location.city_list'));
    }

    /**
     * Delete a given entity
     *
     * @param DeleteLocationRequest $request
     */
    public function deleteCity(DeleteCityRequest $request)
    {
        Apiato::call('Location@DeleteCityAction', [ $request->id ]);
        return redirect(route('location.city_list'));
    }

    public function getCityAjax(GetAllLocationsRequest $request)
    {
        $cities = Apiato::call('Location@GetAllCitiesAction', [false,20,'name desc', [], ['city']]);
        if($cities)
        return FunctionLib::ajaxRespond(true, 'Hoàn thành', $cities);
            else
        return FunctionLib::ajaxRespond(false, 'ko tồn tại');
    }

    public function exportToJsonFile( $request) {

    }
}
