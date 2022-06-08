<?php

namespace App\Containers\StaticPage\Data\Seeders;

use App\Containers\StaticPage\Models\StaticPage;
use App\Ship\Parents\Seeders\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

/**
 * Class SettingsDefaultSettingsSeeder
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class StaticPageDefaultSettingsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('static_page')->truncate();
        DB::table('static_page_description')->truncate();
        $json = File::get("database/seeds/staticpage.json");
        $jsonDesc = File::get("database/seeds/staticpagedesc.json");
        $staticpage = new StaticPage(json_decode($json, true));
        $staticpage->save();
        DB::table('static_page_description')->insert(array_merge(json_decode($jsonDesc, true), [
            'static_page_id' => $staticpage->id
        ]));
    }
}
