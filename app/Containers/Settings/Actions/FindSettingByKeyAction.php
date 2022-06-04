<?php

namespace App\Containers\Settings\Actions;

use App\Containers\Settings\Tasks\FindSettingByKeyTask;

class FindSettingByKeyAction extends SettingsParentAction
{
    public function run(string $key = '')
    {
        return $this->remember(function() use($key) {
            $settings = app(FindSettingByKeyTask::class)->run($key);

            return $settings;
        });
    }
}
