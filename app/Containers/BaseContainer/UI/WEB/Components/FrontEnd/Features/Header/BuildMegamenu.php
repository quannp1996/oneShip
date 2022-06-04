<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-07 10:39:59
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-07 19:13:26
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\UI\WEB\Components\FrontEnd\Features\Header;

use App\Containers\Category\Actions\PresentFrontEndCategoryAction;
use App\Containers\Category\Enums\CategoryType;

trait BuildMegamenu
{
    public function buildMegamenu(PresentFrontEndCategoryAction $presentFrontEndCategoryAction)
    {
        $this->categories = $presentFrontEndCategoryAction->run(
            ['cate_type' => CategoryType::PRODUCT],
            $this->currentLang,
            0,// Limit zero,
            'category.sort_order,category.created_at desc',
            true,// Skip pagination
        );

        // dd($this->categories);
    }
}
