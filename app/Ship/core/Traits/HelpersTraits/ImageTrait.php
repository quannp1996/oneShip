<?php

namespace App\Ship\core\Traits\HelpersTraits;

use Apiato\Core\Foundation\Facades\ImageURL;
use Apiato\Core\Foundation\FunctionLib;

trait ImageTrait
{
    public function getLogoAttribute($value) {
        return 'https://via.placeholder.com/100';
        try {
            $imageLink = ImageURL::getImageUrl($value, 'contractors', 'original');
            if ( getimagesize($imageLink) ) {
                return $imageLink;
            }

            return 'https://via.placeholder.com/100';
        }catch(\Exception $e) {
            return 'https://via.placeholder.com/100';
        }
    }

    public function getSourceAttribute($value) {
        return 'https://via.placeholder.com/100';
        if (!empty($value)) {
            try {
                $imageLink = ImageURL::getImageUrl($value, 'constructions', 'original');
                if ( getimagesize($imageLink) ) {
                    return $imageLink;
                }
    
                return 'https://via.placeholder.com/770x490';
            }catch(\Exception $e) {
                return 'https://via.placeholder.com/770x490';
            }
        }
        
        return 'https://via.placeholder.com/100';
    }
} // End class

