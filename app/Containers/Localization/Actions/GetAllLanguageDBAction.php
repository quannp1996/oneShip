<?php

namespace App\Containers\Localization\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Support\Collection;


class GetAllLanguageDBAction extends Action
{

    /**
     * @return  \Illuminate\Support\Collection
     */
    public function run(): Collection
    {
        return $this->remember(function () {
            $localizations = Apiato::call('Localization@GetAllLanguageDBTask', []);

            return $localizations;
        });
    }
}
