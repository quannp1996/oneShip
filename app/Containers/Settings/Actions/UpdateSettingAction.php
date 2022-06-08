<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Arr;

/**
 * Class UpdateSettingAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdateSettingAction extends SettingsParentAction
{
    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  mixed
     */
    public function run(DataTransporter $data)
    {
        // $sanitizedData = $data->sanitizeInput([
        //     'key',
        //     'value'
        // ]);

        // $setting = Apiato::call('Settings@UpdateSettingTask', [$data->id, $sanitizedData]);
        $data = Arr::except($data->toArray(), ['_token', '_headers']);

        $allSettings = Apiato::call('Settings@GetAllSettingsTask', [true]);

        if ($allSettings && !$allSettings->isEmpty()) {
            $allSettings = $allSettings->keyBy('key')->toArray();
        }
        foreach ($data as $k => $v) {
            if (isset($allSettings[$k])) {
                $decodeData = json_decode($allSettings[$k]['value'], true);
                $updateData = array_merge($decodeData, $v);

                Apiato::call('Settings@UpdateSettingTask', [$updateData, $k]);
            } else {
                Apiato::call('Settings@CreateSettingTask', [$v, $k]);
            }
        }

        $this->clearCache();

        return true;
    }
}
