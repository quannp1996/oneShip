<?php

namespace App\Containers\Settings\Data\Seeders;

use App\Containers\Settings\Models\Setting;
use App\Ship\Parents\Seeders\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

/**
 * Class SettingsDefaultSettingsSeeder
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class SettingsDefaultSettingsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/seeds/settings.json");
        DB::table('settings')->truncate();
        DB::table('settings')->insert(json_decode($json, true));
    }
}
