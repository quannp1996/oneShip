<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-31 16:10:44
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-07 20:03:59
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\UI\WEB\Components\FrontEnd;

use App\Containers\Comment\Enums\CommentStatus;
use App\Containers\BaseContainer\UI\WEB\Components\FrontEnd\BaseComponent;

class CommentBoxComponent extends BaseComponent
{
    public $objectID;
    public $objectType;

    public function __construct(int $objectID, string $objectType) {
        parent::__construct();
        $this->objectID = $objectID;
        $this->objectType = $objectType;
    }

    public function render()
    {
        $fectchURL = $this->objectType == Product::class ? route('api_comment_news_get', [
            'newsId' => $this->objectID,
        ]) : route('api_comment_get_by_product_id', [
            'productId' => $this->objectID
        ]);
        return $this->returnView('basecontainer', 'components.comment', 'frontend' ,[
            'fectchURL' => $fectchURL
        ]);
    }
}
