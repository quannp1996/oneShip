<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-28 21:55:41
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-19 22:47:19
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Actions;

use App\Containers\Customer\Enums\CustomerAddressBookStatus;
use App\Containers\Customer\Tasks\CusGetAllAddBookTask;
use App\Ship\Parents\Actions\Action;

class CusGetAllAddBookAction extends Action
{
    public $cusGetAllAddBookTask;
    public function __construct(CusGetAllAddBookTask $cusGetAllAddBookTask)
    {
        $this->cusGetAllAddBookTask = $cusGetAllAddBookTask;
        parent::__construct();
    }

    public function run(int $customerId, int $limit = 20, bool $skipPagin = true, array $externalData = [], int $currentPage = 1): ?iterable
    {
        return $this->cusGetAllAddBookTask->status(CustomerAddressBookStatus::ACTIVE)->run(
            $customerId,
            $limit,
            $skipPagin,
            $externalData,
            $currentPage
        );
    }

    public function withRelationships(array $rela = ['province','district','ward']): self
    {
        $this->cusGetAllAddBookTask->withRelationships($rela);
        return $this;
    }
}
