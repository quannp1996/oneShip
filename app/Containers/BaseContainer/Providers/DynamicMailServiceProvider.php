<?php

namespace App\Containers\BaseContainer\Providers;

use App\Containers\Settings\Actions\FindSettingByKeyAction;
use App\Containers\Settings\Tasks\FindSettingByKeyTask;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


class DynamicMailServiceProvider extends ServiceProvider
{

    public function boot()
    {
        parent::boot();
    }

    public function register()
    {
        // DB::enableQueryLog(); 
        $setting = app(FindSettingByKeyAction::class)->run('intergrated');
        if ($setting && !empty($setting)) {
            $value = json_decode($setting, true);
            $driver = $value['mail_driver'] ?? 'smtp';
            $config = [
                'default' => $driver,
                'mailers' => [
                    $driver => [
                        'transport' => $driver,
                        'host' => $value['mail_host'] ?? '',
                        'port' => $value['mail_port'] ?? '',
                        'encryption' => $value['mail_encryption'] ?? 'tls',
                        'username' => $value['mail_username'] ?? '',
                        'password' =>  $value['mail_password'] ?? '',
                        'timeout' => null,
                    ]
                ],

                'from' => [
                    'address' => $value['mail_from_address'] ?? '',
                    'name' => $value['mail_from_name'] ?? '',
                ],

                'markdown' => [
                    'theme' => 'default',
            
                    'paths' => [
                        resource_path('views/vendor/mail'),
                    ],
                ],
            ];

            Config::set('mail', $config);
        }
        parent::register();
    }
}
