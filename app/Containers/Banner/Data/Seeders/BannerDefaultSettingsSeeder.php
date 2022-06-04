<?php

namespace App\Containers\Banner\Data\Seeders;

use App\Containers\Banner\Models\Banner;
use App\Containers\Banner\Models\BannerDesc;
use App\Ship\Parents\Seeders\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

/**
 * Class SettingsDefaultSettingsSeeder
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class BannerDefaultSettingsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banner')->truncate();
        DB::table('banner_description')->truncate();
        $json = json_decode(File::get("database/seeds/banner.json"), true);
        $jsonDesc = json_decode(File::get("database/seeds/bannerdesc.json"), true);
        foreach($json AS $key => $banner){
            $objBanner = new Banner($banner);
            $objBanner->save();
            $bannerDesc = new BannerDesc(array_merge($jsonDesc[$key], [
                'banner_id' => $objBanner->id
            ]));
            $bannerDesc->save();
        }
    }
}
