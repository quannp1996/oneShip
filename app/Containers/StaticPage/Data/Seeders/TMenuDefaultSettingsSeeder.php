<?php

namespace App\Containers\StaticPage\Data\Seeders;

use App\Containers\Menu\Models\Menu;
use App\Containers\Menu\Models\MenuDesc;
use App\Containers\StaticPage\Models\StaticPage;
use App\Ship\Parents\Seeders\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

/**
 * Class SettingsDefaultSettingsSeeder
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class TMenuDefaultSettingsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->truncate();
        DB::table('menu_description')->truncate();

        $json = json_decode(File::get("database/seeds/menu.json"), true);
        $jsonDesc = json_decode(File::get("database/seeds/menudesc.json"), true);
        $staticPage = StaticPage::select('*')->first();
        foreach($json AS $key => $menu){
            if(!empty($menu['extra_link'])){
                $menu['extra_link'] = '/page/edit/'.$staticPage->id;
            }
            $objMenu = new Menu($menu);
            $objMenu->save();
            $objMenuDesc = new MenuDesc(array_merge($jsonDesc[$key], [
                'menu_id' => $objMenu->id
            ]));
            $objMenuDesc->save();
        }
    }
}
