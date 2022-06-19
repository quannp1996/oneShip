<?php

namespace App\Containers\Location\UI\WEB\Controllers\Admin;

use App\Containers\Location\Actions\GetAllCitiesAction;
use App\Containers\Location\Actions\GetAllDistrictsAction;
use App\Containers\Location\Actions\GetAllWardsAction;
use App\Containers\Location\Import\ImportCity;
use App\Containers\Location\Models\City;
use App\Containers\Location\Models\District;
use App\Containers\Location\Models\Ward;
use App\Ship\Parents\Controllers\AdminController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class Controller
 *
 * @package App\Containers\Location\UI\WEB\Controllers
 */
class ImportController extends AdminController
{
    public function importCity()
    {
        try{
            DB::table('_geovnprovince')->truncate();
            $districts = Excel::toArray(new ImportCity(), request()->file('file'))[0];
            foreach($districts AS $key => $value){
                if($key) {
                    $city = new City([
                        'name' => $value[1],
                        'code' => $value[0],
                    ]);
                    $city->save();
                }
            }
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    public function importDistrict()
    {
        try{
            DB::table('_geovndistrict')->truncate();
            $districts = Excel::toArray(new ImportCity(), request()->file('file'))[0];
            foreach($districts AS $key => $value){
                if($key) {
                    $city = new District([
                        'name' => $value[1],
                        'code' => $value[0],
                        'province_id' => $value[4]
                    ]);
                    $city->save();
                }
            }
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    public function importWard()
    {
        try{
            DB::table('_geovnward')->truncate();
            $wards = Excel::toArray(new ImportCity(), request()->file('file'))[0];
            foreach($wards AS $key => $value){
                if($key) {
                    $city = new Ward([
                        'name' => $value[1],
                        'code' => $value[0],
                        'district_id' => $value[4],
                        'province_id' => $value[6],
                    ]);
                    $city->save();
                }
            }
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    public function exportJS(){
        
        $cities = json_encode(app(GetAllCitiesAction::class)->run(false), JSON_UNESCAPED_UNICODE);
        $file = 'provinces.js';
        $cities = 'var provinces = '. $cities;
        $destinationPath = public_path()."/js/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$cities);

        $district = json_encode(app(GetAllDistrictsAction::class)->run(false), JSON_UNESCAPED_UNICODE);
        $file = 'districts.js';
        $district = 'var districts = '. $district;
        $destinationPath = public_path()."/js/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$district);

        $wards = json_encode(app(GetAllWardsAction::class)->run(false), JSON_UNESCAPED_UNICODE);
        $file = 'wards.js';
        $wards = 'var wards = '. $wards;
        $destinationPath = public_path()."/js/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file, $wards);

    }
}
