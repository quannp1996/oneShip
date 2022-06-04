<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-10-06 14:01:48
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-24 20:12:18
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\UI\API\Transformers\FrontEnd;

use Apiato\Core\Foundation\ImageURL;
use App\Ship\Parents\Transformers\Transformer;

class BaseCategoryTransformer extends Transformer
{
    public $selectedValues;

    public function __construct(?array $selectedValues = null)
    {
        $this->selectedValues = $selectedValues;
        parent::__construct();
    }

    public function transform($category)
    {
        $response = [
            'category_id' => $category['category_id'],
            'icon' => ImageURL::getImageUrl($category['icon'], 'category', 'original'),
            'icon2' => ImageURL::getImageUrl($category['icon2'], 'category', 'iconx2'),
            'hot' => (bool)$category['hot'],
            'top' => (bool)$category['top'],
            'is_good_price' => (bool)$category['is_good_price'],
            'show_freeship_page' => (bool)$category['show_freeship_page'],
            'show_sale_page' => (bool)$category['show_sale_page'],
            'primary_color' => $category['primary_color'],
            'second_color' => $category['second_color'],
            'name' =>   $category['desc']['name'],
            'slug' =>   $category['desc']['slug'],
            'parent_id' => $category['parent_id'],
            'selected' => !empty($this->selectedValues) ? in_array($category['category_id'],$this->selectedValues) : false,
            'products' => [],
            'link' => route('web.product.cate', [$category['desc']['slug'], $category['category_id']]),
        ];

        return $response;
    }
}
