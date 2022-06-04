<?php

namespace App\Ship\core\Foundation;

class LangLib
{
    public static function getLocaleFb()
    {
        switch (app()->getLocale()) {
            case 'en':
                return 'en_US';
                break;
            case 'vi':
            default:
                return 'vi_VN';
                break;
        }
    }

}