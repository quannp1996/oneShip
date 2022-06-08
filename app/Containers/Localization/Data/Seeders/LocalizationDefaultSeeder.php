<?php

namespace App\Containers\Localization\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AuthorizationDefaultUsersSeeder_3
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class LocalizationDefaultSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('language')->truncate();
        DB::table('language')->insert([
            'language_id' => 0,
            'name' => 'Tiếng Việt',
            'short_code' => 'vi',
            'code' => 'vi-vn',
            'locale' => 'vi-VN',
            'image' => 'vn.png',
            'directory' => 'vietnamese',
            'sort_order' => 1,
            'status' => 1,
            'is_default' => 1
        ]);
    }
}
